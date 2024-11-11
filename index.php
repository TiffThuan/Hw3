<?php
require_once('util-db.php'); // Ensure database connection is available

$pageTitle = "Welcome to King Coffee Shop";
include "view-header.php"; // Navigation bar

// Fetch data
$conn = get_db_connection();
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Total Sales
$totalSales = $conn->query("SELECT SUM(total_amount) AS total FROM orders")->fetch_assoc()['total'] ?? 0;

// Total Customers
$totalCustomers = $conn->query("SELECT COUNT(DISTINCT customer_id) AS total FROM orders")->fetch_assoc()['total'] ?? 0;

// Top Product
$topProductQuery = "
    SELECT p.product_name
    FROM order_details od
    JOIN products p ON od.product_id = p.productid
    GROUP BY p.product_name
    ORDER BY SUM(od.quantity) DESC
    LIMIT 1";
$topProduct = $conn->query($topProductQuery)->fetch_assoc()['product_name'] ?? 'No Data';

// Monthly Sales Data
$monthlySalesQuery = "
    SELECT DATE_FORMAT(order_date, '%b') AS month, SUM(total_amount) AS total
    FROM orders
    GROUP BY DATE_FORMAT(order_date, '%Y-%m')
    ORDER BY order_date";
$monthlySalesResult = $conn->query($monthlySalesQuery);

$months = [];
$sales = [];
if ($monthlySalesResult) {
    while ($row = $monthlySalesResult->fetch_assoc()) {
        $months[] = $row['month'];
        $sales[] = $row['total'];
    }
}

$conn->close(); // Close connection
?>

<div class="container mt-4">
    <!-- Introduction Section -->
    <div class="text-center">
        <h1>Welcome to King Coffee Shop!</h1>
        <p><em>Home of the best Vietnamese coffee in Oklahoma</em></p>
        <p>Try our signature <strong>Cafe Sua Da</strong>, loved by coffee enthusiasts worldwide.</p>
    </div>

    <!-- Stats Section -->
    <div class="row mt-4 text-center">
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-3">
                <div class="card-header">Total Sales</div>
                <div class="card-body">
                    <h5>$<?php echo number_format($totalSales, 2); ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white mb-3">
                <div class="card-header">Total Customers</div>
                <div class="card-body">
                    <h5><?php echo $totalCustomers; ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white mb-3">
                <div class="card-header">Top Product</div>
                <div class="card-body">
                    <h5><?php echo htmlspecialchars($topProduct); ?></h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Chart Section -->
    <div class="mt-5">
        <h3 class="text-center">Monthly Sales Chart</h3>
        <div id="sales-chart" style="height: 300px;"></div>
    </div>
</div>

<!-- ECharts Script -->
<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
<script>
    const chart = echarts.init(document.getElementById('sales-chart'));
    chart.setOption({
        title: { text: 'Monthly Sales' },
        tooltip: {},
        xAxis: { type: 'category', data: <?php echo json_encode($months); ?> },
        yAxis: { type: 'value' },
        series: [{ type: 'bar', data: <?php echo json_encode($sales); ?> }]
    });
</script>

<?php include "view-footer.php"; ?>
