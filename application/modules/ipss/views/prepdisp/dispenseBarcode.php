<div class="d-flex justify-content-center">
    <div class="card" style="width: 50%;">
        <div class="card-header text-center">
            <h5>Scan Barcode to Dispense Drug</h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="barcode"><i class="fa fa-barcode"></i> Scan or Enter Barcode</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="barcode" name="barcode"
                        placeholder="Scan or enter barcode" autofocus>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary" id="search-barcode">Search</button>
                    </div>
                </div>
                <small class="form-text text-muted">Place cursor in the field and scan barcode, or type it
                    manually.</small>
            </div>

            <div id="barcode-result" class="mt-4"></div>

            <div id="dispense-form-container" class="mt-4" style="display: none;">
                <?= form_open(module_url('prepdisp/prepareDispense'), array('id' => 'dispenseForm', 'class' => 'needs-validation', 'novalidate' => true)) ?>

                <input type="hidden" name="open_id" id="open_id">

                <div class="card">
                    <div class="card-header bg-light">
                        <h6>Dispense Drug</h6>
                    </div>
                    <div class="card-body">
                        <!-- Display staff name -->
                        <p>Staff: <strong><?= strtoupper($staff_name) ?></strong></p>

                        <!-- Units -->
                        <div class="form-group">
                            <label for="disp_units">Units to Dispense</label>
                            <input type="number" name="disp_units" id="disp_units" class="form-control" min="1"
                                required>
                            <small class="form-text text-muted">Enter the number of units to dispense</small>
                        </div>

                        <!-- Dispense Date and Time -->
                        <div class="form-group">
                            <label for="disp_date">Dispense Date and Time</label>
                            <input type="datetime-local" name="disp_date" id="disp_date"
                                class="form-control form-control-sm" required>
                        </div>


                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary btn-block">Dispense Drug</button>
                    </div>
                </div>
                <?= form_close() ?>
            </div>

            <div class="mt-3">
                <a href="<?= module_url('prepdisp/prepDispList') ?>" class="btn btn-secondary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back to Dispensation List
                </a>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        // Auto-focus on barcode field when page loads
        $('#barcode').focus();

        // Search by barcode when button is clicked
        $('#search-barcode').click(function () {
            const barcode = $('#barcode').val();
            if (!barcode) {
                alert('Please enter a barcode');
                return;
            }

            // Show loading indicator
            $('#barcode-result').html('<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>');
            $('#dispense-form-container').hide();

            $.ajax({
                url: '<?= module_url("prepdisp/searchOpenShelfByBarcode") ?>',
                type: 'POST',
                data: { barcode: barcode },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'error') {
                        $('#barcode-result').html('<div class="alert alert-danger">' + response.message + '</div>');
                        return;
                    }

                    // Display batch and drug info
                    let html = '<div class="card">';
                    html += '<div class="card-header bg-success text-white"><i class="fa fa-check-circle"></i> Drug Found on Open Shelf</div>';
                    html += '<div class="card-body">';
                    html += '<div class="table-responsive"><table class="table table-bordered table-sm">';
                    html += '<tr><th style="width: 30%">Drug</th><td>' + response.drug.T01_DRUGS + ' (' + response.drug.T01_TRADE_NAME + ')</td></tr>';
                    html += '<tr><th>Batch ID</th><td>' + response.batch.T02_BATCH_ID + '</td></tr>';
                    html += '<tr><th>Barcode</th><td>' + response.batch.T02_BARCODE_NUM + '</td></tr>';
                    html += '<tr><th>Expiry Date</th><td>' + response.batch.T02_EXP_DATE + '</td></tr>';
                    html += '</table></div>';

                    // Display open shelf items for this batch
                    html += '<h6 class="mt-3">Open Shelf Items:</h6>';
                    html += '<div class="table-responsive"><table class="table table-bordered table-sm">';
                    html += '<thead><tr><th>Open Shelf ID</th><th>Units Available</th><th>Date Added</th><th>Action</th></tr></thead>';
                    html += '<tbody>';

                    // Check if we have any open shelf items
                    if (response.open_shelf_items.length > 0) {
                        $.each(response.open_shelf_items, function (index, item) {
                            // Format the date properly or display placeholder if missing
                            let formattedDate = 'N/A';

                            // Debug: Log the raw date value to console
                            console.log("Raw date value:", item.T04_DATE_ADDED);

                            // Handle date - use current date if missing
                            if (!item.T04_DATE_ADDED || item.T04_DATE_ADDED === 'undefined' || item.T04_DATE_ADDED === null) {
                                // Use current date as fallback
                                formattedDate = new Date().toLocaleDateString();
                            } else {
                                // Try to parse and format the date
                                try {
                                    let dateObj = new Date(item.T04_DATE_ADDED);
                                    if (!isNaN(dateObj.getTime())) {
                                        formattedDate = dateObj.toLocaleDateString();
                                    } else {
                                        // If parsing fails, use current date
                                        formattedDate = new Date().toLocaleDateString();
                                    }
                                } catch (e) {
                                    console.error("Error formatting date:", e);
                                    formattedDate = new Date().toLocaleDateString();
                                }
                            }

                            html += '<tr>';
                            html += '<td>' + item.T04_OPEN_ID + '</td>';
                            html += '<td>' + item.T04_TOTAL_UNITS + '</td>';
                            html += '<td>' + formattedDate + '</td>';
                            html += '<td><button type="button" class="btn btn-sm btn-primary select-shelf" data-id="' + item.T04_OPEN_ID + '" data-units="' + item.T04_TOTAL_UNITS + '">Select</button></td>';
                            html += '</tr>';
                        });
                    } else {
                        html += '<tr><td colspan="4" class="text-center">No items found on open shelf for this batch</td></tr>';
                    }

                    html += '</tbody></table></div>';
                    html += '</div></div>';

                    $('#barcode-result').html(html);

                    // Add event handlers for the select buttons
                    $('.select-shelf').click(function () {
                        const openId = $(this).data('id');
                        const availableUnits = $(this).data('units');

                        // Populate the form with the selected open shelf item
                        $('#open_id').val(openId);
                        $('#disp_units').attr('max', availableUnits);

                        // Set default date and time to current date and time
                        const now = new Date();
                        const year = now.getFullYear();
                        const month = String(now.getMonth() + 1).padStart(2, '0');
                        const day = String(now.getDate()).padStart(2, '0');
                        const hours = String(now.getHours()).padStart(2, '0');
                        const minutes = String(now.getMinutes()).padStart(2, '0');

                        $('#disp_date').val(`${year}-${month}-${day}T${hours}:${minutes}`);

                        $('#dispense-form-container').show();
                        $('#disp_units').focus();
                    });
                },
                error: function () {
                    $('#barcode-result').html('<div class="alert alert-danger">Error occurred while searching</div>');
                }
            });
        });

        // Submit barcode search on Enter key
        $('#barcode').keypress(function (e) {
            if (e.which === 13) {
                $('#search-barcode').click();
                e.preventDefault();
            }
        });

        // Validate dispensation units against available shelf units
        $('#disp_units').on('input', function () {
            const max = parseInt($(this).attr('max') || 0);
            const entered = parseInt($(this).val() || 0);

            if (entered > max) {
                alert(`⚠️ The entered units (${entered}) exceed the available shelf stock (${max} units).`);
                $(this).val('');
            }
        });
    });
</script>