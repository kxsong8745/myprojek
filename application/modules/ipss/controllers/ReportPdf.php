<?php

class ReportPdf extends Admin_Controller{

    public function __construct()
    {
        parent::__construct();
        session_start();;
    }

    // public function generatePrepPdf()
    // {
    //     // Load mPDF library
    //     $this->load->library("m_pdf");

    //     // Get the preparations data
    //     $preparations = $this->prepdisp_model->get_prepared_drugs();

    //     // Start building the HTML content
    //     $html = '
    //     <!DOCTYPE html>
    //     <html>
    //     <head>
    //         <style>
    //             body { font-family: Arial, sans-serif; font-size: 12px; }
    //             table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    //             th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    //             th { background-color: #f2f2f2; }
    //             h2 { text-align: center; }
    //         </style>
    //     </head>
    //     <body>
    //         <h2>Prepared Drugs Report</h2>
    //         <table>
    //             <thead>
    //                 <tr>
    //                     <th>#</th>
    //                     <th>Staff Name</th>
    //                     <th>Drug Name</th>
    //                     <th>Trade Name</th>
    //                     <th>Batch ID</th>
    //                     <th>Prepared Units</th>
    //                     <th>Units Left</th>
    //                     <th>Preparation Date</th>
    //                     <th>Batch Expiry Date</th>
    //                 </tr>
    //             </thead>
    //             <tbody>';

    //     // Add data rows
    //     if (!empty($preparations)) {
    //         foreach ($preparations as $index => $prep) {
    //             $html .= '<tr>
    //                 <td>' . ($index + 1) . '</td>
    //                 <td>' . $prep->staff_name . '</td>
    //                 <td>' . $prep->drug_name . '</td>
    //                 <td>' . $prep->trade_name . '</td>
    //                 <td>' . $prep->T02_BATCH_ID . '</td>
    //                 <td>' . $prep->T03_ORI_PREP_UNIT . '</td>
    //                 <td>' . $prep->T03_PREP_UNIT . '</td>
    //                 <td>' . date('d-m-Y', strtotime($prep->T03_PREP_DATE)) . '</td>
    //                 <td>' . date('d-m-Y', strtotime($prep->T02_EXP_DATE)) . '</td>
    //             </tr>';
    //         }
    //     } else {
    //         $html .= '<tr><td colspan="9" style="text-align:center;">No preparations found</td></tr>';
    //     }

    //     $html .= '</tbody></table></body></html>';

    //     // Set PDF options (optional)
    //     $this->m_pdf->pdf->SetTitle('Prepared Drugs Report');
    //     $this->m_pdf->pdf->SetAuthor('Your System Name');

    //     // Write HTML to PDF
    //     $this->m_pdf->pdf->WriteHTML($html);

    //     // Output the PDF
    //     $this->m_pdf->pdf->Output('prepared_drugs_report.pdf', 'I');// I for view
    // }

    // public function prepList_pdf()
    // {
    //     $preparations = $this->prepdisp_model->get_prepared_drugs();
    //     $this->template->set("preparations", $preparations);
    //     $this->template->render();
    // }

    // public function generateDispPdf()
    // {
    //     // Load mPDF library
    //     $this->load->library("m_pdf");

    //     // Get the dispensed drugs data
    //     $dispenses = $this->prepdisp_model->get_dispensed_drugs();

    //     // Start building the HTML content
    //     $html = '
    //     <!DOCTYPE html>
    //     <html>
    //     <head>
    //         <style>
    //             body { font-family: Arial, sans-serif; font-size: 12px; }
    //             table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    //             th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    //             th { background-color: #f2f2f2; }
    //             h2 { text-align: center; }
    //         </style>
    //     </head>
    //     <body>
    //         <h2>Dispensed Drugs Report</h2>
    //         <table>
    //             <thead>
    //                 <tr>
    //                     <th>#</th>
    //                     <th>Staff Name</th>
    //                     <th>Drug Name</th>
    //                     <th>Trade Name</th>
    //                     <th>Dispensed Units</th>
    //                     <th>Preparation Date</th>
    //                     <th>Dispense Date</th>
    //                 </tr>
    //             </thead>
    //             <tbody>';

    //     // Add data rows
    //     if (!empty($dispenses)) {
    //         foreach ($dispenses as $index => $dispense) {
    //             $html .= '<tr>
    //                 <td>' . ($index + 1) . '</td>
    //                 <td>' . htmlspecialchars($dispense->staff_name) . '</td>
    //                 <td>' . htmlspecialchars($dispense->drug_name) . '</td>
    //                 <td>' . htmlspecialchars($dispense->trade_name) . '</td>
    //                 <td>' . htmlspecialchars($dispense->T04_DISP_UNIT) . '</td>
    //                 <td>' . date('d-m-Y', strtotime($dispense->T03_PREP_DATE)) . '</td>
    //                 <td>' . date('d-m-Y', strtotime($dispense->T04_DISP_DATE)) . '</td>
    //             </tr>';
    //         }
    //     } else {
    //         $html .= '<tr><td colspan="7" style="text-align:center;">No dispenses found</td></tr>';
    //     }

    //     $html .= '</tbody></table></body></html>';

    //     // Set PDF options (optional)
    //     $this->m_pdf->pdf->SetTitle('Dispensed Drugs Report');
    //     $this->m_pdf->pdf->SetAuthor('Your System Name');

    //     // Write HTML to PDF
    //     $this->m_pdf->pdf->WriteHTML($html);

    //     // Output the PDF - using 'I' for inline viewing in browser
    //     $this->m_pdf->pdf->Output('dispensed_drugs_report.pdf', 'I');
    // }

    // public function dispList_pdf()
    // {
    //     // Retrieve dispensing records from the model
    //     $dispenses = $this->prepdisp_model->get_dispensed_drugs();

    //     // Pass the data to the view using the template
    //     $this->template->set("dispenses", $dispenses);
    //     $this->template->render();
    // }
}