<?php

class Report extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        // session_start();
        $this->load->model("report_model");
    }

    public function staffDispense()
    {
        // Load data for the view
        $drugs = $this->report_model->getAllDrugs();
        
        // Default view is total drugs by all staff (no filters)
        $dispensing_data = $this->report_model->getStaffDispensingData();
        
        // Pass the data to the view
        $this->template->title("Staff Dispensing Report");
        $this->template->set("drugs", $drugs);
        $this->template->set("dispensing_data", $dispensing_data);
        $this->template->render();
    }
    
    public function getFilteredDispensingData()
    {
        // Get parameters from AJAX request
        $drug_id = $this->input->post('drug_id');
        $time_period = $this->input->post('time_period');
        
        // Get data based on filters
        $result = $this->report_model->getStaffDispensingData($drug_id, $time_period);
        
        // Return as JSON for the chart
        header('Content-Type: application/json');
        echo json_encode($result);
    }
}