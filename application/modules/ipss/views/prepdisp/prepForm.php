<div class="d-flex justify-content-center">
    <div class="card" style="width: 50%;">
        <div class="card-header text-center">
            <h5>Prepare Drug from Open Shelf</h5>
        </div>
        <div class="card-body">
            <?= form_open(module_url('prepdisp/prepare'), array('class' => 'needs-validation', 'novalidate' => true)) ?>

            <div class="form-group">
                <label for="drug_select">Select Drug</label>
                <select class="form-control" id="drug_select" required>
                    <option value="">-- Select Drug --</option>
                    <?php foreach ($drugs_on_shelf as $drug_shelf) : ?>
                        <option value="<?= $drug_shelf->T04_OPEN_ID ?>" 
                                data-name="<?= $drug_shelf->drug_name ?>" 
                                data-trade="<?= $drug_shelf->trade_name ?>"
                                data-units="<?= $drug_shelf->T04_TOTAL_UNITS ?>"
                                data-expiry="<?= $drug_shelf->T02_EXP_DATE ?>">
                            <?= $drug_shelf->drug_name ?> (<?= $drug_shelf->trade_name ?>) - <?= $drug_shelf->T04_TOTAL_UNITS ?> units
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div id="preparation-form" style="display: none;">
                <input type="hidden" name="open_id" id="open_id">

                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h6>Drug Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <th style="width: 30%">Drug</th>
                                    <td id="drug_name_display"></td>
                                </tr>
                                <tr>
                                    <th>Trade Name</th>
                                    <td id="trade_name_display"></td>
                                </tr>
                                <tr>
                                    <th>Available Units</th>
                                    <td id="units_display"></td>
                                </tr>
                                <tr>
                                    <th>Expiry Date</th>
                                    <td id="expiry_display"></td>
                                </tr>
                            </table>
                        </div>

                        <div class="form-group mt-3">
                            <label for="prep_units">Units to Prepare</label>
                            <input type="number" name="prep_units" id="prep_units" class="form-control" required min="1">
                            <small class="form-text text-muted">Enter the number of units to prepare</small>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-3">Prepare Drug</button>
                    </div>
                </div>
            </div>
            <?= form_close() ?>

            <div class="mt-3">
                <a href="<?= module_url('prepdisp/prepBarcode') ?>" class="btn btn-info btn-sm">
                    <i class="fa fa-barcode"></i> Scan Barcode to Prepare
                </a>
                <a href="<?= module_url('prepdisp/prepList') ?>" class="btn btn-secondary btn-sm">
                    <i class="fa fa-list"></i> View Preparation List
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // When a drug is selected
        $('#drug_select').change(function() {
            const selectedOption = $(this).find('option:selected');
            if (selectedOption.val()) {
                // Populate the form fields
                $('#open_id').val(selectedOption.val());
                $('#drug_name_display').text(selectedOption.data('name'));
                $('#trade_name_display').text(selectedOption.data('trade'));
                $('#units_display').text(selectedOption.data('units'));
                $('#expiry_display').text(selectedOption.data('expiry'));
                
                // Set the max value for units
                $('#prep_units').attr('max', selectedOption.data('units'));
                
                // Show the preparation form
                $('#preparation-form').show();
                $('#prep_units').focus();
            } else {
                $('#preparation-form').hide();
            }
        });
        
        // Validate preparation units against available units
        $('#prep_units').on('input', function() {
            const max = parseInt($(this).attr('max') || 0);
            const entered = parseInt($(this).val() || 0);
            
            if (entered > max) {
                alert(`⚠️ The entered units (${entered}) exceed the available shelf stock (${max} units).`);
                $(this).val('');
            }
        });
    });
</script>