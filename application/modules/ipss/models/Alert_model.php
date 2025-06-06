<?php

class Alert_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Updates stock alerts in the IPSS_T06_STOCK_ALERTS table
    //Calculates current stock by adding all T02_TOTAL_UNITS for each drug
    //Compares with T01_MIN_STOCK and creates appropriate alerts
    public function update_stock_alerts()
    {
        // get all drugs and their current stock levels
        $sql = "SELECT d.T01_DRUG_ID, d.T01_MIN_STOCK, COALESCE(SUM(b.T02_TOTAL_UNITS), 0) as CURRENT_STOCK 
        FROM IPSS_T01_DRUG d 
        LEFT JOIN IPSS_T02_DBATCH b ON b.T02_DRUG_ID = d.T01_DRUG_ID AND b.T02_TOTAL_UNITS > 0 AND b.T02_EXP_DATE > SYSDATE 
        GROUP BY d.T01_DRUG_ID, d.T01_MIN_STOCK";
        $drugs_stock = $this->db->query($sql)->result();

        // get drugs with no batches (or all batches expired/empty)
        $sql_no_stock = "SELECT d.T01_DRUG_ID, d.T01_MIN_STOCK, 0 AS CURRENT_STOCK
        FROM IPSS_T01_DRUG d
        WHERE NOT EXISTS (
            SELECT 1 FROM IPSS_T02_DBATCH b
            WHERE b.T02_DRUG_ID = d.T01_DRUG_ID
            AND b.T02_TOTAL_UNITS > 0
            AND b.T02_EXP_DATE > SYSDATE
        )";
        $drugs_no_stock = $this->db->query($sql_no_stock)->result();

        // Combine the results
        $drugs = array_merge($drugs_stock, $drugs_no_stock);

        // Process each drug and update alerts
        foreach ($drugs as $drug) {
            $drug_id = $drug->T01_DRUG_ID;
            $current_stock = $drug->CURRENT_STOCK;
            $min_stock = $drug->T01_MIN_STOCK;

            // Calculate alert type
            $alert_type = null;
            if ($current_stock < $min_stock) {
                $alert_type = 'CRITICAL';
            } elseif ($current_stock < ($min_stock + 100)) {
                $alert_type = 'WARNING';
            }

            // Check if an alert already exists for this drug
            $existing_alert = $this->db->query("SELECT * FROM IPSS_T06_STOCK_ALERTS WHERE T06_DRUG_ID = ?", [$drug_id])->row();

            if ($alert_type) {
                // Update or insert alert
                if ($existing_alert) {
                    if ($existing_alert->T06_ALERT_TYPE != $alert_type || $existing_alert->T06_CURRENT_STOCK != $current_stock) {
                        $this->db->query(" UPDATE IPSS_T06_STOCK_ALERTS SET T06_ALERT_TYPE = ?, T06_CURRENT_STOCK = ?, T06_MIN_STOCK = ?, T06_ALERT_DATE = TO_DATE(?, 'YYYY-MM-DD HH24:MI:SS')
                            WHERE T06_ALERT_ID = ? ", [$alert_type, $current_stock, $min_stock, date('Y-m-d H:i:s'), $existing_alert->T06_ALERT_ID]);
                    }
                } else {
                    $this->db->query(
                        " INSERT INTO IPSS_T06_STOCK_ALERTS (T06_DRUG_ID, T06_ALERT_TYPE, T06_CURRENT_STOCK, T06_MIN_STOCK, T06_ALERT_DATE) VALUES (?, ?, ?, ?, TO_DATE(?, 'YYYY-MM-DD HH24:MI:SS'))",
                        [$drug_id, $alert_type, $current_stock, $min_stock, date('Y-m-d H:i:s')]
                    );
                }
            } else {
                // Remove alert if no longer needed
                if ($existing_alert) {
                    $this->db->query("DELETE FROM IPSS_T06_STOCK_ALERTS WHERE T06_ALERT_ID = ?", [$existing_alert->T06_ALERT_ID]);
                }
            }
        }
    }

    //Retrieves stock alerts with drug information for display
    public function get_stock_alerts($filter = null)
    {
        $where = '';
        $params = [];

        if ($filter === 'CRITICAL' || $filter === 'WARNING') {
            $where = 'WHERE a.T06_ALERT_TYPE = ?';
            $params[] = $filter;
        }

        $sql = "SELECT a.*, d.T01_DRUGS AS DRUG_NAME
            FROM IPSS_T06_STOCK_ALERTS a
            JOIN IPSS_T01_DRUG d ON d.T01_DRUG_ID = a.T06_DRUG_ID
            $where
            ORDER BY a.T06_ALERT_TYPE ASC, a.T06_CURRENT_STOCK ASC";

        return $this->db->query($sql, $params)->result();
    }

    //Updates expiry alerts in the IPSS_T07_EXPIRY_ALERTS table
    //Checks drug batches expiry dates and creates appropriate alerts
    public function update_expiry_alerts()
    {
        // Get current date for comparison
        $today = date('Y-m-d');

        // Get all batches with remaining units
        $sql = "SELECT b.T02_BATCH_ID, b.T02_DRUG_ID, b.T02_EXP_DATE, b.T02_TOTAL_UNITS 
            FROM IPSS_T02_DBATCH b 
            WHERE b.T02_TOTAL_UNITS > 0";

        $batches = $this->db->query($sql)->result();

        foreach ($batches as $batch) {
            $batch_id = $batch->T02_BATCH_ID;
            $drug_id = $batch->T02_DRUG_ID;
            $exp_date = date('Y-m-d', strtotime($batch->T02_EXP_DATE));
            $remaining_units = $batch->T02_TOTAL_UNITS;

            // Calculate days until expiry
            $days_until_expiry = (strtotime($exp_date) - strtotime($today)) / (60 * 60 * 24);

            // Determine expiry status
            $expiry_status = null;
            if ($days_until_expiry <= 0) {
                $expiry_status = 'EXPIRED';
            } elseif ($days_until_expiry <= 90) {
                $expiry_status = '3_MONTHS';
            } elseif ($days_until_expiry <= 180) {
                $expiry_status = '6_MONTHS';
            } elseif ($days_until_expiry <= 270) {
                $expiry_status = '9_MONTHS';
            }

            // Check if an alert already exists for this batch
            $existing_alert = $this->db->query("SELECT * FROM IPSS_T07_EXPIRY_ALERTS WHERE T07_BATCH_ID = ?", [$batch_id])->row();

            if ($expiry_status) {
                // We need an alert
                if ($existing_alert) {
                    // Update existing alert if different
                    if ($existing_alert->T07_EXPIRY_STATUS != $expiry_status || $existing_alert->T07_REMAINING_UNITS != $remaining_units) {
                        $this->db->query(
                            "UPDATE IPSS_T07_EXPIRY_ALERTS 
                         SET T07_EXPIRY_STATUS = ?, 
                             T07_REMAINING_UNITS = ?, 
                             T07_ALERT_DATE = TO_DATE(?, 'YYYY-MM-DD HH24:MI:SS')
                         WHERE T07_ALERT_ID = ?",
                            [$expiry_status, $remaining_units, date('Y-m-d H:i:s'), $existing_alert->T07_ALERT_ID]
                        );
                    }
                } else {
                    // Create new alert
                    $this->db->query(
                        "INSERT INTO IPSS_T07_EXPIRY_ALERTS 
                     (T07_BATCH_ID, T07_DRUG_ID, T07_EXPIRY_STATUS, T07_EXP_DATE, T07_REMAINING_UNITS, T07_ALERT_DATE)
                     VALUES (?, ?, ?, TO_DATE(?, 'YYYY-MM-DD'), ?, TO_DATE(?, 'YYYY-MM-DD HH24:MI:SS'))",
                        [$batch_id, $drug_id, $expiry_status, $exp_date, $remaining_units, date('Y-m-d H:i:s')]
                    );
                }
            } else {
                // No alert needed (beyond 9 months), remove existing if any
                if ($existing_alert) {
                    $this->db->query("DELETE FROM IPSS_T07_EXPIRY_ALERTS WHERE T07_ALERT_ID = ?", [$existing_alert->T07_ALERT_ID]);
                }
            }
        }

        // Clean up alerts for batches with zero units or deleted batches
        $this->db->query("DELETE FROM IPSS_T07_EXPIRY_ALERTS WHERE T07_BATCH_ID NOT IN (SELECT T02_BATCH_ID FROM IPSS_T02_DBATCH WHERE T02_TOTAL_UNITS > 0)");
    }

    //Retrieves expiry alerts with drug information for display
    public function get_expiry_alerts($filter = null)
    {
        $where = '';
        $params = [];

        if ($filter === 'EXPIRED' || $filter === '3_MONTHS' || $filter === '6_MONTHS' || $filter === '9_MONTHS') {
            $where = 'WHERE a.T07_EXPIRY_STATUS = ?';
            $params[] = $filter;
        }

        $sql = "SELECT a.*, d.T01_DRUGS AS DRUG_NAME
            FROM IPSS_T07_EXPIRY_ALERTS a
            JOIN IPSS_T01_DRUG d ON d.T01_DRUG_ID = a.T07_DRUG_ID
            $where
            ORDER BY 
                CASE a.T07_EXPIRY_STATUS 
                    WHEN 'EXPIRED' THEN 1 
                    WHEN '3_MONTHS' THEN 2 
                    WHEN '6_MONTHS' THEN 3 
                    WHEN '9_MONTHS' THEN 4 
                END ASC,
                a.T07_REMAINING_UNITS ASC";

        return $this->db->query($sql, $params)->result();
    }

}