<?php
include "../Controllers/productInfoController.php";
$products = products();

if (empty($products)) {
    echo "No products found.";
} else {
    $totalQuantityAvailable = 0;
    $totalSold = 0;
    $totalExpectedSell = 0;
?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<div>
<div id="barChart"></div>
<script>
    var bar = {
        series: [
            {
                name: 'Actual',
                data: [
                    <?php 
                    foreach ($products as $product) {
                        $name = $product['name'];
                        $totalSold += $product['TotalSold'];
                        $expectedSell = $product['expectedSell'];
                        $totalExpectedSell += $expectedSell;
                        $quantityAvailable = $product['quantityAvailable'];
                        $totalQuantityAvailable += $quantityAvailable;
                        $totalAmountSoldBDT += $product['TotalSold'] * $product['price'];
                    ?>
                    {
                        x: '<?php echo $name; ?>',
                        y: <?php echo $product['TotalSold']; ?>,
                        goals: [
                            {
                                name: 'Expected',
                                value: <?php echo $expectedSell; ?>,
                                strokeHeight: 5,
                                strokeColor: '#775DD0'
                            }
                        ]
                    },
                    <?php
                    }
                    ?>
                ]
            }
        ],
        chart: {
            height: 350,
            type: 'bar'
        },
        plotOptions: {
            bar: {
                columnWidth: '60%'
            }
        },
        colors: ['#00E396'],
        dataLabels: {
            enabled: false
        },
        legend: {
            show: true,
            showForSingleSeries: true,
            customLegendItems: ['Actual', 'Expected'],
            markers: {
                fillColors: ['#00E396', '#775DD0']
            }
        }
    };
    var chart = new ApexCharts(document.querySelector("#barChart"), bar);
    chart.render();
</script>
</div>
<?php
}
?>
