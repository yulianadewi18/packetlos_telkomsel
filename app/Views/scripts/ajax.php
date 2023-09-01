<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script> <!-- Include the Accessibility module -->
<script>
    $(document).ready(function() {
        $.ajax({
            type: "Get",
            url: `http://localhost:8080/Home/getDatabyWeek`,
            success: function(response) {
                // Handle the response from the server (if needed)
                console.log(response);
                const clearData = response.pl_clear;
                const spikeData = response.pl_spike;
                const consecutiveData = response.pl_consecutive;

                // Call the function to update the charts with the initial data
                updateCharts(clearData, spikeData, consecutiveData);
            },
            error: function() {
                console.error("An error occurred while making the AJAX request.");
            }
        });

        $.ajax({
            type: "GET",
            url: `http://localhost:8080/Home/getDatabyWeekGroup`,
            success: function(response) {
                // Handle the response from the server (if needed)
                const weeksData = response.weeksData;
                createColumnChart(weeksData);
            },
            error: function() {
                console.error("An error occurred while making the AJAX request.");
            }
        });

        $("select[name='week']").change(function() {
            const selectedValue = $(this).val();
            console.log(selectedValue);

            // Make the AJAX request
            $.ajax({
                type: "GET",
                url: `http://localhost:8080/Home/getDatabyWeek/${selectedValue}`,
                success: function(response) {
                    // Handle the response from the server (if needed)
                    console.log(response);
                    const clearData = response.pl_clear;
                    const spikeData = response.pl_spike;
                    const consecutiveData = response.pl_consecutive;

                    // Call the function to update the charts with new data
                    updateCharts(clearData, spikeData, consecutiveData);
                },
                error: function() {
                    console.error("An error occurred while making the AJAX request.");
                }
            });
            $.ajax({
                type: "GET",
                url: `http://localhost:8080/Home/getDatabyWeekGroup/${selectedValue}`,
                success: function(response) {
                    // Handle the response from the server (if needed)
                    const weeksData = response.weeksData;
                    createColumnChart(weeksData);
                },
                error: function() {
                    console.error("An error occurred while making the AJAX request.");
                }
            });
        });
    });

    function updateCharts(clearData, spikeData, consecutiveData) {


        // Create the donut chart using Highcharts
        Highcharts.chart('donatChart', {
            chart: {
                type: 'pie'
            },
            accessibility: {
                enabled: false // Disable accessibility module
            },
            title: {
                text: 'PacketLoss Per Minggu'
            },
            plotOptions: {
                pie: {
                    colors: ['green', 'yellow', 'red'] // Set colors for CLEAR, SPIKE, and CONSECUTIVE
                }
            },
            series: [{
                data: [{
                        name: 'CLEAR',
                        y: clearData
                    },
                    {
                        name: 'SPIKE',
                        y: spikeData
                    },
                    {
                        name: 'CONSECUTIVE',
                        y: consecutiveData
                    }
                ],
                type: 'pie'
            }]
        });
    }

    function createColumnChart(data) {
        data.forEach(item => {
            item.spike_count = parseInt(item.spike_count);
            item.clear_count = parseInt(item.clear_count);
            item.consecutive_count = parseInt(item.consecutive_count);
        });
        Highcharts.chart('columnChart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Data Consecutive NOP'
            },
            xAxis: {
                categories: data.map(item => item.nop),
                crosshair: true
            },
            yAxis: {
                title: {
                    text: 'Count'
                },
                min: 0
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            tooltip: {
                shared: true
            },
            series: [{
                name: 'SPIKE',
                data: data.map(item => item.spike_count),
                color: 'yellow' // Yellow for SPIKE
            }, {
                name: 'CLEAR',
                data: data.map(item => item.clear_count),
                color: 'green' // Green for CLEAR
            }, {
                name: 'CONSECUTIVE',
                data: data.map(item => item.consecutive_count),
                color: 'red' // Green for CLEAR
            }],
            credits: {
                enabled: false
            }
        });
    }
</script>