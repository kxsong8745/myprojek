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
                        <i class="fas fa-exclamation-triangle"></i> Stock Level Alerts
                    </h3>
                </div>
                <div class="card-body">
                    <?php if (empty($stock_alerts)): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> No stock alerts at this time.
                        </div>
                    <?php else: ?>
                        <div class="mb-3">
                            <a href="<?php echo site_url('ipss/alert/stockAlert'); ?>"
                                class="btn btn-secondary <?php echo (!$current_filter) ? 'active' : ''; ?>">All</a>
                            <a href="<?php echo site_url('ipss/alert/stockAlert?filter=WARNING'); ?>"
                                class="btn btn-warning <?php echo ($current_filter === 'WARNING') ? 'active' : ''; ?>">Warning</a>
                            <a href="<?php echo site_url('ipss/alert/stockAlert?filter=CRITICAL'); ?>"
                                class="btn btn-danger <?php echo ($current_filter === 'CRITICAL') ? 'active' : ''; ?>">Critical</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover datatable">
                                <thead>
                                    <tr>
                                        <th>Alert Type</th>
                                        <th>Drug Name</th>
                                        <th>Current Stock</th>
                                        <th>Minimum Stock</th>
                                        <th>Alert Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($stock_alerts as $alert): ?>
                                        <tr
                                            class="<?php echo ($alert->T06_ALERT_TYPE == 'CRITICAL') ? 'table-danger' : 'table-warning'; ?>">
                                            <td>
                                                <?php if ($alert->T06_ALERT_TYPE == 'CRITICAL'): ?>
                                                    <span class="badge" style="background-color: red; color: black;">CRITICAL</span>
                                                <?php else: ?>
                                                    <span class="badge"
                                                        style="background-color: yellow; color: black;">WARNING</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo htmlspecialchars($alert->DRUG_NAME); ?></td>
                                            <td><?php echo $alert->T06_CURRENT_STOCK; ?></td>
                                            <td><?php echo $alert->T06_MIN_STOCK; ?></td>
                                            <td><?php echo date('Y-m-d', strtotime($alert->T06_ALERT_DATE)); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="alert alert-info mt-3">
                            <i class="fas fa-info-circle"></i>
                            <strong>Alert Descriptions:</strong>
                            <ul>
                                <li><span class="badge" style="color: black;">CRITICAL</>: Stock level is below the minimum
                                        threshold.</li>
                                <li><span class="badge" style="color: black;">WARNING</sspa>: Stock level is in the range for warning</li>
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
            "order": [[0, "asc"], [3, "asc"]],
            "responsive": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        });
    });
</script>