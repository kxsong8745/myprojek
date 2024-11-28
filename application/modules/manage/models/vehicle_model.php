<?php
class Vehicle_model extends CI_Model{
    function getAllKenderaan(){
        $query = $this->db->get("EV_T01_KENDERAAN");
        return $query;
    }

     function deleteVehicle($id_kenderaan,$id2=""){
        $this->db
            ->where("T01_ID", $id_kenderaan)
            ->delete("EV_T01_KENDERAAN");

        redirect(module_url("kenderaan/listkend"));
    }

    function createVehicle($data_to_insert){
        $this->db->insert("EV_T01_KENDERAAN", $data_to_insert);
    }

    function saveVehicle($id_kenderaan,$data_to_update){
        $this->db
            ->where("T01_ID", $id_kenderaan)
            ->update("EV_T01_KENDERAAN", $data_to_update);
    }
}