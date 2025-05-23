<?php
class Prepdisp extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        // session_start();
        $this->load->model("prepdisp_model");
    }

    public function openShelf()
    {
        $batch_id = $this->input->post("batch_id");
        $drug_id = $this->input->post("drug_id");
        $shelf_unit = $this->input->post("shelf_unit");
        $shelf_date = $this->input->post("shelf_date"); // New field for date input

        try {
            $staff_name = strtoupper($_SESSION['STAFF']);
            $batch = $this->prepdisp_model->get_batch_by_id($batch_id);

            if (!$batch) {
                $this->session->set_flashdata('error', 'Batch not found.');
                redirect(module_url("prepdisp/shelfForm"));
                return;
            }
            //Validate that there are enough units in the batch
            if ($batch->T02_TOTAL_UNITS < $shelf_unit) {
                $this->session->set_flashdata('error', 'Not enough units in batch.');
                redirect(module_url("prepdisp/shelfForm"));
                return;
            }
            // Calculate new total units for the batch
            $new_total_units = $batch->T02_TOTAL_UNITS - $shelf_unit;
            // Format the date or use current date if not provided
            $formatted_date = !empty($shelf_date) ? date("d-M-Y", strtotime($shelf_date)) : date("d-M-Y");
            $this->db->trans_start();
            // Update batch unit after moving to open shelf
            $this->prepdisp_model->update_batch_units($batch_id, $new_total_units);

            //Check if the same drug batch already exists on the open shelf
            $existing_shelf_item = $this->db->get_where('IPSS_T04_OPEN_SHELF', ['T04_BATCH_ID' => $batch_id,'T04_DRUG_ID' => $drug_id])->row();

            if ($existing_shelf_item) {
                // If the same drug batch exists, update the existing record
                $new_shelf_units = $existing_shelf_item->T04_TOTAL_UNITS + $shelf_unit;
                $new_ori_moved = $existing_shelf_item->T04_ORI_MOVED + $shelf_unit;
                $this->db->update(
                    'IPSS_T04_OPEN_SHELF',
                    ['T04_TOTAL_UNITS' => $new_shelf_units,'T04_ORI_MOVED' => $new_ori_moved],
                    ['T04_OPEN_ID' => $existing_shelf_item->T04_OPEN_ID]
                );
            } else {
                // If no existing record, insert a new one
                $data_to_open_shelf = [
                    "T04_BATCH_ID" => $batch_id,
                    "T04_DRUG_ID" => $drug_id,
                    "T04_TOTAL_UNITS" => $shelf_unit,
                    "T04_ORI_MOVED" => $shelf_unit, 
                    "T04_DATE_ADDED" => $formatted_date,
                    "T04_MOVED_BY" => $staff_name
                ];

                $this->prepdisp_model->insert_open_shelf($data_to_open_shelf);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Transaction failed');
            }

            $this->session->set_flashdata('success', 'Drug moved to open shelf successfully.');
            redirect(module_url("prepdisp/shelfList"));

        } catch (Exception $e) {
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
        $staff_id = isset($_SESSION['UID']) ? $_SESSION['UID'] : null;
        $staff_name = isset($_SESSION['STAFF']) ? $_SESSION['STAFF'] : null;

        if (!$staff_id || !$staff_name) {
            show_error('You must be logged in to access this page.');
            return;
        }

        $data['staff_id'] = $staff_id;
        $data['staff_name'] = $staff_name;
        $data['drugs'] = $this->prepdisp_model->get_all_drugs();

        $this->template->render('prepdisp/shelfForm', $data);
    }

    public function shelfList()
    {
        $open_shelves = $this->prepdisp_model->get_open_shelf_records();
        $this->template->set("open_shelves", $open_shelves);
        $this->template->render();
    }

    public function delete_shelf_record($open_shelf_id)
    {
        $shelf = $this->db->get_where('IPSS_T04_OPEN_SHELF', ['T04_OPEN_ID' => $open_shelf_id])->row();

        if (!$shelf) {
            $this->session->set_flashdata('error', 'Open shelf record not found.');
            redirect(module_url("prepdisp/shelfList"));
            return;
        }

        $batch = $this->prepdisp_model->get_batch_by_id($shelf->T04_BATCH_ID);

        if (!$batch) {
            $this->session->set_flashdata('error', 'Batch not found.');
            redirect(module_url("prepdisp/shelfList"));
            return;
        }
        //Update the batch total units (add back the units removed from the shelf)
        $new_total_units = $batch->T02_TOTAL_UNITS + $shelf->T04_TOTAL_UNITS;

        $this->db->trans_start();
        //Update the batch table
        $this->prepdisp_model->update_batch_units($shelf->T04_BATCH_ID, $new_total_units);
        $this->db->delete('IPSS_T04_OPEN_SHELF', ['T04_OPEN_ID' => $open_shelf_id]);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('error', 'Something went wrong while deleting.');
            redirect(module_url("prepdisp/shelfList"));
            return;
        }

        $this->session->set_flashdata('success', 'Open shelf record deleted and batch updated successfully.');
        redirect(module_url("prepdisp/shelfList"));
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
        $barcode = $this->input->post('barcode');

        if (!$barcode) {
            echo json_encode(['status' => 'error', 'message' => 'No barcode provided']);
            return;
        }
        //Search for the batch with this barcode
        $batch = $this->prepdisp_model->get_batch_by_barcode($barcode);

        if (!$batch) {
            echo json_encode(['status' => 'error', 'message' => 'No batch found with this barcode']);
            return;
        }

        $drug_info = $this->prepdisp_model->get_drug_by_id($batch->T02_DRUG_ID);

        if (!$drug_info) {
            echo json_encode(['status' => 'error', 'message' => 'Associated drug information not found']);
            return;
        }

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

    //shelfBarcode form to scan barcode
    public function shelfBarcode()
    {
        $staff_id = isset($_SESSION['UID']) ? $_SESSION['UID'] : null;
        $staff_name = isset($_SESSION['STAFF']) ? $_SESSION['STAFF'] : null;

        if (!$staff_id || !$staff_name) {
            show_error('You must be logged in to access this page.');
            return;
        }

        $data['staff_id'] = $staff_id;
        $data['staff_name'] = $staff_name;

        $this->template->render('prepdisp/shelfBarcode', $data);
    }

    //Fucntion to move drug to shelf from barcode scan
    public function moveToShelfFromBarcode()
    {
        $batch_id = $this->input->post("batch_id");
        $drug_id = $this->input->post("drug_id");
        $shelf_unit = $this->input->post("shelf_unit");
        $shelf_date = $this->input->post("shelf_date"); // New field for date input

        try {
            $staff_name = strtoupper($_SESSION['STAFF']);
            $batch = $this->prepdisp_model->get_batch_by_id($batch_id);

            if (!$batch) {
                echo json_encode(['status' => 'error', 'message' => 'Batch not found.']);
                return;
            }
            // make sure the unit to be moved to open shelf does not exceed the units in drug batch inventory
            if ($batch->T02_TOTAL_UNITS < $shelf_unit) {
                echo json_encode(['status' => 'error', 'message' => 'Not enough units in batch.']);
                return;
            }
            // Calculate new batch units after moving the units to open shelf
            $new_total_units = $batch->T02_TOTAL_UNITS - $shelf_unit;
            // Format the date or use current date if not provided
            $formatted_date = !empty($shelf_date) ? date("d-M-Y", strtotime($shelf_date)) : date("d-M-Y");

            $this->db->trans_start();
            $this->prepdisp_model->update_batch_units($batch_id, $new_total_units);

            // Check if this drug and batch already exists on shelf (1 record for a drug batch)
            $existing_shelf_item = $this->db->get_where('IPSS_T04_OPEN_SHELF', [ 'T04_BATCH_ID' => $batch_id, 'T04_DRUG_ID' => $drug_id ])->row();

            if ($existing_shelf_item) {
                //if the shelf record already exist, update existing shelf record by adding to the existing record
                $new_shelf_units = $existing_shelf_item->T04_TOTAL_UNITS + $shelf_unit;
                $new_ori_moved = $existing_shelf_item->T04_ORI_MOVED + $shelf_unit; // Update original moved units
                $this->db->update(
                    'IPSS_T04_OPEN_SHELF',
                    [
                        'T04_TOTAL_UNITS' => $new_shelf_units,
                        'T04_ORI_MOVED' => $new_ori_moved
                    ],
                    ['T04_OPEN_ID' => $existing_shelf_item->T04_OPEN_ID]
                );
            } else {
                // Create new shelf record if no record for this drug batch was created yet
                $data_to_open_shelf = [
                    "T04_BATCH_ID" => $batch_id,
                    "T04_DRUG_ID" => $drug_id,
                    "T04_TOTAL_UNITS" => $shelf_unit,
                    "T04_ORI_MOVED" => $shelf_unit, 
                    "T04_DATE_ADDED" => $formatted_date, 
                    "T04_MOVED_BY" => $staff_name
                ];

                $this->prepdisp_model->insert_open_shelf($data_to_open_shelf);
            }

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

    //function to use barcode for preparation
    public function searchOpenShelfByBarcode()
    {
        $barcode = $this->input->post('barcode');

        if (!$barcode) {
            echo json_encode(['status' => 'error', 'message' => 'No barcode provided']);
            return;
        }

        $batch = $this->prepdisp_model->get_batch_by_barcode($barcode);

        if (!$batch) {
            echo json_encode(['status' => 'error', 'message' => 'No batch found with this barcode']);
            return;
        }

        $drug = $this->prepdisp_model->get_drug_by_id($batch->T02_DRUG_ID);

        if (!$drug) {
            echo json_encode(['status' => 'error', 'message' => 'Drug information not found']);
            return;
        }

        $open_shelf_items = $this->prepdisp_model->get_open_shelf_by_batch_id($batch->T02_BATCH_ID);
        $is_on_shelf = !empty($open_shelf_items);
        // Return the batch, drug info, and open shelf items
        echo json_encode([
            'status' => 'success',
            'batch' => $batch,
            'drug' => $drug,
            'on_open_shelf' => $is_on_shelf,
            'open_shelf_items' => $open_shelf_items
        ]);

    }

    public function prepForm()
    {
        $staff_id = isset($_SESSION['UID']) ? $_SESSION['UID'] : null;
        $staff_name = isset($_SESSION['STAFF']) ? $_SESSION['STAFF'] : null;

        if (!$staff_id || !$staff_name) {
            show_error('You must be logged in to access this page.');
            return;
        }

        $drugs_on_shelf = $this->prepdisp_model->get_drugs_on_open_shelf();
        $data['staff_id'] = $staff_id;
        $data['staff_name'] = $staff_name;
        $data['drugs_on_shelf'] = $drugs_on_shelf;

        $this->template->render('prepdisp/prepForm', $data);
    }

    //function to handle preparation
    public function prepare()
    {
        $open_id = $this->input->post("open_id");
        $prep_units = $this->input->post("prep_units");

        try {
            $staff_name = strtoupper($_SESSION['STAFF']);
            $shelf_item = $this->prepdisp_model->get_open_shelf_item($open_id);

            if (!$shelf_item) {
                $this->session->set_flashdata('error', 'Open shelf item not found.');
                redirect(module_url("prepdisp/prepForm"));
                return;
            }
            // check that there are enough units on the shelf
            if ($shelf_item->T04_TOTAL_UNITS < $prep_units) {
                $this->session->set_flashdata('error', 'Not enough units available on the shelf.');
                redirect(module_url("prepdisp/prepForm"));
                return;
            }

            $new_shelf_units = $shelf_item->T04_TOTAL_UNITS - $prep_units;
            $this->db->trans_start();
            $this->prepdisp_model->update_open_shelf_units($open_id, $new_shelf_units);

            $data_to_prep = [
                "T05_OPEN_ID" => $open_id,
                "T05_BATCH_ID" => $shelf_item->T04_BATCH_ID,
                "T05_DRUG_ID" => $shelf_item->T04_DRUG_ID,
                "T05_STAFF_PREP" => $staff_name,
                "T05_PREP_UNITS" => $prep_units
            ];

            $prep_id = $this->prepdisp_model->insert_prep($data_to_prep);
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Transaction failed');
            }

            $this->session->set_flashdata('success', 'Drug prepared successfully.');
            redirect(module_url("prepdisp/prepList"));

        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Something went wrong.');
            redirect(module_url("prepdisp/prepForm"));
        }
    }

    public function prepList()
    {
        $prep_records = $this->prepdisp_model->get_prep_records();
        $data['prep_records'] = $prep_records;

        $this->template->render('prepdisp/prepList', $data);
    }

    public function dispForm()
    {
        $staff_id = isset($_SESSION['UID']) ? $_SESSION['UID'] : null;
        $staff_name = isset($_SESSION['STAFF']) ? $_SESSION['STAFF'] : null;

        if (!$staff_id || !$staff_name) {
            show_error('You must be logged in to access this page.');
            return;
        }

        $prepared_drugs = $this->prepdisp_model->get_prepared_drugs();
        $data['staff_id'] = $staff_id;
        $data['staff_name'] = $staff_name;
        $data['prepared_drugs'] = $prepared_drugs;

        $this->template->render('prepdisp/dispForm', $data);
    }

    //for dispensing drug from preparation
    public function dispense()
    {
        $prep_id = $this->input->post("prep_id");
        $disp_units = $this->input->post("disp_units");
        $disp_date = $this->input->post('disp_date');

        try {
            $staff_name = strtoupper($_SESSION['STAFF']);
            $prep_item = $this->prepdisp_model->get_prep_by_id($prep_id);

            if (!$prep_item) {
                $this->session->set_flashdata('error', 'Preparation record not found.');
                redirect(module_url("prepdisp/dispForm"));
                return;
            }

            // Validate that there are enough units in the preparation
            if ($prep_item->T05_PREP_UNITS < $disp_units) {
                $this->session->set_flashdata('error', 'Not enough units available in preparation.');
                redirect(module_url("prepdisp/dispForm"));
                return;
            }

            $formatted_date = date('d-M-Y H:i:s', strtotime($disp_date));
            // Get drug and batch information for the disp table
            $drug_info = $this->prepdisp_model->get_drug_by_id($prep_item->T05_DRUG_ID);
            $batch_info = $this->prepdisp_model->get_batch_by_id($prep_item->T05_BATCH_ID);

            $this->db->trans_start();

            $data_to_disp = [
                "T08_PREP_ID" => $prep_id,
                "T08_DRUG_NAME" => $drug_info->T01_DRUGS,
                "T08_BATCH_NO" => $batch_info->T02_BATCH_ID ?? null,
                "T08_DISP_UNITS" => $disp_units,
                "T08_DISP_DATE" => $formatted_date,
                "T08_STAFF_DISP" => $staff_name
            ];

            $this->prepdisp_model->insert_disp($data_to_disp);
            $this->prepdisp_model->delete_prep($prep_id);
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Transaction failed');
            }
            $this->session->set_flashdata('success', 'Drug dispensed successfully.');
            redirect(module_url("prepdisp/dispList"));

        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Something went wrong: ' . $e->getMessage());
            redirect(module_url("prepdisp/dispForm"));
        }
    }

    public function dispList()
    {
        $disp_records = $this->prepdisp_model->get_disp_records();
        $data['disp_records'] = $disp_records;
        $this->template->render('prepdisp/dispList', $data);
    }

    public function getPrepDetails()
    {
        $prep_id = $this->input->post('prep_id');
        $prep_item = $this->prepdisp_model->get_prep_by_id($prep_id);
        echo json_encode($prep_item);
    }

    //for barcode scanning for preparation
    public function prepBarcode()
    {
        $staff_id = isset($_SESSION['UID']) ? $_SESSION['UID'] : null;
        $staff_name = isset($_SESSION['STAFF']) ? $_SESSION['STAFF'] : null;

        if (!$staff_id || !$staff_name) {
            show_error('You must be logged in to access this page.');
            return;
        }

        $data['staff_id'] = $staff_id;
        $data['staff_name'] = $staff_name;

        $this->template->render('prepdisp/prepBarcode', $data);
    }

    //if the user intend to remove the drug from preparation list and return the drug to open shelf
    public function remove_prep($prep_id)
    {
        try {
            $prep_item = $this->prepdisp_model->get_prep_by_id($prep_id);

            if (!$prep_item) {
                $this->session->set_flashdata('error', 'Preparation record not found.');
                redirect(module_url("prepdisp/prepList"));
                return;
            }
            //Get the open shelf item associated with this preparation
            $open_shelf_item = $this->prepdisp_model->get_shelf_by_id($prep_item->T05_OPEN_ID);

            if (!$open_shelf_item) {
                $this->session->set_flashdata('error', 'Open shelf record not found.');
                redirect(module_url("prepdisp/prepList"));
                return;
            }

            $this->db->trans_start();
            //Calculate new total units for the open shelf
            $new_shelf_units = $open_shelf_item->T04_TOTAL_UNITS + $prep_item->T05_PREP_UNITS;

            $this->prepdisp_model->update_open_shelf_units($prep_item->T05_OPEN_ID, $new_shelf_units);
            $this->prepdisp_model->delete_prep($prep_id);
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Transaction failed');
            }

            $this->session->set_flashdata('success', 'Preparation removed and units returned to shelf successfully.');
            redirect(module_url("prepdisp/prepList"));

        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Something went wrong: ' . $e->getMessage());
            redirect(module_url("prepdisp/prepList"));
        }
    }
}