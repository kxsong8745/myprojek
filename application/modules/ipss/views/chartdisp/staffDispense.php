<!-- staffDispense.php - View for displaying drug dispensing by staff -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Drug Dispensing by Staff</h4>
                </div>
                <div class="card-body">
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

    });


</script>