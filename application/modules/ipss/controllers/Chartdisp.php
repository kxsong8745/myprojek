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
        $filters = [
            'search' => $this->input->get('search'),
            'staff' => $this->input->get('staff'),
            'filter_type' => $this->input->get('filter_type'),
            'filter_date' => $this->input->get('filter_date'),
            'filter_month' => $this->input->get('filter_month'),
            'filter_year' => $this->input->get('filter_year'),
        ];

        $dispensing_data = $this->chartdisp_model->getFilteredDispensingData($filters);
        $drug_options = $this->chartdisp_model->getAllDispensedDrugs();
        $staff_options = $this->chartdisp_model->getAllDispensingStaff();

        $this->template->title("Staff Dispensing Report");
        $this->template->set("dispensing_data", $dispensing_data);
        $this->template->set("drug_options", $drug_options);
        $this->template->set("staff_options", $staff_options);
        $this->template->set($filters);
        $this->template->render();
    }


}

