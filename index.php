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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            background-image: url('https://images.pexels.com/photos/302901/pexels-photo-302901.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #333;
        }
        .section-background {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }
        .hero-section {
            background-image: url('https://images.pexels.com/photos/2416877/pexels-photo-2416877.jpeg');
            background-size: cover;
            padding: 100px 0;
            background-position: center;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }
        .hero-section > div {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 50px;
        }
        h1, h2, h3 {
            color: #6b3e26;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section text-center text-white">
        <div>
            <h1 class="display-4">Welcome to King Coffee Shop</h1>
            <p class="lead">Experience the rich flavors of authentic Vietnamese coffee.</p>
        </div>
    </div>

    <!-- Commitment Section -->
    <div class="section-background container">
        <div class="row">
            <div class="col-md-4">
                <h3 class="text-center">Our Commitment</h3>
                <p>We bring the best quality. Our target is to inspire and nurture the human spirit by providing an exceptional coffee experience.</p>
            </div>
            <div class="col-md-4">
                <h3 class="text-center">Who We Are</h3>
                <p>We are a team of coffee enthusiasts dedicated to delivering an exceptional experience to our customers.</p>
            </div>
            <div class="col-md-4">
                <h3 class="text-center">Our Story</h3>
                <p>Founded in 2024, King Coffee Shop began as a small neighborhood café with a passion for authentic Vietnamese coffee.</p>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="section-background container mt-4">
        <h2 class="text-center mb-4" style="color: #6b3e26;">The Details</h2>
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card border-dark">
                    <div class="card-header bg-dark text-white">Total Sales</div>
                    <div class="card-body">
                        <h5>$<?php echo number_format($totalSales, 2); ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-dark">
                    <div class="card-header bg-dark text-white">Total Customers</div>
                    <div class="card-body">
                        <h5><?php echo $totalCustomers; ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-dark">
                    <div class="card-header bg-dark text-white">Top Product</div>
                    <div class="card-body">
                        <h5><?php echo htmlspecialchars($topProduct); ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Coffee Menu Section -->
    <div class="section-background container mt-4">
        <h2 class="text-center" style="color: #6b3e26;">Our Coffee Menu</h2>
        <div class="table-responsive">
            <table class="table table-hover text-center" style="border: 2px solid #6b3e26;">
                <thead style="background-color: #6b3e26; color: white;">
                    <tr>
                        <th>Coffee</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Cafe Sua Da</td><td>$4.00</td></tr>
                    <tr><td>Cafe Den Da</td><td>$3.50</td></tr>
                    <tr><td>Hot Coffee</td><td>$3.00</td></tr>
                    <tr><td>Espresso</td><td>$2.50</td></tr>
                    <tr><td>Cappuccino</td><td>$4.50</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Sales Chart Section -->
    <div class="section-background container mt-5">
        <h3 class="text-center">Monthly Sales Chart</h3>
        <div id="sales-chart" style="height: 300px;"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
    <script>
        const chart = echarts.init(document.getElementById('sales-chart'));
        chart.setOption({
            backgroundColor: 'rgba(255, 255, 255, 0.8)',
            title: { text: 'Monthly Sales', left: 'center' },
            tooltip: { trigger: 'axis' },
            xAxis: { type: 'category', data: <?php echo json_encode($months); ?> },
            yAxis: { type: 'value' },
            series: [{ 
                type: 'bar', 
                data: <?php echo json_encode($sales); ?>,
                itemStyle: { color: '#28a745' }
            }],
        });
    </script>
</body>
</html>
<?php include "view-footer.php"; ?>
