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
            <p class="lead">Explore and manage all customer orders seamlessly!</p>
        </div>
        <!-- Pie Chart -->
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

    <!-- Add Order Button -->
    <div class="mb-3">
        <?php include 'view-orders-newform.php'; ?>
    </div>

    <!-- Orders Accordion -->
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

                            <!-- Include Edit Order Modal -->
                            <?php include 'view-orders-editform.php'; ?>

                            <!-- Delete Order Button -->
                            <form method="post" action="" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                <input type="hidden" name="actionType" value="Delete">
                                <button type="submit" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Delete this order?');">Delete</button>
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

<!-- Include JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
<script>
    const data = <?php echo json_encode($menuPercentages); ?>;
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
