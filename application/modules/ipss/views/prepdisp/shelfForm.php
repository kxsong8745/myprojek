<div class="d-flex justify-content-center">
    <div class="card" style="width: 50%;">
        <div class="card-header text-center">
            <h5>Move Drug to Open Shelf</h5>
        </div>
        <div class="card-body">
            <?= form_open(module_url('prepdisp/openShelf'), array('id' => 'shelfForm', 'class' => 'needs-validation', 'novalidate' => true)) ?>

            <!-- Staff (User taken from session) -->
            <!-- Hidden field to send staff ID -->
            <input type="hidden" name="staff_id" value="<?= $staff_id ?>">

            <!-- Display staff name -->
            <p>Logged in as: <strong><?= strtoupper($staff_name) ?></strong></p>

            <!-- Drug -->
            <div class="form-group">
                <label for="drug_id">Drug</label>
                <select name="drug_id" id="drug_id" class="form-control form-control-sm" required>
                    <option value="">Select Drug</option>
                    <?php foreach ($drugs as $drug): ?>
                        <option value="<?= $drug->T01_DRUG_ID ?>"><?= $drug->T01_DRUGS ?> (<?= $drug->T01_TRADE_NAME ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Batch -->
            <div class="form-group">
                <label for="batch_id">Batch</label>
                <select name="batch_id" id="batch_id" class="form-control form-control-sm" required>
                    <option value="">Select Drug First</option>
                </select>
            </div>

            <!-- Units -->
            <div class="form-group">
                <label for="shelf_unit">Units</label>
                <input type="number" name="shelf_unit" id="shelf_unit" class="form-control form-control-sm" min="1"
                    required>
            </div>

            <!-- Date (Automatically set to today) -->
            <div class="form-group">
                <label for="shelf_date">Date Added</label>
                <input type="date" class="form-control" id="shelf_date" name="shelf_date" value="<?= date('Y-m-d') ?>">
                <small class="form-text text-muted">Date when drug is moved to open shelf (defaults to today)</small>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary btn-sm btn-block">Move to Open Shelf</button>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    // Load batches dynamically based on selected drug
    $('#drug_id').change(function () {
        const drugId = $(this).val();
        if (drugId) {
            $.post('<?= module_url('prepdisp/getBatchesByDrug') ?>', { drug_id: drugId }, function (response) {
                const batches = JSON.parse(response);
                let options = '<option value="">Select Batch</option>';
                batches.forEach(batch => {
                    options += `<option value="${batch.T02_BATCH_ID}" 
                                    data-units="${batch.T02_TOTAL_UNITS}">
                                    Batch ID: ${batch.T02_BATCH_ID} | Units: ${batch.T02_TOTAL_UNITS}
                                </option>`;
                });
                $('#batch_id').html(options);
            });
        } else {
            $('#batch_id').html('<option value="">Select a drug first</option>');
        }
    });

    // Validate shelf unit against available batch units
    $('#shelf_unit').on('input', function () {
        const selectedBatch = $('#batch_id option:selected');
        const availableUnits = parseInt(selectedBatch.data('units') || 0, 10);
        const enteredUnits = parseInt($(this).val(), 10);

        if (enteredUnits > availableUnits) {
            alert(`⚠️ The entered units exceed the available stock (${availableUnits} units).`);
            $(this).val(''); // Clear the input field
        }
    });

    // Reset batch and shelf unit fields when drug selection changes
    $('#drug_id').change(function () {
        $('#batch_id').html('<option value="">Select Batch</option>');
        $('#shelf_unit').val('');
    });
</script>