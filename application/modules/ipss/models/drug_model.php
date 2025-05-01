<?php

class Drug_model extends CI_Model {

    // Retrieve all drugs from the database
    function getAllDrugs() {
        $query = $this->db->get("IPSS_T01_DRUG");
        return $query->result(); // Returns all drugs
    }

    function getDrugRecord(){
        $query = $this->db->select('T01_DRUGS, T01_TRADE_NAME')->get('IPSS_T01_DRUG');
        return $query->result_array(); 
    }

    public function searchDrugs($search) {
        $query = $this->db->query("
            SELECT * 
            FROM IPSS_T01_DRUG 
            WHERE LOWER(T01_DRUGS) LIKE ?", 
            ['%' . strtolower($search) . '%']
        );

        return $query->result();
    }

    public function searchBarcode($search){
        $query = $this->db->query("
            SELECT * 
            FROM IPSS_T02_DBATCH 
            WHERE LOWER(T02_BARCODE_NUM) LIKE ?", 
            ['%' . strtolower($search) . '%']
        );

        return $query->result();

    }
 
    public function getDrugByDetails($drugs, $tradeName, $minStock) {
        $this->db->where('T01_DRUGS', $drugs);
        $this->db->where('T01_TRADE_NAME', $tradeName);
        $this->db->where('T01_MIN_STOCK', $minStock);
        $query = $this->db->get('IPSS_T01_DRUG');
        return $query->row_array(); // Returns the row if found, otherwise null
    }

    // Retrieve batches for a specific drug ID
    public function getBatchesByDrugId($drugId) {
        $this->db->select('b.*, t.T03_TEND_NAME AS T02_TENDERER');
        $this->db->from('IPSS_T02_DBATCH b');
        $this->db->join('IPSS_T03_TENDERER t', 'b.T02_TENDERER_ID = t.T03_TEND_ID', 'left');
        $this->db->where('b.T02_DRUG_ID', $drugId);
        
        $query = $this->db->get();
        return $query->result();
    }
    
    
    // public function getBatchesByDrugId($drugId) {
    //     $this->db->where('T02_DRUG_ID', $drugId);
    //     $query = $this->db->get('IPSS_T02_DBATCH');
    //     return $query->result(); // Returns all batches for the given drug
    // }

    // Retrieve the drug details by drug ID
    public function getDrugById($drugId) {
        $this->db->where('T01_DRUG_ID', $drugId);
        $query = $this->db->get('IPSS_T01_DRUG');
        return $query->row(); // Returns a single row for the given drugId
    }

    // Add a new drug to the database
    function createDrug($data_to_drug) {
        $this->db->insert("IPSS_T01_DRUG", $data_to_drug);
        $query = $this->db->query("SELECT IPSS_T01_DRUG_SEQ.CURRVAL as ID FROM DUAL");
        $row = $query->row();

        return $row ? $row->ID : null;  //return id if null
    }

    // Create a new batch for the drug
    public function createBatch($data_to_batch) {
        $this->db->insert('IPSS_T02_DBATCH', $data_to_batch);
        
        return true;
    }

    // Update drug details
    function updateDrug($drugId, $data_to_update) {
        $this->db
            ->where("T01_DRUG_ID", $drugId)
            ->update("IPSS_T01_DRUG", $data_to_update);
    }

    // Update batch details
    public function updateBatch($batchId, $data_to_update) {
        $this->db->where('T02_BATCH_ID', $batchId);
        $this->db->update('IPSS_T02_DBATCH', $data_to_update);
    }

    // Delete batch
    public function deleteBatch($batchId) {
        $this->db->where('T02_BATCH_ID', $batchId);
        $this->db->delete('IPSS_T02_DBATCH');
    }
 
    // Get drug ID by batch ID
    public function getDrugIdByBatch($batchId) {
        $this->db->select('T02_DRUG_ID');
        $this->db->where('T02_BATCH_ID', $batchId);
        $query = $this->db->get('IPSS_T02_DBATCH');
        $result = $query->row();
        return $result ? $result->T02_DRUG_ID : null;
    }

    public function getAllTenderers() {
        $query = $this->db->select('T03_TEND_ID, T03_TEND_NAME')->get('IPSS_T03_TENDERER');
        return $query->result(); // for dropdown
    }
}

