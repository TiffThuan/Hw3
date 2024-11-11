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
        <!-- Row for Welcome and Pie Chart -->
        <div class="row mb-4">
            <!-- Welcome Section -->
            <div class="col-md-6 text-center">
                <h1>Welcome to King Coffee Shop</h1>
                <p class="lead">
                    At King Coffee Shop, we take pride in our signature product: <strong>Cafe Sua Da</strong>, a rich and aromatic Vietnamese iced coffee made with condensed milk. Experience the perfect blend of bold coffee and creamy sweetness that has captivated coffee lovers worldwide.
                </p>
            </div>
            <!-- Pie Chart Section -->
            <div class="col-md-6">
                <div id="menu-pie-chart" style="width: 100%; height: 300px;"></div>
            </div>
        </div>

        <!-- Orders Section -->
        <div class="row mb-4">
            <div class="col text-center">
                <h1>Orders</h1>
            </div>
        </div>

        <!-- Order List as Cards -->
        <div class="row">
            <?php if ($orders && $orders->num_rows > 0): ?>
                <?php while ($order = $orders->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Order ID: <?php echo htmlspecialchars($order['order_id']); ?></h5>
                                <p class="card-text">
                                    <strong>Order Date:</strong> <?php echo htmlspecialchars($order['order_date']); ?><br>
                                    <strong>Customer:</strong> <?php echo htmlspecialchars($order['firstname'] . ' ' . $order['lastname']); ?><br>
                                    <strong>Total Amount:</strong> $<?php echo htmlspecialchars($order['total_amount']); ?>
                                </p>
                                <a href="order-details.php?order_id=<?php echo htmlspecialchars($order['order_id']); ?>" class="btn btn-primary btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p>No orders found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
    <script>
        const data = <?php echo json_encode(array_map(function ($item) {
            return [
                'name' => $item['product_name'],
                'value' => round($item['percentage'], 2)
            ];
        }, $menuPercentages)); ?>;

        const chart = echarts.init(document.getElementById('menu-pie-chart'));
        chart.setOption({
            title: { text: 'Menu Contribution', left: 'center' },
            tooltip: { trigger: 'item', formatter: '{a} <br/>{b}: {c}%' },
            series: [{
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
            }]
        });
    </script>
</body>
</html>
