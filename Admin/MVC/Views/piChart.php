<?php
include "../Controllers/order_handle_controller.php";
$orders = orders();

if (empty($orders)) {
    echo "No orders found.";
} else {
    $inprogressOrders = 0;
    $pendingOrders = 0;
    $completeOrders = 0;

    foreach ($orders as $order) {
        switch ($order['status']) {
            case 'in progress':
                $inprogressOrders++;
                break;
            case 'pending':
                $pendingOrders++;
                break;
            case 'complete':
                $completeOrders++;
                break;
        }
    }
    ?>

        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <div>
        <div id="pichart"></div>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            var pi = {
                series: [<?php echo $inprogressOrders; ?>, <?php echo $pendingOrders; ?>, <?php echo $completeOrders; ?>],
                chart: {
                    type: 'donut',
                    height: 350
                },
                labels: ['Inprogress Orders', 'Pending Orders', 'Complete Orders'],
                colors: ['#00E396', '#FEB019', '#FF4560'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }],
                title: {
                    text: 'Order Status Distribution',
                    align: 'center'
                }
            };

            var chart = new ApexCharts(document.querySelector("#pichart"), pi);
            chart.render();
        });
        </script>
    </div>
    <?php
}
?>
