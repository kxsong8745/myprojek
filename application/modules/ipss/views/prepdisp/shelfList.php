<div class="card">
    <div class="card-header">
        <h4>Drugs on Open Shelf</h4>
    </div>
    <div class="card-body">
        <div class="d-flex mb-3">
            <a class="btn btn-primary mr-2" href="<?= module_url('prepdisp/shelfForm') ?>">Move New Drug to Open Shelf</a>
            <a class="btn btn-success" href="<?= module_url('prepdisp/shelfBarcode') ?>">
                <i class="fa fa-barcode"></i> Scan Barcode to Move Drug
            </a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Staff Name</th>
                    <th>Drug Name</th>
                    <th>Trade Name</th>
                    <th>Batch ID</th>
                    <th>Units Moved</th>
                    <th>Available Units on Shelf</th>
                    <th>Movement Date</th>
                    <th>Batch Expiry Date</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                <?php if (!empty($open_shelves)): ?>
                    <?php foreach ($open_shelves as $index => $shelf): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $shelf->staff_name ?></td>
                            <td><?= $shelf->drug_name ?></td>
                            <td><?= $shelf->trade_name ?></td>
                            <td><?= $shelf->T04_BATCH_ID ?></td>
                            <td><?= $shelf->T04_TOTAL_UNITS ?></td>
                            <td><?= $shelf->available_units_on_shelf ?></td>
                            <td><?= $shelf->T04_DATE_ADDED ?></td>
                            <td><?= $shelf->T02_EXP_DATE ?></td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-danger btn-sm delete-record"
                                    data-id="<?= $shelf->T04_OPEN_ID ?>" data-drug="<?= $shelf->drug_name ?>"
                                    data-units="<?= $shelf->T04_TOTAL_UNITS ?>">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="text-center">No drugs moved to the open shelf</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.delete-record').on('click', function() {
        var id = $(this).data('id');
        var drug = $(this).data('drug');
        var units = $(this).data('units');
        
        if (confirm('Are you sure you want to delete ' + drug + ' with ' + units + ' units from the open shelf? This will return the units to the batch inventory.')) {
            window.location.href = '<?= module_url("prepdisp/delete_shelf_record/") ?>' + id;
        }
    });
});
</script>