<?php

class Drug extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("drug_model");   
        $this->load->library('session');     
    }

    public function listDrugs() {
        $data = $this->drug_model->getAllDrugs();

        $this->template->title("Drug List");
        $this->template->set("data", $data);
        $this->template->render();
    }

    public function add() {
        $drugId = $this->input->post("drugId");
        $drugName = $this->input->post("drugName");
        $brand = $this->input->post("brand");
        $pricePerUnit = $this->input->post("pricePerUnit");
        $quantity = $this->input->post("quantity");
        $manufacturedDate = $this->input->post("manufacturedDate");
        $expiryDate = $this->input->post("expiryDate");

        if (empty($manufacturedDate) || empty($expiryDate)) {
            // Handle error - redirect back with error message
            $this->session->set_flashdata('error', 'Dates cannot be empty');
            redirect(module_url("drug/form_add"));
            return;
        }

        try{
            $manufacturedDate = new DateTime($manufacturedDate);
            $expiryDate = new DateTime($expiryDate);

            $data_to_insert = [
                "T01_DRUGID" => $drugId,
                "T01_DRUGNAME" => $drugName,
                "T01_BRAND" => $brand,
                "T01_PRICEPERUNIT" => $pricePerUnit,
                "T01_QUANTITY" => $quantity,
                "T01_MFGDATE" => $manufacturedDate->format('d-M-Y'),
                "T01_EXPDATE" => $expiryDate->format('d-M-Y')
            ];

            if ($manufacturedDate >= $expiryDate) {
                $this->session->set_flashdata('error', 'Manufactured date cannot be same or later than expiry date');
                redirect(module_url("drug/form_add"));
                return;
            }

            $this->drug_model->createDrug($data_to_insert);
            $this->session->set_flashdata('success','Drug added successfully');
            redirect(module_url("drug/listDrugs"));

        }catch (Exception $e){
            $this->session->set_flashdata('error', 'Invalid date format');
            redirect(module_url("drug/form_add"));
        }

    }

    public function form_add() {
        $this->template->render();
    }

    public function form_edit($drugId) {
        $drug = $this->db
            ->where("T01_DRUGID", $drugId)
            ->get("IPSS_T01_DRUG")
            ->row();

        $this->template->set("drug", $drug);
        $this->template->render();
    }

    public function save($drugId) {
        $drugName = $this->input->post("drugName");
        $brand = $this->input->post("brand");
        $pricePerUnit = $this->input->post("pricePerUnit");
        $quantity = $this->input->post("quantity");
        $manufacturedDate = $this->input->post("manufacturedDate");
        $expiryDate = $this->input->post("expiryDate");

        if (empty($manufacturedDate) || empty($expiryDate)) {
            // Handle error - redirect back with error message
            $this->session->set_flashdata('error', 'Dates cannot be empty');
            redirect(module_url("drug/form_edit"));
            return;
        }

        try{
            $manufacturedDate = new DateTime($manufacturedDate);
            $expiryDate = new DateTime($expiryDate);

            $data_to_update = [
                "T01_DRUGNAME" => $drugName,
                "T01_BRAND" => $brand,
                "T01_PRICEPERUNIT" => $pricePerUnit,
                "T01_QUANTITY" => $quantity,
                "T01_MFGDATE" => $manufacturedDate->format('d-M-Y'),
                "T01_EXPDATE" => $expiryDate->format('d-M-Y')
            ];

            if ($manufacturedDate >= $expiryDate) {
                $this->session->set_flashdata('error', 'Manufactured date cannot be same or later than expiry date');
                redirect(module_url("drug/form_edit"));
                return;
            }

            $this->drug_model->saveDrug($drugId, $data_to_update);
            $this->session->set_flashdata('success','Drug edited successfully');
            redirect(module_url("drug/listDrugs"));

        }catch (Exception $e){
            $this->session->set_flashdata('error', 'Invalid date format');
            redirect(module_url("drug/form_edit"));
        }
    }

    public function delete($drugId) {
        $this->drug_model->deleteDrug($drugId);

        redirect(module_url("drug/listDrugs"));
    }
}