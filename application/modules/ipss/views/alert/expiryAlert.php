<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- Show flash messages if any -->
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-calendar-times"></i> Drug Expiry Alerts
                    </h3>
                </div>
                <div class="card-body">
                    <?php if (empty($expiry_alerts)): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> No expiry alerts at this time.
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover datatable">
                                <thead>
                                    <tr>
                                        <th>Expiry Status</th>
                                        <th>Drug Name</th>
                                        <th>Batch ID</th>
                                        <th>Expiry Date</th>
                                        <th>Remaining Units</th>
                                        <th>Alert Date</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($expiry_alerts as $alert): ?>
                                        <?php
                                        $row_class = '';
                                        $status_display = '';

                                        switch ($alert->T07_EXPIRY_STATUS) {
                                            case 'EXPIRED':
                                                $row_class = 'table-danger';
                                                $status_display = '<span class="badge" style="background-color: red; color: black;">EXPIRED</span>';
                                                break;
                                            case '3_MONTHS':
                                                $row_class = 'table-warning';
                                                $status_display = '<span class="badge" style="background-color: orange; color: black;">Expires in 3 months</span>';
                                                break;
                                            case '6_MONTHS':
                                                $row_class = '';
                                                $status_display = '<span class="badge" style="background-color: yellow; color: black;">Expires in 6 months</span>';
                                                break;
                                            case '9_MONTHS':
                                                $row_class = 'table-light';
                                                $status_display = '<span class="badge" style="background-color: lightgray; color: black;">Expires in 9 months</span>';
                                                break;
                                        }
                                        ?>
                                        <tr class="<?php echo $row_class; ?>">
                                            <td><?php echo $status_display; ?></td>
                                            <td><?php echo htmlspecialchars($alert->DRUG_NAME); ?></td>
                                            <td><?php echo htmlspecialchars($alert->T07_BATCH_ID); ?></td>
                                            <td><?php echo date('Y-m-d', strtotime($alert->T07_EXP_DATE)); ?></td>
                                            <td><?php echo $alert->T07_REMAINING_UNITS; ?></td>
                                            <td><?php echo date('Y-m-d', strtotime($alert->T07_ALERT_DATE)); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="alert alert-info mt-3">
                            <i class="fas fa-info-circle"></i>
                            <strong>Alert Descriptions:</strong>
                            <ul>
                                <li><span class="px-2" style="background-color: red; color: black;">EXPIRED</span>: Drug
                                    batch has already expired.</li>
                                <li><span class="px-2" style="background-color: orange; color: black;">Expires in 3
                                        months</span>: Drug batch will expire within 3 months.</li>
                                <li><span class="px-2" style="background-color: yellow; color: black;">Expires in 6
                                        months</span>: Drug batch will expire within 6 months.</li>
                                <li><span class="px-2" style="background-color: white; color: black;">Expires in 9
                                        months</span>: Drug batch will expire within 9 months.</li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.datatable').DataTable({
            "order": [[0, "asc"], [4, "asc"]],
            "responsive": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        });
    });
</script>