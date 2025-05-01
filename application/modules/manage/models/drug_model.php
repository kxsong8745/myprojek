<?php
class Drug_model extends CI_Model {

    // Retrieve all drugs from the database
    function getAllDrugs() {
        $query = $this->db->get("IPSS_T01_DRUG");
        return $query;
    }

    // Delete a drug from the database
    function deleteDrug($drugId) {
        $this->db
            ->where("T01_DRUGID", $drugId)
            ->delete("IPSS_T01_DRUG");
    }

    // Add a new drug to the database
    function createDrug($data_to_insert) {
        $this->db->insert("IPSS_T01_DRUG", $data_to_insert);
    }

    // Update an existing drug in the database
    function saveDrug($drugId, $data_to_update) {
        $this->db
            ->where("T01_DRUGID", $drugId)
            ->update("IPSS_T01_DRUG", $data_to_update);
    }
}