<div class="card">
    <div class="card-header">
        <h4>Preparation and Dispensation Records</h4>
    </div>
    <div class="card-body">
        <a class="btn btn-primary mb-3" href="<?= module_url('prepdisp/prepDispForm') ?>">Prepare and Dispense New Drug</a>
        <a class="btn btn-success" href="<?= module_url('prepdisp/dispenseBarcode') ?>"><i class="fa fa-barcode"></i> Scan Barcode to Dispense Drug</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Staff Name</th>
                    <th>Drug Name</th>
                    <th>Trade Name</th>
                    <th>Batch ID</th>
                    <th>Units Dispensed</th>
                    <th>Dispensed Date</th>
                    <th>Batch Expiry Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($prepdisp_records)): ?>
                    <?php foreach ($prepdisp_records as $index => $record): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $record->T05_STAFF_DISP ?></td>
                            <td><?= $record->drug_name ?></td>
                            <td><?= $record->trade_name ?></td>
                            <td><?= $record->T05_BATCH_ID ?></td>
                            <td><?= $record->T05_DISP_UNITS ?></td>
                            <td><?= $record->T05_DISP_DATE ?></td>
                            <td><?= $record->T02_EXP_DATE ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No preparation and dispensation records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
