<!-- staffDispense.php - View for displaying drug dispensing by staff -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Drug Dispensing by Staff</h4>
                </div>
                <div class="card-body">
                    <!-- Display current month and summary -->
                    <div id="summarySection" class="mb-4">
                        <h5>Current Month: <span id="currentMonthText"></span></h5>
                        <table class="table table-bordered table-sm mt-3">
                            <thead class="thead-light">
                                <tr>
                                    <th>Staff Name</th>
                                    <th>Total Units Dispensed</th>
                                </tr>
                            </thead>
                            <tbody id="summaryTableBody">
                                <!-- Filled dynamically -->
                            </tbody>
                        </table>
                    </div>
                    <!-- Filter Form -->
                    <div class="mb-2">
                        <h5 class="fw-bold text-primary">Add Filters to Show Specific Dates, Months, Year and by Drugs, or Staff</h5>
                    </div>
                    <form method="get" action="<?= current_url() ?>" class="mb-4">
                        <div class="row align-items-end">
                            <div class="col-md-3">
                                <label for="search">Drug Name</label>
                                <select name="search" class="form-select form-select-sm">
                                    <option value="">All Drugs</option>
                                    <?php foreach ($drug_options as $drug): ?>
                                        <option value="<?= $drug->T08_DRUG_NAME ?>" <?= (isset($search) && $search == $drug->T08_DRUG_NAME) ? 'selected' : '' ?>>
                                            <?= $drug->T08_DRUG_NAME ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="staff">Staff Name</label>
                                <select name="staff" class="form-select form-select-sm">
                                    <option value="">All Staff</option>
                                    <?php foreach ($staff_options as $staff): ?>
                                        <option value="<?= $staff->T08_STAFF_DISP ?>" <?= (isset($staff) && $staff == $staff->T08_STAFF_DISP) ? 'selected' : '' ?>>
                                            <?= $staff->T08_STAFF_DISP ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>


                            <div class="col-md-2">
                                <label for="filter_type">Filter By</label>
                                <select name="filter_type" id="filter_type" class="form-select form-select-sm">
                                    <option value="">No Filter</option>
                                    <option value="date" <?= (isset($filter_type) && $filter_type == 'date') ? 'selected' : '' ?>>Specific Date</option>
                                    <option value="month" <?= (isset($filter_type) && $filter_type == 'month') ? 'selected' : '' ?>>Month</option>
                                    <option value="year" <?= (isset($filter_type) && $filter_type == 'year') ? 'selected' : '' ?>>Year</option>
                                </select>
                            </div>

                            <div class="col-md-2" id="date_filter" style="display: none;">
                                <label for="filter_date">Date</label>
                                <input type="date" name="filter_date" class="form-control form-control-sm"
                                    value="<?= isset($filter_date) ? $filter_date : '' ?>">
                            </div>

                            <div class="col-md-2" id="month_filter" style="display: none;">
                                <label for="filter_month">Month</label>
                                <select name="filter_month" class="form-select form-select-sm">
                                    <option value="">Month</option>
                                    <?php for ($m = 1; $m <= 12; $m++): ?>
                                        <option value="<?= $m ?>" <?= (isset($filter_month) && $filter_month == $m) ? 'selected' : '' ?>>
                                            <?= date('F', mktime(0, 0, 0, $m, 1)) ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="col-md-2" id="year_filter" style="display: none;">
                                <label for="filter_year">Year</label>
                                <input type="number" name="filter_year" class="form-control form-control-sm"
                                    value="<?= isset($filter_year) ? $filter_year : '' ?>" min="2000" max="2099">
                            </div>

                            <div class="col-md-2 mt-2">
                                <button type="submit" class="btn btn-sm btn-primary mt-4">Apply Filter</button>
                            </div>
                        </div>
                    </form>
                    <!-- Chart Canvas -->
                    <div style="height: 500px;">
                        <canvas id="dispensingChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Store chart instance to destroy it when updating
    let dispensingChart = null;

    // Function to initialize the chart with data
    function initializeChart(chartData) {

        console.log(chartData);
        // Prepare data for the chart
        const staffNames = chartData.map(item => item.staff_name);
        const dispensedUnits = chartData.map(item => Number(item.TOTAL_UNITS) || 0);

        // Get the chart context
        const ctx = document.getElementById('dispensingChart').getContext('2d');

        // Destroy existing chart if it exists
        if (dispensingChart) {
            dispensingChart.destroy();
        }

        // Define chart data
        const data = {
            labels: staffNames,
            datasets: [{
                label: 'Units Dispensed',
                data: dispensedUnits,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        // Create chart configuration
        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Drug Dispensing by Staff'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        title: {
                            display: true,
                            text: 'Number of Units Dispensed'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Staff Name'
                        }
                    }
                }
            },
        };

        // Create the chart
        dispensingChart = new Chart(ctx, config);
        updateSummary(chartData);
    }

    // Load initial chart data
    document.addEventListener('DOMContentLoaded', function () {
        // Initial chart data
        const initialData = <?php echo json_encode($dispensing_data); ?>;
        initializeChart(initialData);

    });

    function updateSummary(chartData) {
        // Get current month and year
        const now = new Date();
        const monthNames = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        const monthText = `${monthNames[now.getMonth()]} ${now.getFullYear()}`;

        document.getElementById("currentMonthText").textContent = monthText;

        // Fill the summary table
        const tbody = document.getElementById("summaryTableBody");
        tbody.innerHTML = ''; // Clear previous rows

        chartData.forEach(item => {
            const staffName = item.staff_name || "-";
            const totalUnits = item.TOTAL_UNITS || 0;

            const row = document.createElement("tr");
            row.innerHTML = `<td>${staffName}</td><td>${totalUnits}</td>`;
            tbody.appendChild(row);
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        const typeSelect = document.getElementById('filter_type');
        const dateFilter = document.getElementById('date_filter');
        const monthFilter = document.getElementById('month_filter');
        const yearFilter = document.getElementById('year_filter');

        function toggleFilters() {
            const type = typeSelect.value;
            dateFilter.style.display = (type === 'date') ? 'block' : 'none';
            monthFilter.style.display = (type === 'month') ? 'block' : 'none';
            yearFilter.style.display = (type === 'month' || type === 'year') ? 'block' : 'none';
        }

        toggleFilters();
        typeSelect.addEventListener('change', toggleFilters);
    });
</script>