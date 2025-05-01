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
                  os.T04_TOTAL_UNITS as available_units_on_shelf')
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
                 d.T01_DRUGS as drug_name, d.T01_TRADE_NAME as trade_name, 
                 b.T02_EXP_DATE')
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

    public function insert_prepdisp($data)
    {
        return $this->db->insert('IPSS_T05_PREPDISP', $data);
    }

    public function get_prepdisp_records()
    {
        return $this->db
            ->select('pd.*, d.T01_DRUGS as drug_name, d.T01_TRADE_NAME as trade_name, 
                 b.T02_EXP_DATE')
            ->from('IPSS_T05_PREPDISP pd')
            ->join('IPSS_T01_DRUG d', 'd.T01_DRUG_ID = pd.T05_DRUG_ID')
            ->join('IPSS_T02_DBATCH b', 'b.T02_BATCH_ID = pd.T05_BATCH_ID')
            ->order_by('pd.T05_DISP_DATE', 'DESC')
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
    $this->db->where('T04_BATCH_ID', $batch_id);
    $query = $this->db->get('IPSS_T04_OPEN_SHELF');
    return $query->result();
}





    // public function prepare_drug($user_id, $drug_id, $batch_id, $prep_unit, $prep_date, $ori_prep_unit) {
    //     $data = [
    //         'T03_USER_ID' => $user_id,
    //         'T03_DRUG_ID' => $drug_id,
    //         'T03_BATCH_ID' => $batch_id,
    //         'T03_PREP_UNIT' => $prep_unit,
    //         'T03_ORI_PREP_UNIT' => $ori_prep_unit,
    //         'T03_PREP_DATE' => $prep_date
    //     ];
    //     return $this->db->insert('IPSS_T03_DRUG_PREP', $data);
    // }


    // public function update_prep_units($prep_id, $new_prep_units) {
    //     return $this->db->update('IPSS_T03_DRUG_PREP', 
    //         ['T03_PREP_UNIT' => $new_prep_units],
    //         ['T03_PREP_ID' => $prep_id]
    //     );
    // }

    // public function get_prepared_drugs() {
    //     $this->db->select('
    //         U.R_NAME as staff_name,
    //         D.T01_DRUGS as drug_name,
    //         D.T01_TRADE_NAME as trade_name,
    //         B.T02_BATCH_ID,
    //         P.T03_PREP_UNIT,
    //         P.T03_ORI_PREP_UNIT,
    //         P.T03_PREP_DATE,
    //         B.T02_EXP_DATE
    //     ');
    //     $this->db->from('IPSS_T03_DRUG_PREP P');
    //     $this->db->join('IPSS_USER U', 'P.T03_USER_ID = U.USER_ID');
    //     $this->db->join('IPSS_T01_DRUG D', 'P.T03_DRUG_ID = D.T01_DRUG_ID');
    //     $this->db->join('IPSS_T02_DBATCH B', 'P.T03_BATCH_ID = B.T02_BATCH_ID');
    //     $this->db->order_by('P.T03_PREP_DATE', 'DESC');
    //     return $this->db->get()->result();
    // }

    // public function get_prepared_drugs_by_drug($drug_id) {
    //     $this->db->select('T03_PREP_ID, T03_PREP_UNIT');
    //     $this->db->where('T03_DRUG_ID', $drug_id);
    //     $this->db->order_by('T03_PREP_DATE', 'ASC'); // Use the earliest prepared units first
    //     return $this->db->get('IPSS_T03_DRUG_PREP')->result();
    // }

    // public function delete_prep_by_id($prep_id) {
    //     $this->db->delete('IPSS_T03_DRUG_PREP', ['T03_PREP_ID' => $prep_id]);
    // }

    // public function get_prep_by_id($prep_id) {
    //     $this->db->select('*');
    //     $this->db->from('IPSS_T03_DRUG_PREP');
    //     $this->db->where('T03_PREP_ID', $prep_id);
    //     $this->db->limit(1);
    //     $this->db->lock_mode = 'FOR UPDATE'; // Lock the row for update
    //     return $this->db->get()->row();
    // }


    // public function dispense_drug($user_id, $drug_id, $prep_id, $disp_unit, $disp_date) {
    //     $data = [
    //         'T04_USER_ID' => $user_id,
    //         'T04_DRUG_ID' => $drug_id,
    //         'T04_PREP_ID' => $prep_id,
    //         'T04_DISP_UNIT' => $disp_unit,
    //         'T04_DISP_DATE' => $disp_date
    //     ];
    //     return $this->db->insert('IPSS_T04_DISP', $data);
    // }

    // public function get_dispensed_drugs() {
    //     $this->db->select('
    //         U.R_NAME as staff_name,
    //         D.T01_DRUGS as drug_name,
    //         D.T01_TRADE_NAME as trade_name,
    //         P.T03_PREP_UNIT,
    //         S.T04_DISP_UNIT,
    //         S.T04_DISP_DATE,
    //         P.T03_PREP_DATE
    //     ');
    //     $this->db->from('IPSS_T04_DISP S');
    //     $this->db->join('IPSS_USER U', 'S.T04_USER_ID = U.USER_ID');
    //     $this->db->join('IPSS_T01_DRUG D', 'S.T04_DRUG_ID = D.T01_DRUG_ID');
    //     $this->db->join('IPSS_T03_DRUG_PREP P', 'S.T04_PREP_ID = P.T03_PREP_ID');
    //     $this->db->order_by('S.T04_DISP_DATE', 'DESC');
    //     return $this->db->get()->result();
    // }

}
