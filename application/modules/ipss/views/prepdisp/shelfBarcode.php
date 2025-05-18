<div class="card">
    <div class="card-header">
        <h4>Scan Barcode to Move Drug to Open Shelf</h4>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="barcode">Scan Barcode</label>
            <div class="input-group">
                <input type="text" class="form-control" id="barcode" placeholder="Scan or enter barcode" autofocus>
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary" id="search-barcode">Search</button>
                </div>
            </div>
            <small class="form-text text-muted">Scan the barcode on the drug batch to find it</small>
        </div>

        <div class="alert alert-info">
            <i class="fa fa-info-circle"></i> Scan the barcode on the drug batch or enter the barcode number manually.
        </div>

        <!-- Debug information section -->
        <div id="debug-info" class="alert alert-secondary" style="display: none;">
            <h5>Debug Information</h5>
            <pre id="ajax-response"></pre>
        </div>

        <hr>

        <div id="result_area" style="display: none;">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 id="drug_name">Drug Name</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Batch ID:</strong> <span id="batch_id_display"></span></p>
                            <p><strong>Trade Name:</strong> <span id="trade_name"></span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Available Units:</strong> <span id="available_units"></span></p>
                            <p><strong>Expiry Date:</strong> <span id="expiry_date"></span></p>
                        </div>
                    </div>

                    <div id="on_shelf_warning" class="alert alert-warning" style="display: none;">
                        <i class="fa fa-exclamation-triangle"></i> This batch is already on the open shelf.
                        <div id="existing_shelf_details"></div>
                    </div>

                    <form id="move_to_shelf_form">
                        <input type="hidden" id="batch_id_input" name="batch_id">
                        <input type="hidden" id="drug_id_input" name="drug_id">

                        <div class="form-group">
                            <label for="shelf_unit">Units to Move to Open Shelf</label>
                            <input type="number" class="form-control" id="shelf_unit" name="shelf_unit" min="1" required>
                            <small class="form-text text-muted">Enter the number of units to move to the open shelf</small>
                        </div>

                        <div class="form-group">
                            <label for="shelf_date">Date Added to Shelf</label>
                            <input type="date" class="form-control" id="shelf_date" name="shelf_date" required>
                            <small class="form-text text-muted">Date when drug is moved to open shelf</small>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Move to Open Shelf</button>
                            <button type="button" id="reset_scan" class="btn btn-secondary">Scan Another</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="no_result" class="alert alert-danger" style="display: none;">
            <i class="fa fa-times-circle"></i> No batch found with this barcode. Please try again.
        </div>

        <div class="mt-3">
            <a href="<?= module_url('prepdisp/shelfList') ?>" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back to Shelf List
            </a>
            <!-- <button type="button" class="btn btn-info" id="toggle-debug">Show/Hide Debug Info</button> -->
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Set the current date as default for the shelf date input
        var today = new Date();
        var formattedDate = today.toISOString().substr(0, 10); // Format: YYYY-MM-DD
        $('#shelf_date').val(formattedDate);

        // Focus on the barcode input
        $('#barcode').focus();

        // Toggle debug information
        $('#toggle-debug').click(function() {
            $('#debug-info').toggle();
        });

        // Handle barcode input (when Enter key is pressed)
        $('#barcode').keypress(function (e) {
            if (e.which === 13) { // Enter key
                e.preventDefault();
                searchBarcode();
            }
        });
        
        // Add click handler for search button
        $('#search-barcode').click(function() {
            searchBarcode();
        });

        // Handle form submission
        $('#move_to_shelf_form').submit(function (e) {
            e.preventDefault();

            var batch_id = $('#batch_id_input').val();
            var drug_id = $('#drug_id_input').val();
            var shelf_unit = $('#shelf_unit').val();
            var shelf_date = $('#shelf_date').val();

            // Validate inputs
            if (!batch_id || !drug_id || !shelf_unit || shelf_unit < 1) {
                alert('Please fill in all required fields.');
                return;
            }

            // Show submission is in progress
            var submitBtn = $(this).find('button[type="submit"]');
            var originalBtnText = submitBtn.html();
            submitBtn.html('<i class="fa fa-spinner fa-spin"></i> Processing...');
            submitBtn.prop('disabled', true);

            // Add CSRF token if your system uses it
            var data = {
                batch_id: batch_id,
                drug_id: drug_id,
                shelf_unit: shelf_unit,
                shelf_date: shelf_date
            };
            
            // If you're using CodeIgniter CSRF
            var csrfName = $('meta[name="csrf-token-name"]').attr('content');
            var csrfValue = $('meta[name="csrf-token-value"]').attr('content');
            if (csrfName && csrfValue) {
                data[csrfName] = csrfValue;
            }

            // AJAX call to move drug to shelf
            $.ajax({
                url: '<?= module_url("prepdisp/moveToShelfFromBarcode") ?>',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (response) {
                    // Log the full response for debugging
                    console.log('Move to shelf response:', response);
                    
                    // Display in debug area
                    $('#ajax-response').text(JSON.stringify(response, null, 2));
                    
                    // Reset button state
                    submitBtn.html(originalBtnText);
                    submitBtn.prop('disabled', false);
                    
                    if (response.status === 'success') {
                        alert(response.message);
                        window.location.href = '<?= module_url("prepdisp/shelfList") ?>';
                    } else {
                        alert(response.message || 'Error processing request.');
                    }
                },
                error: function (xhr, status, error) {
                    // Log the error details
                    console.error('AJAX Error:', status, error);
                    console.error('Response:', xhr.responseText);
                    
                    // Display in debug area
                    $('#ajax-response').text('Error: ' + status + '\n' + error + '\n\nResponse:\n' + xhr.responseText);
                    
                    // Reset button state
                    submitBtn.html(originalBtnText);
                    submitBtn.prop('disabled', false);
                    
                    alert('Error processing request. Please check debug information for details.');
                }
            });
        });

        // Reset the form and scan another barcode
        $('#reset_scan').click(function () {
            $('#barcode').val('').focus();
            $('#result_area').hide();
            $('#no_result').hide();
        });

        // Function to search for a batch by barcode
        function searchBarcode() {
            var barcode = $('#barcode').val().trim();
            
            if (!barcode) {
                alert('Please enter a barcode.');
                return;
            }
            
            // Show loading indicator or message
            $('#result_area').hide();
            $('#no_result').hide();
            $('#barcode').prop('disabled', true);
            $('#search-barcode').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            
            // Clear previous results
            $('#batch_id_display').text('');
            $('#drug_name').text('');
            $('#trade_name').text('');
            $('#available_units').text('');
            $('#expiry_date').text('');
            $('#on_shelf_warning').hide();
            $('#existing_shelf_details').html('');

            // Add CSRF token if your system uses it
            var data = { barcode: barcode };
            
            // If you're using CodeIgniter CSRF
            var csrfName = $('meta[name="csrf-token-name"]').attr('content');
            var csrfValue = $('meta[name="csrf-token-value"]').attr('content');
            if (csrfName && csrfValue) {
                data[csrfName] = csrfValue;
            }

            $.ajax({
                url: '<?= module_url("prepdisp/searchByBarcode") ?>',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (response) {
                    // Re-enable inputs
                    $('#barcode').prop('disabled', false);
                    $('#search-barcode').prop('disabled', false).html('Search');
                    
                    // Log the full response for debugging
                    console.log('Search response:', response);
                    
                    // Display in debug area
                    $('#ajax-response').text(JSON.stringify(response, null, 2));
                    
                    if (response.status === 'success' && response.batch && response.drug) {
                        // Display the batch details
                        var drugName = response.drug.T01_DRUGS || response.drug.T01_DRUG_NAME || 'Unknown';
                        $('#drug_name').text(drugName);
                        $('#batch_id_display').text(response.batch.T02_BATCH_ID);
                        $('#trade_name').text(response.drug.T01_TRADE_NAME || 'N/A');
                        $('#available_units').text(response.batch.T02_TOTAL_UNITS || '0');

                        // Format and display expiry date
                        if (response.batch.T02_EXP_DATE) {
                            var expDate = new Date(response.batch.T02_EXP_DATE);
                            var formattedDate = expDate.toLocaleDateString('en-GB', {
                                day: '2-digit',
                                month: 'short',
                                year: 'numeric'
                            });
                            $('#expiry_date').text(formattedDate);
                        } else {
                            $('#expiry_date').text('Not specified');
                        }

                        // Set form values
                        $('#batch_id_input').val(response.batch.T02_BATCH_ID);
                        $('#drug_id_input').val(response.batch.T02_DRUG_ID);
                        $('#shelf_unit').attr('max', response.batch.T02_TOTAL_UNITS);
                        $('#shelf_unit').val('1'); // Default to 1 unit

                        // Check if this batch is already on the open shelf
                        if (response.on_open_shelf && response.open_shelf_items && response.open_shelf_items.length > 0) {
                            $('#on_shelf_warning').show();

                            // Display existing open shelf details
                            var shelfDetails = '<ul>';
                            $.each(response.open_shelf_items, function (index, item) {
                                shelfDetails += '<li>Open Shelf ID: ' + item.T04_OPEN_ID +
                                    ', Units: ' + item.T04_TOTAL_UNITS +
                                    ', Original Moved: ' + (item.T04_ORI_MOVED || item.original_units_moved || 'N/A') + '</li>';
                            });
                            shelfDetails += '</ul>';
                            $('#existing_shelf_details').html(shelfDetails);
                        } else {
                            $('#on_shelf_warning').hide();
                        }

                        // Show the result area
                        $('#result_area').show();
                        $('#no_result').hide();
                    } else {
                        // No batch found with this barcode or error occurred
                        $('#result_area').hide();
                        $('#no_result').show();
                        $('#no_result').html('<i class="fa fa-times-circle"></i> ' + 
                            (response.message || 'No batch found with this barcode. Please try again.'));
                    }
                },
                error: function (xhr, status, error) {
                    // Re-enable inputs
                    $('#barcode').prop('disabled', false);
                    $('#search-barcode').prop('disabled', false).html('Search');
                    
                    // Log the error details
                    console.error('AJAX Error:', status, error);
                    console.error('Response:', xhr.responseText);
                    
                    // Display in debug area
                    $('#ajax-response').text('Error: ' + status + '\n' + error + '\n\nResponse:\n' + xhr.responseText);
                    
                    $('#result_area').hide();
                    $('#no_result').show();
                    $('#no_result').html('<i class="fa fa-times-circle"></i> Error searching for batch. Please check debug information for details.');
                }
            });
        }
    });
</script>