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
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-md-6 text-center">
                <h1>The Heart of King Coffee Shop</h1>
                <p class="lead">
                    From bustling mornings to relaxing afternoons, <strong>Cafe Sua Da</strong> remains the favorite choice of our loyal customers. This bold and creamy Vietnamese iced coffee has consistently topped our orders, earning its place as the true hallmark of the King Coffee Shop experience.
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

        <!-- Orders List -->
        <div class="accordion" id="orderAccordion">
            <?php if ($orders && $orders->num_rows > 0): ?>
                <?php while ($order = $orders->fetch_assoc()): ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading<?php echo $order['order_id']; ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $order['order_id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $order['order_id']; ?>">
                                Order ID: <?php echo htmlspecialchars($order['order_id']); ?>
                            </button>
                        </h2>
                        <div id="collapse<?php echo $order['order_id']; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $order['order_id']; ?>" data-bs-parent="#orderAccordion">
                            <div class="accordion-body">
                                <strong>Order Date:</strong> <?php echo htmlspecialchars($order['order_date']); ?><br>
                                <strong>Customer:</strong> <?php echo htmlspecialchars($order['firstname'] . ' ' . $order['lastname']); ?><br>
                                <strong>Total Amount:</strong> $<?php echo htmlspecialchars($order['total_amount']); ?><br>
                                <form method="POST" action="order-details.php">
                                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">View Details</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="text-center">No orders found.</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Pie Chart Script -->
    <script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
    <script>
        // Dynamically fetched menu data
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
