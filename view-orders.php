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
                    From bustling mornings to relaxing afternoons, <strong>Cafe Sua Da</strong> remains the favorite choice of our loyal customers.
                    This bold and creamy Vietnamese iced coffee has consistently topped our orders, earning its place as the true hallmark of the King Coffee Shop experience.
                </p>
            </div>
            <div class="col-md-6">
                <div id="menu-pie-chart" style="width: 100%; height: 300px;"></div>
            </div>
        </div>

        <div class="cta-section">
            <h2>Experience the Richness of King Coffee</h2>
            <p>Discover the authentic taste of our premium Vietnamese coffee. Whether you're a long-time enthusiast or new to our brews, we invite you to savor the unique flavors that set King Coffee apart.</p>
        </div>
            
        <?php include 'view-orders-newform.php'; ?>

        <div class="cta-section text-center py-5" style="background-color: #f8f9fa; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
            <h3 class="mb-3" style="font-weight: bold; color: #343a40;">Explore Our Ordering Records</h3>
            <p class="mb-4" style="color: #6c757d;">
                Dive into our comprehensive order history to discover the variety of coffee delights we offer and see how our customers savor their experiences with us.
            </p>
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
                        <h2 class="accordion-header" id="heading<?php echo htmlspecialchars($order['order_id']); ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo htmlspecialchars($order['order_id']); ?>" aria-expanded="false" aria-controls="collapse<?php echo htmlspecialchars($order['order_id']); ?>">
                                Order ID: <?php echo htmlspecialchars($order['order_id']); ?> - $<?php echo htmlspecialchars($order['total_amount']); ?>
                            </button>
                        </h2>
                        <div id="collapse<?php echo htmlspecialchars($order['order_id']); ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo htmlspecialchars($order['order_id']); ?>" data-bs-parent="#orderAccordion">
                            <div class="accordion-body">
                                <strong>Order Date:</strong> <?php echo htmlspecialchars($order['order_date']); ?><br>
                                <strong>Customer:</strong> <?php echo htmlspecialchars($order['firstname'] . ' ' . $order['lastname']); ?><br>
                                <strong>Total Amount:</strong> $<?php echo htmlspecialchars($order['total_amount']); ?><br>
                                <strong>Payment Method:</strong> <?php echo htmlspecialchars($order['payment_method'] ?? 'Not Provided'); ?><br>
                                <strong>Status:</strong> <?php echo htmlspecialchars($order['status'] ?? 'Not Provided'); ?><br>

                                <!-- Buttons for Actions -->
                                <form method="POST" action="order-details.php" style="display: inline;">
                                    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['order_id']); ?>">
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">View Details</button>
                                </form>
                                <button class="btn btn-warning btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#editOrderModal<?php echo htmlspecialchars($order['order_id']); ?>">Edit</button>
                                <form method="POST" action="" style="display: inline;">
                                    <input type="hidden" name="actionType" value="Delete">
                                    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['order_id']); ?>">
                                    <button type="submit" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Are you sure you want to delete this order?');">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php include 'view-orders-editform.php'; ?>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="text-center">No orders found.</div>
            <?php endif; ?>
        </div>
    </div>



    <!-- ECharts Script -->
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
