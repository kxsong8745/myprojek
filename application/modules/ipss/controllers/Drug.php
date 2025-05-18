<?php

class Drug extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model("drug_model");
        // session_start();
    }

    public function drugForm_add()
    {
        $this->template->render();
    }

    // List all drugs
    public function listDrugs()
    {
        $search = $this->input->get('search'); // Get the search query from the URL

        if ($search) {
            $data = $this->drug_model->searchDrugs($search); // Fetch filtered drugs
        } else {
            $data = $this->drug_model->getAllDrugs(); // Fetch all drugs
        }

        $this->template->title("Drug List");
        $this->template->set("data", $data);
        $this->template->set("search", $search); // Pass the search query to the view
        $this->template->render();
    }

    public function getExistingDrugs()
    {
        //Load the model
        $this->load->model('drug_model');

        //Fetch existing drugs and trade names
        $existingDrugs = $this->drug_model->getDrugRecord();

        //Return as JSON for JavaScript in view
        echo json_encode($existingDrugs);
    }

    public function drugForm_update($drugId)
    {   //drugfrom view function to update the drug
        $drug = $this->db
            ->where("T01_DRUG_ID", $drugId)
            ->get("IPSS_T01_DRUG")
            ->row();

        $this->template->set("drug", $drug);
        $this->template->render();
    }
    //add new drug record
    public function addDrug()
    {
        $drugs = $this->input->post("drugs");
        $tradeName = $this->input->post("tradeName");
        $minStock = $this->input->post("minStock");

        try {
            // Check if the drug already exists
            $drug = $this->drug_model->getDrugByDetails($drugs, $tradeName, $minStock);

            if ($drug) {
                // Drug already exists, redirect to list
                redirect(module_url("drug/listDrugs"));
                return;
            } else {
                // Insert new drug
                $data_to_drug = [
                    "T01_DRUGS" => $drugs,
                    "T01_TRADE_NAME" => $tradeName,
                    "T01_MIN_STOCK" => $minStock
                ];
                $this->drug_model->createDrug($data_to_drug); // Insert and get drug ID
            }

            // Redirect to batch insertion page with the drug ID
            redirect(module_url("drug/listDrugs"));

        } catch (Exception $e) {
            // Handle errors
            redirect(module_url("drug/drugForm_add"));
        }
    }

    //update Drug
    public function updateDrug($drugId)
    {
        $drugs = $this->input->post("drugs");
        $tradeName = $this->input->post("tradeName");
        $minStock = $this->input->post("minStock");

        try {
            // Update the drug details
            $data_to_update = [
                "T01_DRUGS" => $drugs,
                "T01_TRADE_NAME" => $tradeName,
                "T01_MIN_STOCK" => $minStock
            ];
            $this->drug_model->updateDrug($drugId, $data_to_update);

            $this->session->set_flashdata('success', 'Drug updated successfully');
            redirect(module_url("drug/listDrugs"));
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Error updating drug: ' . $e->getMessage());
            redirect(module_url("drug/drugForm_update/$drugId"));
        }
    }

    //From here on the controller function for drug batches
    //Form to add a drug batch 
    public function formAddBatch($drugId)
    {
        $drug = $this->drug_model->getDrugById($drugId);
        $tenderers = $this->drug_model->getAllTenderers();

        // Set the data for the view
        $this->template->set('drug', $drug);
        $this->template->set('tenderers', $tenderers);
        $this->template->title("Add Batch for Drug: " . $drug->T01_DRUGS);
        $this->template->render();
    }

    //Form to update a drug batch
    public function formUpdateBatch($batchId)
    {
        $batch = $this->db
            ->select('IPSS_T02_DBATCH.*, IPSS_T01_DRUG.T01_DRUGS, IPSS_T01_DRUG.T01_TRADE_NAME, IPSS_T03_TENDERER.T03_TEND_NAME')
            ->from('IPSS_T02_DBATCH')
            ->join('IPSS_T01_DRUG', 'IPSS_T02_DBATCH.T02_DRUG_ID = IPSS_T01_DRUG.T01_DRUG_ID', 'left')
            ->join('IPSS_T03_TENDERER', 'IPSS_T02_DBATCH.T02_TENDERER_ID = IPSS_T03_TENDERER.T03_TEND_ID', 'left')
            ->where('IPSS_T02_DBATCH.T02_BATCH_ID', $batchId)
            ->get()
            ->row();

        if (!$batch) {
            $this->session->set_flashdata('error', 'Batch not found.');
            redirect(module_url("drug/listDrugs"));
            return;
        }

        $tenderers = $this->drug_model->getAllTenderers();

        // Set batch data for the view
        $this->template->set('batch', $batch);
        $this->template->set('tenderers', $tenderers);
        $this->template->title("Update Batch for Drug: " . $batch->T01_DRUGS . " (" . $batch->T01_TRADE_NAME . ")");
        $this->template->render();
    }

    //add batch data insertion
    public function addBatch($drugId)
    {
        $tendererId = $this->input->post("tendererId");
        $packageQty = $this->input->post("packageQty");
        $totalPricePackageQty = $this->input->post("totalPricePackageQty");
        $unitPerPackage = $this->input->post("unitPerPackage");
        $totalUnits = $this->input->post("totalUnits");
        $poNo = $this->input->post("poNo");
        $pricePerUnit = $this->input->post("pricePerUnit");
        $manufacturedDate = $this->input->post("manufacturedDate");
        $expiryDate = $this->input->post("expiryDate");
        $recordDate = $this->input->post("recordDate");
        $barcodeNum = $this->input->post("barcodeNum");

        try {
            $mfgDate = new DateTime($manufacturedDate);
            $expDate = new DateTime($expiryDate);
            $recDate = new DateTime($recordDate);

            // Check if manufactured date is before expiry date
            if ($mfgDate >= $expDate) {
                $this->session->set_flashdata('error', 'Manufactured date must be before expiry date');
                redirect(module_url("drug/formAddBatch/" . $drugId));
                return;
            }

            // Set date format of d-m-y for insertion from html view
            $formattedMfgDate = $mfgDate->format('d-M-Y');
            $formattedExpDate = $expDate->format('d-M-Y');
            $formattedRecDate = $recDate->format('d-M-Y');

            // Prepare batch data for insertion
            $data_to_batch = [
                "T02_DRUG_ID" => $drugId,
                "T02_TENDERER_ID" => $tendererId, // updated
                "T02_PACKAGE_QUANTITY" => $packageQty,
                "T02_TP_PACKAGE_QUANTITY" => $totalPricePackageQty,
                "T02_UNIT_PER_PACKAGE" => $unitPerPackage,
                "T02_TOTAL_UNITS" => $totalUnits,
                "T02_PO_NO" => $poNo,
                "T02_PRICE_PER_UNIT" => $pricePerUnit,
                "T02_MFD_DATE" => $formattedMfgDate,
                "T02_EXP_DATE" => $formattedExpDate,
                "T02_RECORD_DATE" => $formattedRecDate,
                "T02_BARCODE_NUM" => $barcodeNum
            ];

            // Insert the batch data
            $result = $this->drug_model->createBatch($data_to_batch);

            if ($result) {
                $this->session->set_flashdata('success', 'Batch added successfully');
            } else {
                $this->session->set_flashdata('error', 'Error adding batch');
            }
            redirect(module_url("drug/viewBatches/" . $drugId));

        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Error adding batch: ' . $e->getMessage());
            redirect(module_url("drug/formAddBatch/" . $drugId));
        }
    }

    //update batch data
    public function updateBatch($batchId)
    {
        $tendererId = $this->input->post("tendererId");
        $packageQty = $this->input->post("packageQty");
        $totalPricePackageQty = $this->input->post("totalPricePackageQty");
        $unitPerPackage = $this->input->post("unitPerPackage");
        $totalUnits = $this->input->post("totalUnits");
        $poNo = $this->input->post("poNo");
        $pricePerUnit = $this->input->post("pricePerUnit");
        $manufacturedDate = $this->input->post("manufacturedDate");
        $expiryDate = $this->input->post("expiryDate");
        $recordDate = $this->input->post("recordDate");
        $barcodeNum = $this->input->post("barcodeNum");

        try {
            $mfgDate = new DateTime($manufacturedDate);
            $expDate = new DateTime($expiryDate);
            $recDate = new DateTime($recordDate);

            // Validate dates
            if ($mfgDate >= $expDate) {
                $this->session->set_flashdata('error', 'Manufactured date must be before expiry date');
                redirect(module_url("drug/formUpdateBatch/$batchId"));
                return;
            }

            // Prepare data for update
            $data_to_update = [
                "T02_TENDERER_ID" => $tendererId, // updated
                "T02_PACKAGE_QUANTITY" => $packageQty,
                "T02_TP_PACKAGE_QUANTITY" => $totalPricePackageQty,
                "T02_UNIT_PER_PACKAGE" => $unitPerPackage,
                "T02_TOTAL_UNITS" => $totalUnits,
                "T02_PO_NO" => $poNo,
                "T02_PRICE_PER_UNIT" => $pricePerUnit,
                "T02_MFD_DATE" => $mfgDate->format('d-M-Y'),
                "T02_EXP_DATE" => $expDate->format('d-M-Y'),
                "T02_RECORD_DATE" => $recDate->format('d-M-Y'),
                "T02_BARCODE_NUM" => $barcodeNum
            ];

            $this->drug_model->updateBatch($batchId, $data_to_update);

            $this->session->set_flashdata('success', 'Batch updated successfully');
            redirect(module_url("drug/viewBatches/" . $this->drug_model->getDrugIdByBatch($batchId)));
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Error updating batch: ' . $e->getMessage());
            redirect(module_url("drug/formUpdateBatch/$batchId"));
        }
    }

    //viewBatches view function
    public function viewBatches($drugId)
    {
        // Retrieve the drug details and batch
        $drug = $this->drug_model->getDrugById($drugId);
        $batches = $this->drug_model->getBatchesByDrugId($drugId);

        // Prepare data to pass to the view (drug deatails and list of batch of the drug)
        $data = [
            'drug' => $drug,     
            'batches' => $batches
        ];

        // Set the data for the view
        $this->template->set('data', $data);
        $this->template->title("Batch List for Drug: " . $drug->T01_DRUGS . " (" . $drug->T01_TRADE_NAME . ")");
        $this->template->render();
    }

    //deleting a drug batch
    public function deleteBatch($batchId)
    {
        try {
            $drugId = $this->drug_model->getDrugIdByBatch($batchId);
            $this->drug_model->deleteBatch($batchId);

            $this->session->set_flashdata('success', 'Batch deleted successfully');
            redirect(module_url("drug/viewBatches/$drugId"));
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Error deleting batch: ' . $e->getMessage());
            redirect(module_url("drug/viewBatches/$drugId"));
        }
    }

    // public function addTenderer()
    // {
    //     //ToDo: Fucntion for setting up tenderer
    // }
}
