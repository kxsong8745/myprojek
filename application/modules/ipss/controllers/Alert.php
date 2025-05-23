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

    /**
     * Show stock alerts view
     */
    public function stockAlert()
    {
        // Generate/update stock alerts
        $this->alert_model->update_stock_alerts();

        // Get stock alerts
        $data = $this->alert_model->get_stock_alerts();

        $this->template->title("Drug Stock Alerts");
        $this->template->set("stock_alerts", $data);
        $this->template->render();
    }

    /**
     * Show expiry alerts view
     */
    public function expiryAlert()
    {
        // Generate/update expiry alerts
        $this->alert_model->update_expiry_alerts();

        // Get expiry alerts
        $data = $this->alert_model->get_expiry_alerts();

        $this->template->title("Drug Expiry Alerts");
        $this->template->set("expiry_alerts", $data);
        $this->template->render();
    }

}