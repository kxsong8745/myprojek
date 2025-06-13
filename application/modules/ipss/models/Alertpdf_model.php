<?php
class Alertpdf_model extends CI_Model
{
    public function get_filtered_stock_alerts($filter = null)
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

    public function get_filtered_expiry_alerts($filter = null)
    {
        $where = '';
        $params = [];

        if (in_array($filter, ['EXPIRED', '3_MONTHS', '6_MONTHS', '9_MONTHS'])) {
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
