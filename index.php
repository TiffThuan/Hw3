<?php
require_once('util-db.php');

$pageTitle = "Welcome to King Coffee Shop";
include "view-header.php";

// Database Connection
$conn = get_db_connection();
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch Total Sales
$totalSalesResult = $conn->query("SELECT SUM(total_amount) AS total FROM orders");
$totalSales = $totalSalesResult ? $totalSalesResult->fetch_assoc()['total'] : 0;

// Fetch Total Customers
$totalCustomersResult = $conn->query("SELECT COUNT(DISTINCT customer_id) AS total FROM orders");
$totalCustomers = $totalCustomersResult ? $totalCustomersResult->fetch_assoc()['total'] : 0;

// Fetch Top Product
$topProductQuery = "
    SELECT p.product_name
    FROM order_details od
    JOIN products p ON od.product_id = p.productid
    GROUP BY p.product_name
    ORDER BY SUM(od.quantity) DESC
    LIMIT 1";
$topProductResult = $conn->query($topProductQuery);
$topProduct = $topProductResult ? $topProductResult->fetch_assoc()['product_name'] : 'No Data';

// Fetch Monthly Sales
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

$conn->close(); // Close connection
?>

<div class="container mt-4">
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
    <!-- Coffee Menu Section -->
    <div class="mt-4">
        <h2 class="text-center" style="color: #6b3e26; font-weight: bold;">Our Coffee Menu</h2>
        <div class="table-responsive">
            <table class="table table-hover text-center" style="border: 2px solid #6b3e26; color: #333;">
                <thead style="background-color: #6b3e26; color: white;">
                    <tr>
                        <th style="font-size: 1.2em;">Coffee</th>
                        <th style="font-size: 1.2em;">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Cafe Sua Da (Iced Coffee with Condensed Milk)</td>
                        <td>$4.00</td>
                    </tr>
                    <tr>
                        <td>Cafe Den Da (Iced Black Coffee)</td>
                        <td>$3.50</td>
                    </tr>
                    <tr>
                        <td>Hot Coffee</td>
                        <td>$3.00</td>
                    </tr>
                    <tr>
                        <td>Espresso</td>
                        <td>$2.50</td>
                    </tr>
                    <tr>
                        <td>Cappuccino</td>
                        <td>$4.50</td>
                    </tr>
                </tbody>
            </table>
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
