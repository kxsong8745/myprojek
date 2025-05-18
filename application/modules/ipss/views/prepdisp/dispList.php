<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Drug Dispensation List</h5>
        <div>
            <a href="<?= module_url('prepdisp/prepList') ?>" class="btn btn-primary btn-sm">
                <i class="fa fa-capsules"></i> Preparation List
            </a>
            <a href="<?= module_url('prepdisp/prepForm') ?>" class="btn btn-info btn-sm">
                <i class="fa fa-plus"></i> New Preparation
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
            <table class="table table-bordered table-hover" id="dispTable">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Drug Name</th>
                        <th>Batch No</th>
                        <th>Units</th>
                        <th>Dispensed Date</th>
                        <th>Dispensed By</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($disp_records)) : ?>
                        <?php foreach ($disp_records as $record) : ?>
                            <tr>
                                <td><?= $record->T08_DISP_ID ?></td>
                                <td><?= $record->T08_DRUG_NAME ?></td>
                                <td><?= $record->T08_BATCH_NO ?></td>
                                <td><?= $record->T08_DISP_UNITS ?></td>
                                <td><?= $record->T08_DISP_DATE ?></td>
                                <td><?= $record->T08_STAFF_DISP ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center">No dispensation records found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#dispTable').DataTable({
            "order": [[0, "desc"]],
            "pageLength": 25
        });
    });
</script>