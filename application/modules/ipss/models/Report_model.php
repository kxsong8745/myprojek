<?php

class Report_model extends CI_Model {
    
    // Retrieve all drugs from the database for dropdown
    function getAllDrugs() {
        $query = $this->db->select('T08_DRUG_NAME')
                          ->distinct()
                          ->from('IPSS_T08_DISP')
                          ->order_by('T08_DRUG_NAME', 'ASC')
                          ->get();
        return $query->result();
    }
    
    // Get staff dispensing data with optional filters
    function getStaffDispensingData($drug_id = null, $time_period = null) {
        // Start building the query
        $this->db->select('T08_STAFF_DISP AS staff_name, SUM(T08_DISP_UNITS) AS total_units');
        $this->db->from('IPSS_T08_DISP');
        
        // Apply drug filter if specified
        if ($drug_id) {
            $this->db->where('T08_DRUG_NAME', $drug_id);
        }
        
        // Apply time period filter
        if ($time_period) {
            switch ($time_period) {
                case 'day':
                    $this->db->where('TRUNC(T08_DISP_DATE) = TRUNC(SYSDATE)');
                    break;
                case 'month':
                    $this->db->where('EXTRACT(MONTH FROM T08_DISP_DATE) = EXTRACT(MONTH FROM SYSDATE)');
                    $this->db->where('EXTRACT(YEAR FROM T08_DISP_DATE) = EXTRACT(YEAR FROM SYSDATE)');
                    break;
                case 'year':
                    $this->db->where('EXTRACT(YEAR FROM T08_DISP_DATE) = EXTRACT(YEAR FROM SYSDATE)');
                    break;
                // If no valid time period is specified, get all data
            }
        }
        
        // Group by staff name
        $this->db->group_by('T08_STAFF_DISP');
        
        // Execute the query
        $query = $this->db->get();
        return $query->result();
    }
    
    // Get drug-specific dispensing data by staff and time period
    function getDrugDispensingByStaff($time_period = null) {
        // Start building the query
        $this->db->select('T08_DRUG_NAME AS drug_name, T08_STAFF_DISP AS staff_name, SUM(T08_DISP_UNITS) AS total_units');
        $this->db->from('IPSS_T08_DISP');
        
        // Apply time period filter
        if ($time_period) {
            switch ($time_period) {
                case 'day':
                    $this->db->where('TRUNC(T08_DISP_DATE) = TRUNC(SYSDATE)');
                    break;
                case 'month':
                    $this->db->where('EXTRACT(MONTH FROM T08_DISP_DATE) = EXTRACT(MONTH FROM SYSDATE)');
                    $this->db->where('EXTRACT(YEAR FROM T08_DISP_DATE) = EXTRACT(YEAR FROM SYSDATE)');
                    break;
                case 'year':
                    $this->db->where('EXTRACT(YEAR FROM T08_DISP_DATE) = EXTRACT(YEAR FROM SYSDATE)');
                    break;
                // If no valid time period is specified, get all data
            }
        }
        
        // Group by drug name and staff name
        $this->db->group_by('T08_DRUG_NAME, T08_STAFF_DISP');
        $this->db->order_by('T08_DRUG_NAME, T08_STAFF_DISP');
        
        // Execute the query
        $query = $this->db->get();
        return $query->result();
    }
}


