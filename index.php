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

<!-- Hero Section -->
<div class="hero-section text-center text-white" style="background-image: url('https://images.pexels.com/photos/19299641/pexels-photo-19299641/free-photo-of-sidewalk-cafe-with-books-in-the-window.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'); background-size: cover; padding: 100px 0;">
    <h1 class="display-4">Welcome to King Coffee Shop</h1>
    <p class="lead">Experience the rich flavors of authentic Vietnamese coffee.</p>
</div>

<!-- Commitment, Who are we, our story -->
<div id="commitment-section" class="container mt-5">
    <div class="row">
        <!-- Commitment Statement -->
        <div class="col-md-4">
            <h3 class="text-center">Our Commitment</h3>
            <p>
                At King Coffee Shop, we bring the best quality. Our target is to inspire and nurture the human spirit by providing an exceptional coffee experience. We are committed to serving high-quality, ethically sourced coffee while fostering a welcoming environment for our community.
            </p>
        </div>
        <!-- Who We Are Statement -->
        <div class="col-md-4">
            <h3 class="text-center">Who We Are</h3>
            <p>
                We are a team of coffee enthusiasts dedicated to delivering an exceptional experience to our customers. Our baristas are trained to craft each cup with precision and care, ensuring that every visit to King Coffee Shop is memorable. We believe in building lasting relationships with our patrons and contributing positively to our community.
            </p>
        </div>
        <!-- Our Story -->
        <div class="col-md-4">
            <h3 class="text-center">Our Story</h3>
            <p>
                Founded in 2024, King Coffee Shop began as a small neighborhood café with a passion for authentic Vietnamese coffee. Over the years, we have grown into a beloved local establishment, known for our signature brews and commitment to excellence. Our journey is a testament to our dedication to quality and community.
            </p>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var section = document.getElementById("commitment-section");
        if (section) {
            section.style.backgroundImage = "url('https://images.pexels.com/photos/302901/pexels-photo-302901.jpeg')";
            section.style.backgroundSize = "cover";
            section.style.backgroundPosition = "center";
            section.style.padding = "50px 0";
            section.style.color = "#fff";
        }
    });
</script>




<div class="container mt-4">
    <h2 class="text-center mb-4" style="color: #6b3e26;">The Details </h2>
        <p style="font-style: italic;">
           It is what we do best!
        </p>
    <!-- Stats Section -->
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
                    <tr>
                        <td>Latte</td>
                        <td>$4.00</td>
                    </tr>
                    <tr>
                        <td>Mocha</td>
                        <td>$4.75</td>
                    </tr>
                    <tr>
                        <td>Yogurt Shake</td>
                        <td>$2.85</td>
                    </tr>
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
        title: { text: 'Monthly Sales', left: 'center' },
        tooltip: { trigger: 'axis' },
        xAxis: { type: 'category', data: <?php echo json_encode($months); ?> },
        yAxis: { type: 'value' },
        series: [{ type: 'bar', data: <?php echo json_encode($sales); ?> }],
    });
</script>


<?php include "view-footer.php"; ?>
