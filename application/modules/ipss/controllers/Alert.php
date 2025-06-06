<?php

class Alert extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('alert_model');
        // Set timezone for application
        date_default_timezone_set('Asia/Kuala_Lumpur');
    }

    //Stock alert view load
    public function stockAlert()
    {
        $this->alert_model->update_stock_alerts();

        $filter = $this->input->get('filter'); // Get filter type from query string
        $data = $this->alert_model->get_stock_alerts($filter); // Pass filter to model

        $this->template->title("Drug Stock Alerts");
        $this->template->set("stock_alerts", $data);
        $this->template->set("current_filter", $filter); // Pass current filter to view
        $this->template->render();
    }

    //Show expiry alerts view
    public function expiryAlert()
    {
        // Generate/update expiry alerts
        $this->alert_model->update_expiry_alerts();

        // Get expiry alerts
        $filter = $this->input->get('filter');
        $data = $this->alert_model->get_expiry_alerts($filter);

        $this->template->title("Drug Expiry Alerts");
        $this->template->set("expiry_alerts", $data);
        $this->template->set("current_filter", $filter);
        $this->template->render();
    }

}