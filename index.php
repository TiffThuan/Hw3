<?php
require_once('util-db.php');

$pageTitle = "Welcome to King Coffee Shop";
include "view-header.php";

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
    SELECT DATE_FORMAT(MIN(order_date), '%b') AS month, SUM(total_amount) AS total
    FROM orders
    GROUP BY DATE_FORMAT(order_date, '%Y-%m')
    ORDER BY MIN(order_date)";
$monthlySalesResult = $conn->query($monthlySalesQuery);

$months = [];
$sales = [];
if ($monthlySalesResult) {
    while ($row = $monthlySalesResult->fetch_assoc()) {
        $months[] = $row['month'];
        $sales[] = $row['total'];
    }
}

// Coffee Menu
$menuQuery = "SELECT product_name, price FROM products";
$menuResult = $conn->query($menuQuery);

$conn->close();
?>

<div class="container mt-4">
    <!-- Welcome Section -->
    <h1 class="text-center">Welcome to King Coffee Shop!</h1>
    <p class="text-center">Experience the best Vietnamese coffee in Oklahoma. Try our signature <strong>Cafe Sua Da</strong>.</p>

    <!-- Stats Section -->
    <div class="row text-center mt-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-header">Total Sales</div>
                <div class="card-body">
                    <h5>$<?php echo number_format($totalSales, 2); ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-header">Total Customers</div>
                <div class="card-body">
                    <h5><?php echo $totalCustomers; ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-header">Top Product</div>
                <div class="card-body">
                    <h5><?php echo htmlspecialchars($topProduct); ?></h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Section -->
    <div class="mt-5">
        <h3 class="text-center">Our Coffee Menu</h3>
        <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>Coffee</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($menuResult && $menuResult->num_rows > 0): ?>
                        <?php while ($menu = $menuResult->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($menu['product_name']); ?></td>
                                <td>$<?php echo number_format($menu['price'], 2); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2">No menu items found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Sales Chart Section -->
    <div class="mt-5">
        <h3 class="text-center">Monthly Sales Chart</h3>
        <div id="sales-chart" style="height: 300px;"></div>
    </div>
</div>

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
