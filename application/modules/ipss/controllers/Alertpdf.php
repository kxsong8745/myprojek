<?php

class Alertpdf extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('alertpdf_model');
        $this->load->library("m_pdf");
    }

    public function alertStockForm()
    {
        $this->template->title("Generate Stock Alert PDF");
        $this->template->render("alertpdf/alertStockForm");
    }

    public function stockAlertPdf()
    {
        $filter = $this->input->get("filter");
        $stock_alerts = $this->alertpdf_model->get_filtered_stock_alerts($filter);

        $html = '
        <html><head><style>
            body { font-family: Arial; font-size: 12px; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th, td { border: 1px solid #000; padding: 8px; text-align: left; }
            th { background-color: #f2f2f2; }
            h2 { text-align: center; }
        </style></head><body>';

        $html .= '<h2>Drug Stock Alerts Report</h2>';

        if ($filter && $filter !== 'ALL') {
            $stock_alerts = $this->alertpdf_model->get_filtered_stock_alerts($filter);
        } else {
            $stock_alerts = $this->alertpdf_model->get_filtered_stock_alerts(); // No filter applied
        }

        $html .= '<table><thead>
            <tr>
                <th>Alert Type</th>
                <th>Drug Name</th>
                <th>Current Stock</th>
                <th>Minimum Stock</th>
                <th>Alert Date</th>
            </tr></thead><tbody>';

        if (!empty($stock_alerts)) {
            foreach ($stock_alerts as $alert) {
                $html .= '<tr>
                    <td>' . htmlspecialchars($alert->T06_ALERT_TYPE) . '</td>
                    <td>' . htmlspecialchars($alert->DRUG_NAME) . '</td>
                    <td>' . $alert->T06_CURRENT_STOCK . '</td>
                    <td>' . $alert->T06_MIN_STOCK . '</td>
                    <td>' . date('Y-m-d', strtotime($alert->T06_ALERT_DATE)) . '</td>
                </tr>';
            }
        } else {
            $html .= '<tr><td colspan="5" style="text-align:center;">No alerts found</td></tr>';
        }

        $html .= '</tbody></table></body></html>';

        $this->m_pdf->pdf->SetTitle("Stock Alert Report");
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output("stock_alert_report.pdf", "I");
    }

    public function alertExpForm()
    {
        $this->template->title("Generate Expiry Alert PDF");
        $this->template->render("alertpdf/alertExpForm");
    }

    public function expiryAlertPdf()
    {
        $filter = $this->input->get("filter");
        $expiry_alerts = $this->alertpdf_model->get_filtered_expiry_alerts($filter);

        $html = '
    <html><head><style>
        body { font-family: Arial; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style></head><body>';

        $html .= '<h2>Drug Expiry Alerts Report</h2>';

        if ($filter && $filter !== 'ALL') {
            $html .= '<p><strong>Filter:</strong> ' . htmlspecialchars($filter) . '</p>';
        } else {
            $html .= '<p><strong>Filter:</strong> All</p>';
        }

        $html .= '<table><thead>
        <tr>
            <th>Expiry Status</th>
            <th>Drug Name</th>
            <th>Batch ID</th>
            <th>Expiry Date</th>
            <th>Remaining Units</th>
            <th>Alert Date</th>
        </tr></thead><tbody>';

        if (!empty($expiry_alerts)) {
            foreach ($expiry_alerts as $alert) {
                $html .= '<tr>
                <td>' . htmlspecialchars($alert->T07_EXPIRY_STATUS) . '</td>
                <td>' . htmlspecialchars($alert->DRUG_NAME) . '</td>
                <td>' . htmlspecialchars($alert->T07_BATCH_ID) . '</td>
                <td>' . date('Y-m-d', strtotime($alert->T07_EXP_DATE)) . '</td>
                <td>' . $alert->T07_REMAINING_UNITS . '</td>
                <td>' . date('Y-m-d', strtotime($alert->T07_ALERT_DATE)) . '</td>
            </tr>';
            }
        } else {
            $html .= '<tr><td colspan="6" style="text-align:center;">No alerts found</td></tr>';
        }

        $html .= '</tbody></table></body></html>';

        $this->m_pdf->pdf->SetTitle("Expiry Alert Report");
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output("expiry_alert_report.pdf", "I");
    }

}

