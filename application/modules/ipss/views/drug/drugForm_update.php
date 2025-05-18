<div class="card mx-auto mt-5 shadow-sm" style="max-width: 500px;">
    <div class="card-body">
        <h5 class="card-title text-center mb-4">Update Drug</h5>
        <form method="POST" action="<?php echo module_url('drug/updateDrug/' . $drug->T01_DRUG_ID) ?>">
            <!-- Hidden field to store the Drug ID -->
            <input type="hidden" name="drugId" value="<?= $drug->T01_DRUG_ID ?>" required>

            <div class="mb-3">
                <label for="drugs" class="form-label fw-semibold">Drug Name</label>
                <input type="text" class="form-control form-control-sm" id="drugs" placeholder="Drug Name" name="drugs"
                    value="<?= $drug->T01_DRUGS ?>" required>
            </div>

            <div class="mb-3">
                <label for="tradeName" class="form-label fw-semibold">Trade Name</label>
                <input type="text" class="form-control form-control-sm" id="tradeName" placeholder="Trade Name"
                    name="tradeName" value="<?= $drug->T01_TRADE_NAME ?>" required>
            </div>

            <div class="mb-3">
                <label for="minStock" class="form-label fw-semibold">Minimum Stock to Retain</label>
                <input type="text" class="form-control form-control-sm" id="minStock" placeholder="Minimum Stock"
                    name="minStock" value="<?= $drug->T01_MIN_STOCK ?>" required>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-sm">Update Drug</button>
            </div>
        </form>
    </div>
</div>


<script>

    //ToDo: the form validation doesnt allow the update if the user only change min stock, need to make it so that they can change
    document.addEventListener('DOMContentLoaded', function () {
        const drugsInput = document.getElementById('drugs');
        const tradeNameInput = document.getElementById('tradeName');
        const form = document.querySelector('form');

        let existingDrugs = [];

        // Fetch existing drugs and trade names
        fetch('<?php echo module_url("drug/getExistingDrugs"); ?>')
            .then(response => response.json())
            .then(data => {
                existingDrugs = data;
            })
            .catch(error => console.error('Error fetching existing drugs:', error));

        form.addEventListener('submit', function (e) {
            const enteredDrug = drugsInput.value.trim().toLowerCase();
            const enteredTradeName = tradeNameInput.value.trim().toLowerCase();
            const currentDrugId = "<?= $drug->T01_DRUG_ID ?>"; // Get current drug ID

            const duplicate = existingDrugs.some(record =>
                record.T01_DRUG_ID != currentDrugId && // Exclude current record
                record.T01_DRUGS.toLowerCase() === enteredDrug &&
                record.T01_TRADE_NAME.toLowerCase() === enteredTradeName
            );

            if (duplicate) {
                e.preventDefault();
                alert('The combination of Drug Name and Trade Name already exists. Please enter a different combination.');
            }
        });

    });
</script>