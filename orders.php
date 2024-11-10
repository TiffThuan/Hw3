<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

require_once('util-db.php');
require_once('model-orders.php');

$pageTitle = "Orders";
include 'view-header.php';

if (isset($_POST['actionType'])) {
    // Action handling code remains unchanged
}

$orders = selectOrders(); // Fetch order data

?>

<div class="container mt-5">
    <h1 class="text-center">Manage Orders</h1>

    <!-- Chart Section -->
    <div class="mt-4">
        <h2 class="text-center">Order Summary</h2>
        <div id="sales-chart" style="width: 100%; height: 400px;"></div>
        <script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
        <script>
            var chart = echarts.init(document.getElementById('sales-chart'));
            chart.setOption({
                title: { text: 'Monthly Sales' },
                tooltip: {},
                xAxis: { data: ['Jan', 'Feb', 'Mar', 'Apr', 'May'] },
                yAxis: {},
                series: [{ type: 'bar', data: [1200, 1500, 1800, 2500, 3000] }]
            });
        </script>
    </div>

    <!-- Modal for Cart, Order, and Pay -->
    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#orderModal">Place an Order</button>

    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Create New Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="orderDate" class="form-label">Order Date</label>
                            <input type="date" class="form-control" id="orderDate" name="order_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="customerName" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="customerName" name="customer_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="totalAmount" class="form-label">Total Amount</label>
                            <input type="number" step="0.01" class="form-control" id="totalAmount" name="total_amount" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Order</button>
                    </form>
                </div>
            </div>
        </div>
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
