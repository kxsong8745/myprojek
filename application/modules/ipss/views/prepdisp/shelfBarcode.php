<div class="d-flex justify-content-center">
    <div class="card" style="width: 50%;">
        <div class="card-header text-center">
            <h5>Scan Barcode to Move Drug to Open Shelf</h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="barcode"><i class="fa fa-barcode"></i> Scan or Enter Barcode</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Scan or enter barcode" autofocus>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary" id="search-barcode">Search</button>
                    </div>
                </div>
                <small class="form-text text-muted">Place cursor in the field and scan barcode, or type it manually.</small>
            </div>

            <div id="barcode-result" class="mt-4"></div>

            <div id="shelf-form-container" class="mt-4" style="display: none;">
                <?= form_open(module_url('prepdisp/openShelf'), array('id' => 'shelfForm', 'class' => 'needs-validation', 'novalidate' => true)) ?>
                
                <!-- Staff (User taken from session) -->
                <input type="hidden" name="staff_id" value="<?= $staff_id ?>">
                <input type="hidden" name="drug_id" id="drug_id">
                <input type="hidden" name="batch_id" id="batch_id">
                
                <div class="card">
                    <div class="card-header bg-light">
                        <h6>Move to Open Shelf</h6>
                    </div>
                    <div class="card-body">
                        <!-- Display staff name -->
                        <p>Staff: <strong><?= strtoupper($staff_name) ?></strong></p>
                        
                        <!-- Units -->
                        <div class="form-group">
                            <label for="shelf_unit">Units to Move</label>
                            <input type="number" name="shelf_unit" id="shelf_unit" class="form-control" min="1" required>
                            <small class="form-text text-muted">Enter the number of units to move to open shelf</small>
                        </div>

                        <!-- Date (Automatically set to today) -->
                        <div class="form-group">
                            <label for="shelf_date">Date</label>
                            <input type="date" name="shelf_date" id="shelf_date" class="form-control" 
                                value="<?= date('Y-m-d') ?>" readonly>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary btn-block">Move to Open Shelf</button>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
            
            <div class="mt-3">
                <a href="<?= module_url('prepdisp/shelfList') ?>" class="btn btn-secondary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back to Open Shelf List
                </a>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Auto-focus on barcode field when page loads
    $('#barcode').focus();
    
    // Search by barcode when button is clicked
    $('#search-barcode').click(function() {
        const barcode = $('#barcode').val();
        if (!barcode) {
            alert('Please enter a barcode');
            return;
        }
        
        // Show loading indicator
        $('#barcode-result').html('<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>');
        $('#shelf-form-container').hide();
        
        $.ajax({
            url: '<?= module_url("prepdisp/searchByBarcode") ?>',
            type: 'POST',
            data: { barcode: barcode },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'error') {
                    $('#barcode-result').html('<div class="alert alert-danger">' + response.message + '</div>');
                    return;
                }
                
                // Display batch and drug info
                let html = '<div class="card">';
                html += '<div class="card-header bg-success text-white"><i class="fa fa-check-circle"></i> Batch Found</div>';
                html += '<div class="card-body">';
                html += '<div class="table-responsive"><table class="table table-bordered table-sm">';
                html += '<tr><th style="width: 30%">Drug</th><td>' + response.drug.T01_DRUGS + ' (' + response.drug.T01_TRADE_NAME + ')</td></tr>';
                html += '<tr><th>Batch ID</th><td>' + response.batch.T02_BATCH_ID + '</td></tr>';
                html += '<tr><th>Barcode</th><td>' + response.batch.T02_BARCODE_NUM + '</td></tr>';
                html += '<tr><th>Available Units</th><td>' + response.batch.T02_TOTAL_UNITS + '</td></tr>';
                html += '<tr><th>Manufacturing Date</th><td>' + response.batch.T02_MFD_DATE + '</td></tr>';
                html += '<tr><th>Expiry Date</th><td>' + response.batch.T02_EXP_DATE + '</td></tr>';
                html += '</table></div>';
                
                if (response.on_open_shelf) {
                    html += '<div class="alert alert-warning mt-3">';
                    html += '<i class="fa fa-exclamation-triangle"></i> This batch is already on open shelf';
                    html += '</div>';
                    html += '<div class="table-responsive mt-3"><table class="table table-bordered table-sm">';
                    html += '<thead><tr><th>Open Shelf ID</th><th>Units on Shelf</th><th>Date Added</th><th>Added By</th></tr></thead>';
                    html += '<tbody>';
                    
                    $.each(response.open_shelf_items, function(index, item) {
                        html += '<tr>';
                        html += '<td>' + item.T04_OPEN_ID + '</td>';
                        html += '<td>' + item.T04_TOTAL_UNITS + '</td>';
                        html += '<td>' + item.T04_DATE_ADDED + '</td>';
                        html += '<td>' + item.T04_MOVED_BY + '</td>';
                        html += '</tr>';
                    });
                    
                    html += '</tbody></table></div>';
                }
                
                html += '</div></div>';
                
                $('#barcode-result').html(html);
                
                // Populate and show the form if we found a valid batch
                if (response.batch.T02_TOTAL_UNITS > 0) {
                    $('#drug_id').val(response.batch.T02_DRUG_ID);
                    $('#batch_id').val(response.batch.T02_BATCH_ID);
                    $('#shelf_unit').attr('max', response.batch.T02_TOTAL_UNITS);
                    $('#shelf-form-container').show();
                    $('#shelf_unit').focus();
                } else {
                    $('#barcode-result').append('<div class="alert alert-warning mt-3">This batch has no available units to move to open shelf.</div>');
                }
            },
            error: function() {
                $('#barcode-result').html('<div class="alert alert-danger">Error occurred while searching</div>');
            }
        });
    });
    
    // Submit barcode search on Enter key
    $('#barcode').keypress(function(e) {
        if (e.which === 13) {
            $('#search-barcode').click();
            e.preventDefault();
        }
    });
    
    // Validate shelf unit against available batch units
    $('#shelf_unit').on('input', function() {
        const max = parseInt($(this).attr('max') || 0);
        const entered = parseInt($(this).val() || 0);
        
        if (entered > max) {
            alert(`⚠️ The entered units (${entered}) exceed the available stock (${max} units).`);
            $(this).val('');
        }
    });
});
</script>