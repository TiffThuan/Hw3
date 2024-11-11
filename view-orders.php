<?php
require_once('util-db.php');
require_once('model-orders.php');

// Fetch orders
$orders = selectOrders();

// Fetch menu contribution percentages
$menuPercentages = calculateMenuPercentages();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col text-center">
            <h1>Orders</h1>
        </div>
    </div>

    <!-- Menu Contribution Chart -->
    <div class="row mb-4">
        <div id="menu-pie-chart" style="width: 100%; height: 300px;"></div>
    </div>

    <div class="list-group">
        <?php
        $orders = selectOrders(); // Dynamically fetch latest data
        if ($orders && $orders->num_rows > 0) {
            while ($order = $orders->fetch_assoc()) {
                ?>
                <div class="list-group-item">
                    <h5 class="mb-1">Order ID: <?php echo htmlspecialchars($order['order_id']); ?></h5>
                    <p><strong>Order Date:</strong> <?php echo htmlspecialchars($order['order_date']); ?></p>
                    <p><strong>Customer:</strong> <?php echo htmlspecialchars($order['firstname'] . ' ' . $order['lastname']); ?></p>
                    <p><strong>Total Amount:</strong> $<?php echo htmlspecialchars($order['total_amount']); ?></p>
                </div>
                <?php
            }
        } else {
            echo "<div class='list-group-item text-center'>No orders found.</div>";
        }
        ?>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
<script>
    // Use data from PHP to render the chart
    const data = <?php echo json_encode(array_map(function ($item) {
        return [
            'name' => $item['product_name'],
            'value' => round($item['percentage'], 2)
        ];
    }, $menuPercentages)); ?>;

    const chart = echarts.init(document.getElementById('menu-pie-chart'));
    chart.setOption({
        title: {
            text: 'Menu Contribution',
            left: 'center'
        },
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b}: {c}%'
        },
        series: [
            {
                name: 'Menu Items',
                type: 'pie',
                radius: '50%',
                data: data,
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ]
    });
</script>
</body>
</html>
