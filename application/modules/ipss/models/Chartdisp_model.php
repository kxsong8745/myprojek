<?php

class Chartdisp_model extends CI_model
{
    function getStaffDispensingData()
    {
        $this->db->select('T08_STAFF_DISP AS staff_name, SUM(T08_DISP_UNITS) AS total_units');
        $this->db->from('IPSS_T08_DISP');

        // No filters, just group by staff name
        $this->db->group_by('T08_STAFF_DISP');

        $query = $this->db->get();
        return $query->result();
    }

}