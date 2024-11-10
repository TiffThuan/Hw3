<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

require_once('util-db.php');
require_once('model-orders.php');

$pageTitle = "Orders";
include 'view-header.php';

$orders = selectOrders(); // Fetch order data

// Example menu data (replace this with dynamic data from your database if needed)
$menuData = [
    ['name' => 'Cafe Sua Da', 'value' => 35],
    ['name' => 'Cafe Den Da', 'value' => 30],
    ['name' => 'Hot Coffee', 'value' => 20],
    ['name' => 'Espresso', 'value' => 10],
    ['name' => 'Cappuccino', 'value' => 5],
];
?>

<div class="container mt-5">
    <h1 class="text-center">Orders</h1>

    <!-- Chart Section -->
    <div class="mt-4">
        <h2 class="text-center">Menu Contribution</h2>
        <div id="menu-chart" style="width: 100%; height: 400px;"></div>
        <script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
        <script>
            var chart = echarts.init(document.getElementById('menu-chart'));
            chart.setOption({
                title: { text: 'Menu Contribution', left: 'center' },
                tooltip: { trigger: 'item' },
                series: [
                    {
                        name: 'Menu Items',
                        type: 'pie',
                        radius: '50%',
                        data: <?php echo json_encode($menuData); ?>,
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
    </div>

    <!-- Order List Section -->
    <div class="mt-4">
        <h2 class="text-center">Order List</h2>
        <div class="list-group">
            <?php if ($orders && $orders->num_rows > 0): ?>
                <?php while ($order = $orders->fetch_assoc()): ?>
                    <div class="list-group-item">
                        <h5 class="mb-1">Order ID: <?php echo htmlspecialchars($order['order_id']); ?></h5>
                        <p><strong>Customer:</strong> <?php echo htmlspecialchars($order['firstname'] . ' ' . $order['lastname']); ?></p>
                        <p><strong>Total Amount:</strong> $<?php echo htmlspecialchars($order['total_amount']); ?></p>
                        <a href="order-details.php?order_id=<?php echo $order['order_id']; ?>" class="btn btn-info btn-sm">View Details</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="list-group-item text-center">No orders found.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'view-footer.php'; ?>
