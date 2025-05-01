<div class="d-flex justify-content-center">
    <div class="card" style="width: 50%;">
        <div class="card-header text-center">
            <h5>Prepare and Dispense Drug</h5>
        </div>
        <div class="card-body">
            <?= form_open(module_url('prepdisp/prepareDispense'), array('id' => 'prepDispForm', 'class' => 'needs-validation', 'novalidate' => true)) ?>

            <!-- Staff (User taken from session) -->
            <!-- Hidden field to send staff ID -->
            <input type="hidden" name="staff_id" value="<?= $staff_id ?>">

            <!-- Display staff name -->
            <p>Dispensed by: <strong><?= strtoupper($staff_name) ?></strong></p>

            <!-- Drug on Open Shelf -->
            <div class="form-group">
                <label for="open_id">Select Drug from Open Shelf</label>
                <select name="open_id" id="open_id" class="form-control form-control-sm" required>
                    <option value="">Select Drug</option>
                    <?php foreach ($drugs_on_shelf as $item): ?>
                        <option value="<?= $item->T04_OPEN_ID ?>" 
                                data-units="<?= $item->T04_TOTAL_UNITS ?>"
                                data-drug="<?= $item->drug_name ?>"
                                data-trade="<?= $item->trade_name ?>"
                                data-exp="<?= $item->T02_EXP_DATE ?>">
                            <?= $item->drug_name ?> (<?= $item->trade_name ?>) - 
                            Batch: <?= $item->T04_BATCH_ID ?> - 
                            Available: <?= $item->T04_TOTAL_UNITS ?> units - 
                            Expires: <?= $item->T02_EXP_DATE ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Drug Details Display -->
            <div id="drug-details" class="card mt-3 mb-3 d-none">
                <div class="card-header">
                    <h6>Selected Drug Details</h6>
                </div>
                <div class="card-body">
                    <p><strong>Drug:</strong> <span id="detail-drug"></span></p>
                    <p><strong>Trade Name:</strong> <span id="detail-trade"></span></p>
                    <p><strong>Available Units:</strong> <span id="detail-units"></span></p>
                    <p><strong>Expiry Date:</strong> <span id="detail-expiry"></span></p>
                </div>
            </div>

            <!-- Units to Dispense -->
            <div class="form-group">
                <label for="disp_units">Units to Dispense</label>
                <input type="number" name="disp_units" id="disp_units" class="form-control form-control-sm" min="1" required>
            </div>

            <!-- Date (Automatically set to today) -->
            <div class="form-group">
                <label for="disp_date">Date</label>
                <input type="date" name="disp_date" id="disp_date" class="form-control form-control-sm"
                    value="<?= date('Y-m-d') ?>" readonly>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary btn-sm btn-block">Prepare and Dispense</button>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    // Show drug details when a drug is selected
    $('#open_id').change(function() {
        const selectedOption = $(this).find('option:selected');
        
        if (selectedOption.val()) {
            // Display the selected drug details
            $('#detail-drug').text(selectedOption.data('drug'));
            $('#detail-trade').text(selectedOption.data('trade'));
            $('#detail-units').text(selectedOption.data('units'));
            $('#detail-expiry').text(selectedOption.data('exp'));
            $('#drug-details').removeClass('d-none');
            
            // Reset the dispense units field
            $('#disp_units').val('');
        } else {
            // Hide the details card if no drug is selected
            $('#drug-details').addClass('d-none');
        }
    });

    // Validate dispense units against available units
    $('#disp_units').on('input', function() {
        const selectedOption = $('#open_id option:selected');
        const availableUnits = parseInt(selectedOption.data('units') || 0);
        const enteredUnits = parseInt($(this).val());

        if (enteredUnits > availableUnits) {
            alert(`⚠️ The entered units exceed the available stock (${availableUnits} units).`);
            $(this).val('');
        }
    });
</script>


