<?php

class ReportPdf extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('prepdisp_model');
    }

    public function generateDispPdf()
    {
        // Load mPDF library
        $this->load->library("m_pdf");
        
        // Get the dispensed drugs data
        $disp_records = $this->prepdisp_model->get_disp_records();
        
        // Start building the HTML content
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; font-size: 12px; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #000; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
                h2 { text-align: center; }
            </style>
        </head>
        <body>
            <h2>Drug Dispensation Report</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Drug Name</th>
                        <th>Batch No</th>
                        <th>Units</th>
                        <th>Dispensed Date</th>
                        <th>Dispensed By</th>
                    </tr>
                </thead>
                <tbody>';
        
        // Add data rows
        if (!empty($disp_records)) {
            foreach ($disp_records as $record) {
                $html .= '<tr>
                    <td>'.htmlspecialchars($record->T08_DISP_ID).'</td>
                    <td>'.htmlspecialchars($record->T08_DRUG_NAME).'</td>
                    <td>'.htmlspecialchars($record->T08_BATCH_NO).'</td>
                    <td>'.htmlspecialchars($record->T08_DISP_UNITS).'</td>
                    <td>'.htmlspecialchars($record->T08_DISP_DATE).'</td>
                    <td>'.htmlspecialchars($record->T08_STAFF_DISP).'</td>
                </tr>';
            }
        } else {
            $html .= '<tr><td colspan="6" style="text-align:center;">No dispensation records found</td></tr>';
        }
        
        $html .= '</tbody></table></body></html>';
    
        // Set PDF options
        $this->m_pdf->pdf->SetTitle('Drug Dispensation Report');
        $this->m_pdf->pdf->SetAuthor('Pharmacy System');
        
        // Write HTML to PDF
        $this->m_pdf->pdf->WriteHTML($html);
        
        // Output the PDF - using 'D' for download
        $this->m_pdf->pdf->Output('drug_dispensation_report.pdf', 'I');
    }

    public function generateAlertStockPdf()
    {
        
    }
}