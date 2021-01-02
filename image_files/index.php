<!DOCTYPE html>
<html>

<head>
    <title>Pax-Counter - Creating Dynamic Data Graph using PHP and Chart.js</title>
    <style type="text/css">
        BODY {
            width: 550PX;
        }

        #chart-container {
            width: 100%;
            height: auto;
        }
    </style>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>


</head>

<body>
    <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>

    <script>
        $(document).ready(function() {
            showGraph();
        });


        function showGraph() {
            {
                $.post("data.php",
                    function(data) {
                        var data_sensors = data[0];
                        var data_readings = data[1];
                        console.log(data_sensors);
                        console.log(data_readings);


                        var locations = [];
                        var pax_counts = [];

                        for (var i in data_sensors) {
                            locations.push(data_sensors[i].dev_location_name);
                        }
                        locations = locations.filter((value, index) => locations.indexOf(value) === index);

                        for (var location of locations) {
                            var devices_at_location = [];
                            for (var sensor of data_sensors) {
                                if (location === sensor.dev_location_name) {
                                    devices_at_location.push(sensor.dev_id);
                                }
                            }
                            console.log("devices_at_location:" + location + " are: " + devices_at_location);
                            var pax_counter = 0;
                            for (var reading of data_readings) {
                                if (devices_at_location.includes(reading.dev_id)) {
                                    pax_counter = pax_counter + Number(reading.count_wifi);
                                    pax_counter = pax_counter + Number(reading.count_ble);
                                }
                            }
                            console.log(pax_counter);
                            pax_counts.push(pax_counter);
                        }
                        console.log("pax_counter Ergebniss:" + pax_counts);
                        console.log("locations Ergebniss:" + locations);
                        console.log("pax_counter length:" + pax_counts.length);
                        console.log("locations length:" + locations.length);

                        var chartdata = {
                            labels: locations,
                            datasets: [{
                                label: 'Pax-Counter',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: pax_counts

                            }]
                        };

                        var graphTarget = $("#graphCanvas");

                        var barGraph = new Chart(graphTarget, {
                            type: 'bar',
                            data: chartdata,
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    });
            }
        }
    </script>

</body>

</html>