<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Drug Preparation List</h5>
        <div>
            <a href="<?= module_url('prepdisp/prepForm') ?>" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> New Preparation
            </a>
            <a href="<?= module_url('prepdisp/prepBarcode') ?>" class="btn btn-info btn-sm">
                <i class="fa fa-barcode"></i> Scan Barcode
            </a>
        </div>
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>
        
        <?php if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="prepTable">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Drug</th>
                        <th>Trade Name</th>
                        <th>Batch No</th>
                        <th>Expiry Date</th>
                        <th>Prep Units</th>
                        <th>Prepared By</th>
                        <th>Dispense Date/Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($prep_records)) : ?>
                        <?php foreach ($prep_records as $record) : ?>
                            <tr>
                                <td><?= $record->T05_PREP_ID ?></td>
                                <td><?= $record->drug_name ?></td>
                                <td><?= $record->trade_name ?></td>
                                <td><?= $record->T05_BATCH_ID ?></td>
                                <td><?= $record->T02_EXP_DATE ?></td>
                                <td><?= $record->T05_PREP_UNITS ?></td>
                                <td><?= $record->T05_STAFF_PREP ?></td>
                                <td>
                                    <!-- Dispense date and time field -->
                                    <input type="datetime-local" class="form-control form-control-sm disp_date" 
                                           id="disp_date_<?= $record->T05_PREP_ID ?>" 
                                           data-prep-id="<?= $record->T05_PREP_ID ?>">
                                </td>
                                <td class="text-center">
                                    <!-- Action buttons -->
                                    <button class="btn btn-success btn-sm dispense-btn" 
                                            data-prep-id="<?= $record->T05_PREP_ID ?>" 
                                            data-units="<?= $record->T05_PREP_UNITS ?>">
                                        <i class="fa fa-prescription-bottle"></i> Dispense
                                    </button>
                                    
                                    <a href="<?= module_url('prepdisp/remove_prep/' . $record->T05_PREP_ID) ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Are you sure you want to remove this preparation and return units to shelf?')">
                                        <i class="fa fa-undo"></i> Return to Shelf
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="9" class="text-center">No preparation records found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for dispensing -->
<div class="modal fade" id="dispenseModal" tabindex="-1" role="dialog" aria-labelledby="dispenseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dispenseModalLabel">Dispense Drug</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open(module_url('prepdisp/dispense'), array('id' => 'dispenseForm')) ?>
            <div class="modal-body">
                <input type="hidden" name="prep_id" id="prep_id">
                <input type="hidden" name="disp_date" id="disp_date">
                
                <div class="form-group">
                    <label for="disp_units">Units to Dispense</label>
                    <input type="number" name="disp_units" id="disp_units" class="form-control" required>
                    <small class="form-text text-muted">Enter the number of units to dispense</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Dispense</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Set default date and time to current for all date fields
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const defaultDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
        
        $('.disp_date').each(function() {
            $(this).val(defaultDateTime);
        });
        
        // Handle dispense button click
        $('.dispense-btn').click(function() {
            const prepId = $(this).data('prep-id');
            const units = $(this).data('units');
            const dateTime = $(`#disp_date_${prepId}`).val();
            
            if (!dateTime) {
                alert('Please select a dispense date and time');
                return;
            }
            
            // Set modal values
            $('#prep_id').val(prepId);
            $('#disp_units').val(units).attr('max', units);
            $('#disp_date').val(dateTime);
            
            // Show modal
            $('#dispenseModal').modal('show');
        });
        
        // Validate dispense units
        $('#disp_units').on('input', function() {
            const max = parseInt($(this).attr('max') || 0);
            const entered = parseInt($(this).val() || 0);
            
            if (entered > max) {
                alert(`⚠️ The entered units (${entered}) exceed the available preparation units (${max}).`);
                $(this).val(max);
            }
        });
        
        // Initialize DataTable
        $('#prepTable').DataTable({
            "order": [[0, "desc"]],
            "pageLength": 25
        });
    });
</script>