<?php
$ENABLE_ADD = TRUE;
$ENABLE_MANAGE = TRUE;
$ENABLE_DELETE = TRUE;
?>
<?= form_open($this->uri->uri_string(), array('id' => 'frm_menu', 'name' => 'frm_menu', 'method' => 'get')) ?>
<div class="mb-3">
    <input type="text" name="search" class="form-control form-control-sm" placeholder="Search drugs by name..."
        value="<?= isset($search) ? $search : '' ?>" style="width: 300px;">
</div>

<a class="btn btn-primary" href="<?php echo module_url("drug/drugForm_add") ?>">Add New Drug</a>
<?= form_close(); ?>
<div class="card">
    <div class="card-header">Drug List</div>
    <div class="card-body">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th width="50">No.</th>
                    <th>Drugs</th>
                    <th>Trade Name</th>
                    <th>Minimum Stock to Retain</th>
                    <th>Warning Threshold</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data)): ?>
                    <?php $i = 0;
                    foreach ($data as $row) { ?> <!-- Iterate over the result object -->
                        <tr>
                            <td><?= ++$i ?></td>
                            <td><?= $row->T01_DRUGS ?></td>
                            <td><?= $row->T01_TRADE_NAME ?></td>
                            <td><?= $row->T01_MIN_STOCK ?></td>
                            <td><?= $row->T01_MIN_STOCK_WARN ?></td>

                            <td>
                                <a class="btn btn-info" href="<?= module_url("drug/viewBatches/" . $row->T01_DRUG_ID) ?>">
                                    <i class="fas fa-eye"></i> 
                                </a>
                                <a class="btn btn-success" href="<?= module_url("drug/formAddBatch/" . $row->T01_DRUG_ID) ?>">
                                    <i class="fas fa-plus"></i> 
                                </a>
                                <a class="btn btn-warning" href="<?= module_url("drug/drugForm_update/" . $row->T01_DRUG_ID) ?>">
                                    <i class="fa fa-edit"></i> 
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No drugs found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

