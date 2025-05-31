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
            <!-- <a href="<?= module_url('reportpdf/generateDispPdf') ?>" class="btn btn-success btn-sm" target="_blank">
                <i class="fa fa-file-pdf"></i> Download PDF
            </a> -->
        </div>
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <form method="get" action="<?= module_url('prepdisp/dispList') ?>" class="mb-3">
                <div class="row align-items-end">
                    <!-- Search Input -->
                    <div class="col-md-4">
                        <label for="search" class="form-label">Search Drug Name</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <span class="iconify" data-icon="mdi:magnify" data-inline="false"></span>
                            </span>
                            <input type="text" name="search" id="search" class="form-control form-control-sm"
                                placeholder="Search drugs by name..." value="<?= isset($search) ? $search : '' ?>">
                        </div>
                    </div>

                    <!-- Date Filter Type -->
                    <div class="col-md-2">
                        <label for="filter_type" class="form-label">Filter By</label>
                        <select name="filter_type" id="filter_type" class="form-select form-select-sm">
                            <option value="">No Filter</option>
                            <option value="date" <?= (isset($filter_type) && $filter_type == 'date') ? 'selected' : '' ?>>Specific Date</option>
                            <option value="month" <?= (isset($filter_type) && $filter_type == 'month') ? 'selected' : '' ?>>Month</option>
                            <option value="year" <?= (isset($filter_type) && $filter_type == 'year') ? 'selected' : '' ?>>Year</option>
                        </select>
                    </div>

                    <!-- Date Filter Options -->
                    <div class="col-md-4">
                        <label class="form-label">&nbsp;</label>
                        <div id="date_filters">
                            <!-- Specific Date Filter -->
                            <div id="date_filter" style="display: none;">
                                <input type="date" name="filter_date" class="form-control form-control-sm" 
                                       value="<?= isset($filter_date) ? $filter_date : '' ?>">
                            </div>

                            <!-- Month Filter -->
                            <div id="month_filter" style="display: none;">
                                <div class="row">
                                    <div class="col-7">
                                        <select name="filter_month" class="form-select form-select-sm">
                                            <option value="">Select Month</option>
                                            <option value="1" <?= (isset($filter_month) && $filter_month == '1') ? 'selected' : '' ?>>January</option>
                                            <option value="2" <?= (isset($filter_month) && $filter_month == '2') ? 'selected' : '' ?>>February</option>
                                            <option value="3" <?= (isset($filter_month) && $filter_month == '3') ? 'selected' : '' ?>>March</option>
                                            <option value="4" <?= (isset($filter_month) && $filter_month == '4') ? 'selected' : '' ?>>April</option>
                                            <option value="5" <?= (isset($filter_month) && $filter_month == '5') ? 'selected' : '' ?>>May</option>
                                            <option value="6" <?= (isset($filter_month) && $filter_month == '6') ? 'selected' : '' ?>>June</option>
                                            <option value="7" <?= (isset($filter_month) && $filter_month == '7') ? 'selected' : '' ?>>July</option>
                                            <option value="8" <?= (isset($filter_month) && $filter_month == '8') ? 'selected' : '' ?>>August</option>
                                            <option value="9" <?= (isset($filter_month) && $filter_month == '9') ? 'selected' : '' ?>>September</option>
                                            <option value="10" <?= (isset($filter_month) && $filter_month == '10') ? 'selected' : '' ?>>October</option>
                                            <option value="11" <?= (isset($filter_month) && $filter_month == '11') ? 'selected' : '' ?>>November</option>
                                            <option value="12" <?= (isset($filter_month) && $filter_month == '12') ? 'selected' : '' ?>>December</option>
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <input type="number" name="filter_year" class="form-control form-control-sm" 
                                               placeholder="Year" min="2000" max="2099" 
                                               value="<?= isset($filter_year) ? $filter_year : '' ?>">
                                    </div>
                                </div>
                            </div>

                            <!-- Year Filter -->
                            <div id="year_filter" style="display: none;">
                                <input type="number" name="filter_year" class="form-control form-control-sm" 
                                       placeholder="Enter Year" min="2000" max="2099" 
                                       value="<?= isset($filter_year) ? $filter_year : '' ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-md-2">
                        <div class="d-flex gap-1">
                            <button type="submit" class="btn btn-secondary btn-sm">
                                <i class="fa fa-filter"></i> Filter
                            </button>
                            <a href="<?= module_url('prepdisp/dispList') ?>" class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-refresh"></i> Clear
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>


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
                    <?php if (!empty($disp_records)): ?>
                        <?php foreach ($disp_records as $record): ?>
                            <tr>
                                <td><?= $record->T08_DISP_ID ?></td>
                                <td><?= $record->T08_DRUG_NAME ?></td>
                                <td><?= $record->T08_BATCH_NO ?></td>
                                <td><?= $record->T08_DISP_UNITS ?></td>
                                <td><?= $record->T08_DISP_DATE ?></td>
                                <td><?= $record->T08_STAFF_DISP ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No dispensation records found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php if (!empty($disp_records)): ?>
    <script>
        $(document).ready(function () {
            // Initialize DataTable
            $('#dispTable').DataTable({
                "order": [[0, "desc"]],
                "pageLength": 25
            });

            // Show/hide appropriate filter inputs based on filter type
            function toggleDateFilters() {
                var filterType = $('#filter_type').val();
                
                // Hide all filter divs first
                $('#date_filter, #month_filter, #year_filter').hide();
                
                // Show appropriate filter based on selection
                switch(filterType) {
                    case 'date':
                        $('#date_filter').show();
                        break;
                    case 'month':
                        $('#month_filter').show();
                        break;
                    case 'year':
                        $('#year_filter').show();
                        break;
                }
            }
            
            // Initialize on page load
            toggleDateFilters();
            
            // Handle filter type change
            $('#filter_type').change(function() {
                toggleDateFilters();
            });
        });
    </script>
<?php endif; ?>