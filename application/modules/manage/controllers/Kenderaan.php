<?php

class Kenderaan extends Admin_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model("vehicle_model");
    }

    public function listkend(){
        $data = $this->vehicle_model->getAllKenderaan();

        $this->template->title("Senarai Kenderaan");
        $this->template->set("data", $data);
        $this->template->render();

    }

    public function add(){
        $kod_kend = $this->input->post("kod_kend");
        $nama_kend = $this->input->post("nama_kend");
        $no_plat = $this->input->post("no_plat");
        $jenama = $this->input->post("jenama");
        $varian = $this->input->post("varian");

        $data_to_insert = [
            "T01_KOD_KENDERAAN" => $kod_kend,
            "T01_NAMA_KENDERAAN" => $nama_kend,
            "T01_PLAT" => $no_plat,
            "T01_JENAMA" => $jenama,
            "T01_VARIAN" => $varian
        ];
        $this->vehicle_model->createVehicle($data_to_insert);

        redirect(module_url("kenderaan/listkend"));
    }

    public function form_add(){
        $this->template->render();
    }

    public function form_edit($id_kenderaan){
        $vehicle=$this->db
        ->where("T01_ID", $id_kenderaan)
        ->get("EV_T01_KENDERAAN")
        ->row();

        $this->template->set("vehicle", $vehicle);
        $this->template->render();
    }

    public function save($id_kenderaan){
        $kod_kend = $this->input->post("kod_kend");
        $nama_kend = $this->input->post("nama_kend");
        $no_plat = $this->input->post("no_plat");
        $jenama = $this->input->post("jenama");
        $varian = $this->input->post("varian");

        $data_to_update = [
            "T01_KOD_KENDERAAN" => $kod_kend,
            "T01_NAMA_KENDERAAN" => $nama_kend,
            "T01_PLAT" => $no_plat,
            "T01_JENAMA" => $jenama,
            "T01_VARIAN" => $varian
        ];
        $this->vehicle_model->saveVehicle($id_kenderaan, $data_to_update);

        redirect(module_url("kenderaan/listkend"));
    }

    public function delete($id_kenderaan,$id2=""){
        $this->vehicle_model->deleteVehicle($id_kenderaan);

        redirect(module_url("kenderaan/listkend"));
    }
}