<?php
class Prepdisp_model extends CI_Model
{

    public function update_batch_units($batch_id, $new_total_units)
    {
        return $this->db
            ->where("T02_BATCH_ID", $batch_id)
            ->update("IPSS_T02_DBATCH", ["T02_TOTAL_UNITS" => $new_total_units]);
    }

    public function insert_open_shelf($data)
    {
        return $this->db->insert("IPSS_T04_OPEN_SHELF", $data);
    }


    public function get_open_shelf_records()
    {
        return $this->db
            ->select('os.*, d.T01_DRUGS as drug_name, d.T01_TRADE_NAME as trade_name, 
              b.T02_EXP_DATE, os.T04_MOVED_BY as staff_name, 
              os.T04_TOTAL_UNITS as available_units_on_shelf,
              os.T04_ORI_MOVED as original_units_moved') // Added the new field
            ->from('IPSS_T04_OPEN_SHELF os')
            ->join('IPSS_T01_DRUG d', 'd.T01_DRUG_ID = os.T04_DRUG_ID')
            ->join('IPSS_T02_DBATCH b', 'b.T02_BATCH_ID = os.T04_BATCH_ID')
            ->order_by('os.T04_DATE_ADDED', 'DESC')
            ->get()
            ->result();
    }

    public function get_all_drugs()
    {
        $this->db->select('T01_DRUG_ID, T01_DRUGS, T01_TRADE_NAME');
        return $this->db->get('IPSS_T01_DRUG')->result();
    }

    public function get_batches_by_drug($drug_id)
    {
        $this->db->select('T02_BATCH_ID, T02_TOTAL_UNITS, T02_EXP_DATE');
        $this->db->where('T02_DRUG_ID', $drug_id);
        $this->db->where('T02_TOTAL_UNITS >', 0);  // Only show batches with available units
        $this->db->order_by('T02_EXP_DATE', 'ASC'); // Show earliest expiring batches first
        return $this->db->get('IPSS_T02_DBATCH')->result();
    }

    public function get_batch_by_id($batch_id)
    {
        return $this->db->get_where('IPSS_T02_DBATCH', ['T02_BATCH_ID' => $batch_id])->row();
    }

    public function get_shelf_by_id($shelf_id)
    {
        return $this->db->get_where('IPSS_T04_OPEN_SHELF', ['T04_OPEN_ID' => $shelf_id])->row();
    }

    public function delete_open_shelf($open_shelf_id)
    {
        return $this->db->delete('IPSS_T04_OPEN_SHELF', ['T04_OPEN_ID' => $open_shelf_id]);
    }


    public function get_drugs_on_open_shelf()
    {
        return $this->db
            ->select('os.T04_OPEN_ID, os.T04_BATCH_ID, os.T04_DRUG_ID, os.T04_TOTAL_UNITS, 
             os.T04_ORI_MOVED, d.T01_DRUGS as drug_name, d.T01_TRADE_NAME as trade_name, 
             b.T02_EXP_DATE') // Added the new field
            ->from('IPSS_T04_OPEN_SHELF os')
            ->join('IPSS_T01_DRUG d', 'd.T01_DRUG_ID = os.T04_DRUG_ID')
            ->join('IPSS_T02_DBATCH b', 'b.T02_BATCH_ID = os.T04_BATCH_ID')
            ->where('os.T04_TOTAL_UNITS >', 0) // Only show items with available units
            ->order_by('b.T02_EXP_DATE', 'ASC') // Show earliest expiring drugs first
            ->get()
            ->result();
    }

    public function get_open_shelf_item($open_id)
    {
        return $this->db
            ->select('os.*, d.T01_DRUGS as drug_name, d.T01_TRADE_NAME as trade_name, b.T02_EXP_DATE')
            ->from('IPSS_T04_OPEN_SHELF os')
            ->join('IPSS_T01_DRUG d', 'd.T01_DRUG_ID = os.T04_DRUG_ID')
            ->join('IPSS_T02_DBATCH b', 'b.T02_BATCH_ID = os.T04_BATCH_ID')
            ->where('os.T04_OPEN_ID', $open_id)
            ->get()
            ->row();
    }

    public function update_open_shelf_units($open_id, $new_units)
    {
        return $this->db
            ->where('T04_OPEN_ID', $open_id)
            ->update('IPSS_T04_OPEN_SHELF', ['T04_TOTAL_UNITS' => $new_units]);
    }

    // Modified function to insert into PREP table
    public function insert_prep($data)
    {
        $query = $this->db->query("SELECT IPSS_T05_PREP_SEQ.NEXTVAL AS next_id FROM dual");
        $row = $query->row();
        $next_id = $row->next_id;
        $data['T05_PREP_ID'] = $next_id;
        $this->db->insert('IPSS_T05_PREP', $data);
        return $next_id;
    }


    // New function to get all prep records
    public function get_prep_records()
    {
        return $this->db
            ->select('p.*, d.T01_DRUGS as drug_name, d.T01_TRADE_NAME as trade_name, 
                     b.T02_EXP_DATE, b.T02_BARCODE_NUM')
            ->from('IPSS_T05_PREP p')
            ->join('IPSS_T01_DRUG d', 'd.T01_DRUG_ID = p.T05_DRUG_ID')
            ->join('IPSS_T02_DBATCH b', 'b.T02_BATCH_ID = p.T05_BATCH_ID')
            ->join('IPSS_T04_OPEN_SHELF os', 'os.T04_OPEN_ID = p.T05_OPEN_ID')
            ->order_by('p.T05_PREP_ID', 'DESC')
            ->get()
            ->result();
    }

    public function get_prep_by_id($prep_id)
    {
        return $this->db
            ->select('p.*, d.T01_DRUGS as drug_name, d.T01_TRADE_NAME as trade_name, 
                     b.T02_EXP_DATE, b.T02_BARCODE_NUM')
            ->from('IPSS_T05_PREP p')
            ->join('IPSS_T01_DRUG d', 'd.T01_DRUG_ID = p.T05_DRUG_ID')
            ->join('IPSS_T02_DBATCH b', 'b.T02_BATCH_ID = p.T05_BATCH_ID')
            ->where('p.T05_PREP_ID', $prep_id)
            ->get()
            ->row();
    }

    // New function to update prep units
    public function update_prep_units($prep_id, $new_units)
    {
        return $this->db
            ->where('T05_PREP_ID', $prep_id)
            ->update('IPSS_T05_PREP', ['T05_PREP_UNITS' => $new_units]);
    }

    // New function to get all prepared drugs for dispensing
    public function get_prepared_drugs()
    {
        return $this->db
            ->select('p.*, d.T01_DRUGS as drug_name, d.T01_TRADE_NAME as trade_name, 
                     b.T02_EXP_DATE, b.T02_BARCODE_NUM')
            ->from('IPSS_T05_PREP p')
            ->join('IPSS_T01_DRUG d', 'd.T01_DRUG_ID = p.T05_DRUG_ID')
            ->join('IPSS_T02_DBATCH b', 'b.T02_BATCH_ID = p.T05_BATCH_ID')
            ->where('p.T05_PREP_UNITS >', 0) // Only show preparations with available units
            ->order_by('b.T02_EXP_DATE', 'ASC') // Show earliest expiring first
            ->get()
            ->result();
    }

    public function delete_prep($prep_id)
    {
        return $this->db->delete('IPSS_T05_PREP', ['T05_PREP_ID' => $prep_id]);
    }

    // New function to insert into disp table
    public function insert_disp($data)
    {
        // Step 1: Get next ID from sequence
        $query = $this->db->query("SELECT IPSS_T08_DISP_SEQ.NEXTVAL AS next_id FROM dual");
        $row = $query->row();
        $next_id = $row->next_id;

        // Step 2: Add the ID to the data array
        $data['T08_DISP_ID'] = $next_id;

        // Step 3: Handle Oracle date format
        if (isset($data['T08_DISP_DATE'])) {
            $date_string = $data['T08_DISP_DATE'];
            $this->db->set('T08_DISP_DATE', "TO_DATE('$date_string', 'DD-MON-YYYY HH24:MI:SS')", false);
            unset($data['T08_DISP_DATE']);
        }

        // Step 4: Insert data with ID and date set
        $this->db->insert('IPSS_T08_DISP', $data);

        // Step 5: Return inserted ID
        return $next_id;
    }


    // New function to get all disp records
    public function get_disp_records()
    {
        $this->db->query("ALTER SESSION SET NLS_DATE_FORMAT = 'DD-MM-YYYY HH24:MI:SS'");
        return $this->db
            ->select('d.*')
            ->from('IPSS_T08_DISP d')
            ->order_by('d.T08_DISP_DATE', 'DESC')
            ->get()
            ->result();
    }

    // Get batch by barcode
    public function get_batch_by_barcode($barcode)
    {
        $this->db->where('T02_BARCODE_NUM', $barcode);
        $query = $this->db->get('IPSS_T02_DBATCH');
        return $query->row();
    }

    // Get drug details by ID
    public function get_drug_by_id($drug_id)
    {
        $this->db->where('T01_DRUG_ID', $drug_id);
        $query = $this->db->get('IPSS_T01_DRUG');
        return $query->row();
    }

    // Get open shelf items by batch ID
    public function get_open_shelf_by_batch_id($batch_id)
    {
        $this->db->select('T04_OPEN_ID, T04_BATCH_ID, T04_TOTAL_UNITS, T04_ORI_MOVED as original_units_moved');
        $this->db->where('T04_BATCH_ID', $batch_id);
        $query = $this->db->get('IPSS_T04_OPEN_SHELF');
        return $query->result();
    }
}
