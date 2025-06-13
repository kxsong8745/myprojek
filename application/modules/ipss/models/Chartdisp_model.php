<?php

class Chartdisp_model extends CI_model
{
    function getStaffDispensingData()
    {
        $this->db->select('T08_STAFF_DISP AS staff_name, SUM(T08_DISP_UNITS) AS total_units');
        $this->db->from('IPSS_T08_DISP');

        $this->db->where("TO_CHAR(T08_DISP_DATE, 'YYYYMM') =", date('Ym'));

        $this->db->group_by('T08_STAFF_DISP');

        $query = $this->db->get();
        return $query->result();
    }

    public function getFilteredDispensingData($filters = [])
    {
        $this->db->query("ALTER SESSION SET NLS_DATE_FORMAT = 'DD-MM-YYYY HH24:MI:SS'");

        $this->db->select('T08_STAFF_DISP AS staff_name, SUM(T08_DISP_UNITS) AS TOTAL_UNITS');
        $this->db->from('IPSS_T08_DISP');

        // Search by drug name
        if (!empty($filters['search'])) {
            $this->db->like('LOWER(T08_DRUG_NAME)', strtolower($filters['search']));
        }

        // Search by staff name
        if (!empty($filters['staff'])) {
            $this->db->like('LOWER(T08_STAFF_DISP)', strtolower($filters['staff']));
        }

        // Apply date filter
        if (!empty($filters['filter_type'])) {
            switch ($filters['filter_type']) {
                case 'date':
                    if (!empty($filters['filter_date'])) {
                        $this->db->where("TRUNC(T08_DISP_DATE) =", "TO_DATE('{$filters['filter_date']}', 'YYYY-MM-DD')", false);
                    }
                    break;

                case 'month':
                    if (!empty($filters['filter_month']) && !empty($filters['filter_year'])) {
                        $month = str_pad($filters['filter_month'], 2, '0', STR_PAD_LEFT);
                        $this->db->where("TO_CHAR(T08_DISP_DATE, 'MM-YYYY') =", $month . '-' . $filters['filter_year']);
                    }
                    break;

                case 'year':
                    if (!empty($filters['filter_year'])) {
                        $this->db->where("TO_CHAR(T08_DISP_DATE, 'YYYY') =", $filters['filter_year']);
                    }
                    break;
            }
        } else {
            // Default to current month if no filter selected
            $this->db->where("TO_CHAR(T08_DISP_DATE, 'YYYYMM') =", date('Ym'));
        }

        $this->db->group_by('T08_STAFF_DISP');
        return $this->db->get()->result();
    }

    public function getAllDispensedDrugs()
    {
        return $this->db->distinct()
            ->select('T08_DRUG_NAME')
            ->from('IPSS_T08_DISP')
            ->order_by('T08_DRUG_NAME', 'ASC')
            ->get()
            ->result();
    }

    public function getAllDispensingStaff()
    {
        return $this->db->distinct()
            ->select('T08_STAFF_DISP')
            ->from('IPSS_T08_DISP')
            ->order_by('T08_STAFF_DISP', 'ASC')
            ->get()
            ->result();
    }


}