<!-- staffDispense.php - View for displaying drug dispensing by staff -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Drug Dispensing by Staff</h4>
                </div>
                <div class="card-body">
                    <!-- Filter Controls -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="drug_filter">Select Drug:</label>
                                <select id="drug_filter" class="form-control">
                                    <option value="">All Drugs</option>
                                    <?php foreach ($drugs as $drug): ?>
                                        <option value="<?php echo $drug->T08_DRUG_NAME; ?>">
                                            <?php echo $drug->T08_DRUG_NAME; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="time_filter">Time Period:</label>
                                <select id="time_filter" class="form-control">
                                    <option value="">All Time</option>
                                    <option value="day">Today</option>
                                    <option value="month">This Month</option>
                                    <option value="year">This Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mt-4">
                            <button id="apply_filters" class="btn btn-primary">Apply Filters</button>
                        </div>
                    </div>

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
    }

    // Load initial chart data
    document.addEventListener('DOMContentLoaded', function () {
        // Initial chart data
        const initialData = <?php echo json_encode($dispensing_data); ?>;
        initializeChart(initialData);

        // Handle filter button click
        document.getElementById('apply_filters').addEventListener('click', function () {
            updateChart();
        });
    });

    // Function to update chart based on filters
    function updateChart() {
        const drugFilter = document.getElementById('drug_filter').value;
        const timeFilter = document.getElementById('time_filter').value;

        // Update chart title based on filters
        let chartTitle = 'Drug Dispensing by Staff';
        if (drugFilter) {
            chartTitle = drugFilter + ' - Dispensing by Staff';
        }

        // Add time period to title
        if (timeFilter === 'day') {
            chartTitle += ' (Today)';
        } else if (timeFilter === 'month') {
            chartTitle += ' (This Month)';
        } else if (timeFilter === 'year') {
            chartTitle += ' (This Year)';
        }

        // Make AJAX request to get filtered data
        $.ajax({
            url: '<?php echo base_url('report/getFilteredDispensingData'); ?>',
            type: 'POST',
            data: {
                drug_id: drugFilter,
                time_period: timeFilter
            },
            dataType: 'json',
            success: function (response) {
                // Update chart with new data
                initializeChart(response);

                // Update chart title
                if (dispensingChart) {
                    dispensingChart.options.plugins.title.text = chartTitle;
                    dispensingChart.update();
                }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching data:', error);
                alert('An error occurred while fetching data. Please try again.');
            }
        });
    }
</script>