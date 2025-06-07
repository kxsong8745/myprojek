<?php

class Chartdisp extends Admin_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model("chartdisp_model");
    }

    public function staffDispense()
    {
        // Load data for the view
        $dispensing_data = $this->chartdisp_model->getStaffDispensingData();

        // Pass the data to the view
        $this->template->title("Staff Dispensing Report");
        $this->template->set("dispensing_data", $dispensing_data);
        $this->template->render();
    }

    public function getFilteredDispensingData()
    {
    }
}

