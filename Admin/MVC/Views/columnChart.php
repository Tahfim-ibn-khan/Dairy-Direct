<?php
include "../Controllers/productInfoController.php";
$products = products();
if (empty($products)) {
    echo "No products found.";
} else {
    $quantities = [];
    $names = [];

    foreach ($products as $product) {
        $quantities[] = $product['quantityAvailable'];
        $names[] = $product['name'];
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    </head>
    <body>
        <div id="chart"></div>
        <script>
        var column = {
            series: [{
                data: <?php echo json_encode($quantities); ?>
            }],
            chart: {
                height: 350,
                type: 'bar',
                events: {
                    click: function(chart, w, e) {
                        // console.log(chart, w, e)
                    }
                }
            },
            colors: ['#FF4560', '#775DD0', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#00E396', '#FEB019'],
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true,
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            xaxis: {
                categories: <?php echo json_encode($names); ?>,
                labels: {
                    style: {
                        colors: ['#FF4560', '#775DD0', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#00E396', '#FEB019'],
                        fontSize: '12px'
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), column);
        chart.render();
        </script>
    </body>
    </html>
    <?php
}
?>
