<?php
class PrepDisp extends Admin_Controller
{

    public function __construct(){
        parent::__construct();
        session_start();
        $this->load->model("prepdisp_model");
    }

    public function openShelf(){
        // Step 1: Retrieve data from the POST request
        $batch_id = $this->input->post("batch_id");
        $drug_id = $this->input->post("drug_id");
        $shelf_unit = $this->input->post("shelf_unit");

        try {
            // Step 2: Get staff info from session
            $staff_name = strtoupper($_SESSION['STAFF']);

            // Step 3: Get current batch details
            $batch = $this->prepdisp_model->get_batch_by_id($batch_id);

            if (!$batch) {
                $this->session->set_flashdata('error', 'Batch not found.');
                redirect(module_url("prepdisp/shelfForm"));
                return;
            }

            // Step 4: Validate that there are enough units in the batch
            if ($batch->T02_TOTAL_UNITS < $shelf_unit) {
                $this->session->set_flashdata('error', 'Not enough units in batch.');
                redirect(module_url("prepdisp/shelfForm"));
                return;
            }

            // Step 5: Calculate new total units for the batch
            $new_total_units = $batch->T02_TOTAL_UNITS - $shelf_unit;

            // Step 6: Start the transaction to ensure data consistency
            $this->db->trans_start();

            // Step 7: Update batch unit after moving to open shelf
            $this->prepdisp_model->update_batch_units($batch_id, $new_total_units);

            // Step 8: Check if the same drug batch already exists on the open shelf
            $existing_shelf_item = $this->db->get_where('IPSS_T04_OPEN_SHELF', [
                'T04_BATCH_ID' => $batch_id,
                'T04_DRUG_ID' => $drug_id
            ])->row();

            if ($existing_shelf_item) {
                // If the same drug batch exists, update the existing record
                $new_shelf_units = $existing_shelf_item->T04_TOTAL_UNITS + $shelf_unit;
                $this->db->update(
                    'IPSS_T04_OPEN_SHELF',
                    ['T04_TOTAL_UNITS' => $new_shelf_units],
                    ['T04_OPEN_ID' => $existing_shelf_item->T04_OPEN_ID]
                );
            } else {
                // If no existing record, insert a new one
                $data_to_open_shelf = [
                    "T04_BATCH_ID" => $batch_id,
                    "T04_DRUG_ID" => $drug_id,
                    "T04_TOTAL_UNITS" => $shelf_unit,
                    "T04_DATE_ADDED" => date("d-M-Y"),
                    "T04_MOVED_BY" => $staff_name
                ];

                $this->prepdisp_model->insert_open_shelf($data_to_open_shelf);
            }

            // Step 10: Complete the transaction
            $this->db->trans_complete();

            // Step 11: Check if transaction was successful
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Transaction failed');
            }

            // Redirect to shelf list page if successful
            $this->session->set_flashdata('success', 'Drug moved to open shelf successfully.');
            redirect(module_url("prepdisp/shelfList"));

        } catch (Exception $e) {
            // If an exception occurred, log the error and redirect
            $this->session->set_flashdata('error', 'Something went wrong.');
            redirect(module_url("prepdisp/shelfForm"));
        }
    }


    public function getBatchesByDrug()
    {
        $drug_id = $this->input->post('drug_id');
        $batches = $this->prepdisp_model->get_batches_by_drug($drug_id);
        echo json_encode($batches);
    }

    public function getBatchDetails()
    {
        $batch_id = $this->input->post('batch_id');
        $batch = $this->prepdisp_model->get_batch_by_id($batch_id);
        echo json_encode($batch);
    }


    public function shelfForm()
    {
        // Use native PHP session variables instead of CI's session
        $staff_id = isset($_SESSION['UID']) ? $_SESSION['UID'] : null;
        $staff_name = isset($_SESSION['STAFF']) ? $_SESSION['STAFF'] : null;

        // Check if session values exist, else show error
        if (!$staff_id || !$staff_name) {
            show_error('You must be logged in to access this page.');
            return;
        }

        // Prepare data for the view
        $data['staff_id'] = $staff_id;
        $data['staff_name'] = $staff_name;
        $data['drugs'] = $this->prepdisp_model->get_all_drugs();

        // Load the form view
        $this->template->render('prepdisp/shelfForm', $data);
    }


    public function shelfList()
    {
        // Fetch records from the open shelf table
        $open_shelves = $this->prepdisp_model->get_open_shelf_records();

        // Pass the open shelf records to the view
        $this->template->set("open_shelves", $open_shelves);
        $this->template->render();
    }

    public function delete_shelf_record($open_shelf_id)
    {
        // Step 1: Retrieve the open shelf record by ID
        $shelf = $this->db->get_where('IPSS_T04_OPEN_SHELF', ['T04_OPEN_ID' => $open_shelf_id])->row();

        if (!$shelf) {
            // If no shelf record found, return an error message
            $this->session->set_flashdata('error', 'Open shelf record not found.');
            redirect(module_url("prepdisp/shelfList"));
            return;
        }

        // Step 2: Get the batch details for the open shelf record
        $batch = $this->prepdisp_model->get_batch_by_id($shelf->T04_BATCH_ID);

        if (!$batch) {
            // If no batch record found, return an error message
            $this->session->set_flashdata('error', 'Batch not found.');
            redirect(module_url("prepdisp/shelfList"));
            return;
        }

        // Step 3: Update the batch total units (add back the units removed from the shelf)
        $new_total_units = $batch->T02_TOTAL_UNITS + $shelf->T04_TOTAL_UNITS;

        // Begin the transaction
        $this->db->trans_start();

        // Step 4: Update the batch table with the new total units
        $this->prepdisp_model->update_batch_units($shelf->T04_BATCH_ID, $new_total_units);

        // Step 5: Delete the open shelf record
        $this->db->delete('IPSS_T04_OPEN_SHELF', ['T04_OPEN_ID' => $open_shelf_id]);

        // Step 6: Complete the transaction
        $this->db->trans_complete();

        // Step 7: Check if transaction was successful
        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('error', 'Something went wrong while deleting.');
            redirect(module_url("prepdisp/shelfList"));
            return;
        }

        // Step 8: Set success message and redirect
        $this->session->set_flashdata('success', 'Open shelf record deleted and batch updated successfully.');
        redirect(module_url("prepdisp/shelfList"));
    }

    public function prepDispForm()
    {
        // Get staff info from session
        $staff_id = isset($_SESSION['UID']) ? $_SESSION['UID'] : null;
        $staff_name = isset($_SESSION['STAFF']) ? $_SESSION['STAFF'] : null;

        // Check if session values exist, else show error
        if (!$staff_id || !$staff_name) {
            show_error('You must be logged in to access this page.');
            return;
        }

        // Get all drugs available on open shelf
        $drugs_on_shelf = $this->prepdisp_model->get_drugs_on_open_shelf();

        // Prepare data for the view
        $data['staff_id'] = $staff_id;
        $data['staff_name'] = $staff_name;
        $data['drugs_on_shelf'] = $drugs_on_shelf;

        // Load the form view
        $this->template->render('prepdisp/prepDispForm', $data);
    }

    public function prepareDispense()
    {
        // Step 1: Retrieve data from the POST request
        $open_id = $this->input->post("open_id");
        $disp_units = $this->input->post("disp_units");

        try {
            // Step 2: Get staff info from session
            $staff_name = strtoupper($_SESSION['STAFF']);

            // Step 3: Get current open shelf item details
            $shelf_item = $this->prepdisp_model->get_open_shelf_item($open_id);

            if (!$shelf_item) {
                $this->session->set_flashdata('error', 'Open shelf item not found.');
                redirect(module_url("prepdisp/prepDispForm"));
                return;
            }

            // Step 4: Validate that there are enough units on the shelf
            if ($shelf_item->T04_TOTAL_UNITS < $disp_units) {
                $this->session->set_flashdata('error', 'Not enough units available on the shelf.');
                redirect(module_url("prepdisp/prepDispForm"));
                return;
            }

            // Step 5: Calculate new total units for the open shelf item
            $new_shelf_units = $shelf_item->T04_TOTAL_UNITS - $disp_units;

            // Step 6: Start the transaction to ensure data consistency
            $this->db->trans_start();

            // Step 7: Update open shelf units
            $this->prepdisp_model->update_open_shelf_units($open_id, $new_shelf_units);

            // Step 8: Prepare data to insert into prepdisp table
            $data_to_prepdisp = [
                "T05_OPEN_ID" => $open_id,
                "T05_BATCH_ID" => $shelf_item->T04_BATCH_ID,
                "T05_DRUG_ID" => $shelf_item->T04_DRUG_ID,
                "T05_DISP_UNITS" => $disp_units,
                "T05_DISP_DATE" => date("d-M-Y"),
                "T05_STAFF_DISP" => $staff_name
            ];

            // Step 9: Insert the prepdisp data
            $this->prepdisp_model->insert_prepdisp($data_to_prepdisp);

            // Step 10: Complete the transaction
            $this->db->trans_complete();

            // Step 11: Check if transaction was successful
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Transaction failed');
            }

            // Redirect to prepdisp list page if successful
            $this->session->set_flashdata('success', 'Drug prepared and dispensed successfully.');
            redirect(module_url("prepdisp/prepDispList"));

        } catch (Exception $e) {
            // If an exception occurred, log the error and redirect
            $this->session->set_flashdata('error', 'Something went wrong.');
            redirect(module_url("prepdisp/prepDispForm"));
        }
    }

    public function prepDispList()
    {
        // Fetch records from the prepdisp table
        $prepdisp_records = $this->prepdisp_model->get_prepdisp_records();

        // Pass the prepdisp records to the view
        $data['prepdisp_records'] = $prepdisp_records;
        $this->template->render('prepdisp/prepDispList', $data);
    }

    public function getOpenShelfDetails()
    {
        $open_id = $this->input->post('open_id');
        $shelf_item = $this->prepdisp_model->get_open_shelf_item($open_id);
        echo json_encode($shelf_item);
    }

    //function to search drug by barcode
    public function searchByBarcode()
    {
        // Get the barcode from the POST request
        $barcode = $this->input->post('barcode');

        if (!$barcode) {
            echo json_encode(['status' => 'error', 'message' => 'No barcode provided']);
            return;
        }

        // Search for the batch with this barcode
        $batch = $this->prepdisp_model->get_batch_by_barcode($barcode);

        if (!$batch) {
            echo json_encode(['status' => 'error', 'message' => 'No batch found with this barcode']);
            return;
        }

        // Get additional drug information
        $drug_info = $this->prepdisp_model->get_drug_by_id($batch->T02_DRUG_ID);

        // Check if this batch is already on open shelf
        $open_shelf_items = $this->prepdisp_model->get_open_shelf_by_batch_id($batch->T02_BATCH_ID);

        // Return the batch, drug info, and open shelf status
        echo json_encode([
            'status' => 'success',
            'batch' => $batch,
            'drug' => $drug_info,
            'on_open_shelf' => !empty($open_shelf_items),
            'open_shelf_items' => $open_shelf_items
        ]);
    }

    //function to render shelfBarcode view form to get barcode to find the drug batch
    public function shelfBarcode()
    {
        // Get staff info from session
        $staff_id = isset($_SESSION['UID']) ? $_SESSION['UID'] : null;
        $staff_name = isset($_SESSION['STAFF']) ? $_SESSION['STAFF'] : null;

        // Check if session values exist, else show error
        if (!$staff_id || !$staff_name) {
            show_error('You must be logged in to access this page.');
            return;
        }

        // Prepare data for the view
        $data['staff_id'] = $staff_id;
        $data['staff_name'] = $staff_name;

        // Load the barcode scanning view
        $this->template->render('prepdisp/shelfBarcode', $data);
    }

    //Fucntion to move drug to shelf from barcode scan
    public function moveToShelfFromBarcode()
    {
        // Get data from POST
        $batch_id = $this->input->post("batch_id");
        $drug_id = $this->input->post("drug_id");
        $shelf_unit = $this->input->post("shelf_unit");

        try {
            // Get staff info
            $staff_name = strtoupper($_SESSION['STAFF']);

            // Get batch details
            $batch = $this->prepdisp_model->get_batch_by_id($batch_id);

            if (!$batch) {
                echo json_encode(['status' => 'error', 'message' => 'Batch not found.']);
                return;
            }

            // Validate units
            if ($batch->T02_TOTAL_UNITS < $shelf_unit) {
                echo json_encode(['status' => 'error', 'message' => 'Not enough units in batch.']);
                return;
            }

            // Calculate new batch units
            $new_total_units = $batch->T02_TOTAL_UNITS - $shelf_unit;

            // Start transaction
            $this->db->trans_start();

            // Update batch units
            $this->prepdisp_model->update_batch_units($batch_id, $new_total_units);

            // Check if this drug and batch already exists on shelf
            $existing_shelf_item = $this->db->get_where('IPSS_T04_OPEN_SHELF', [
                'T04_BATCH_ID' => $batch_id,
                'T04_DRUG_ID' => $drug_id
            ])->row();

            if ($existing_shelf_item) {
                // Update existing shelf record
                $new_shelf_units = $existing_shelf_item->T04_TOTAL_UNITS + $shelf_unit;
                $this->db->update(
                    'IPSS_T04_OPEN_SHELF',
                    ['T04_TOTAL_UNITS' => $new_shelf_units],
                    ['T04_OPEN_ID' => $existing_shelf_item->T04_OPEN_ID]
                );
            } else {
                // Create new shelf record
                $data_to_open_shelf = [
                    "T04_BATCH_ID" => $batch_id,
                    "T04_DRUG_ID" => $drug_id,
                    "T04_TOTAL_UNITS" => $shelf_unit,
                    "T04_DATE_ADDED" => date("d-M-Y"),
                    "T04_MOVED_BY" => $staff_name
                ];

                $this->prepdisp_model->insert_open_shelf($data_to_open_shelf);
            }

            // Complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(['status' => 'error', 'message' => 'Transaction failed.']);
                return;
            }

            echo json_encode(['status' => 'success', 'message' => 'Drug moved to open shelf successfully.']);

        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Something went wrong.']);
        }
    }

    
    //function to render dispenseBarcode view form to get barcode to find the drug batch
    public function dispenseBarcode()
    {
        // Get staff info from session
        $staff_id = isset($_SESSION['UID']) ? $_SESSION['UID'] : null;
        $staff_name = isset($_SESSION['STAFF']) ? $_SESSION['STAFF'] : null;

        // Check if session values exist, else show error
        if (!$staff_id || !$staff_name) {
            show_error('You must be logged in to access this page.');
            return;
        }

        // Prepare data for the view
        $data['staff_id'] = $staff_id;
        $data['staff_name'] = $staff_name;

        // Load the barcode scanning view
        $this->template->render('prepdisp/dispenseBarcode', $data);
    }

    public function searchOpenShelfByBarcode()
    {
        // Get the barcode from the POST request
        $barcode = $this->input->post('barcode');

        if (!$barcode) {
            echo json_encode(['status' => 'error', 'message' => 'No barcode provided']);
            return;
        }

        // Search for the batch with this barcode
        $batch = $this->prepdisp_model->get_batch_by_barcode($barcode);

        if (!$batch) {
            echo json_encode(['status' => 'error', 'message' => 'No batch found with this barcode']);
            return;
        }

        // Get drug information
        $drug = $this->prepdisp_model->get_drug_by_id($batch->T02_DRUG_ID);

        if (!$drug) {
            echo json_encode(['status' => 'error', 'message' => 'Drug information not found']);
            return;
        }

        // Get open shelf items for this batch
        $open_shelf_items = $this->prepdisp_model->get_open_shelf_by_batch_id($batch->T02_BATCH_ID);

        if (empty($open_shelf_items)) {
            echo json_encode(['status' => 'error', 'message' => 'This batch is not available on open shelf']);
            return;
        }

        // Return the batch, drug info, and open shelf items
        echo json_encode([
            'status' => 'success',
            'batch' => $batch,
            'drug' => $drug,
            'open_shelf_items' => $open_shelf_items
        ]);
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
