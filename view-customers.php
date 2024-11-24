<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers Data Tracking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('coffee-background.jpg');
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
            color: #fff;
        }
        .card {
            background: #ffffff;
            border: none;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
            border-radius: 10px;
        }
        .accordion-button:not(.collapsed) {
            background-color: #e8f0fe;
            color: #000;
        }
        .btn {
            margin: 0 5px;
        }
        .search-bar {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Customers</h1>

        <!-- Introduction Section -->
        <div class="jumbotron text-center" style="background: linear-gradient(135deg, #d4a373, #ffebc7); color: #3b2f2f; padding: 50px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
            <div class="container">
                <h2 class="display-5">Welcome to King Coffee Shop's Customer Management</h2>
                <p class="lead">Manage your existing customers below or register a new customer to enhance our community.</p>
                <a href="register-customer.php" class="btn btn-primary btn-lg mt-3" style="background-color: #6b3e26; border: none;">Register New Customer</a>
            </div>
        </div>
        
        <!-- Customer Feedback Section -->
        <div class="container mt-5">
            <div class="alert text-center" style="background-image: url('https://www.pexels.com/photo/coffee-background/'); background-size: cover; background-position: center; color: white; padding: 50px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
                <h2 class="mb-4" style="font-weight: bold;">Customer Feedback</h2>
                <p>At King Coffee Shop, we highly value our customers' opinions. Your feedback helps us enhance our services and deliver exceptional experiences. We invite you to explore the feedback shared by our valued customers.</p>
                <a href="view-products-with-reviews.php" class="btn btn-success btn-lg mt-3" style="background-color: #3b2f2f; border: none;">Explore Customer Feedback</a>
            </div>
        </div>

        <!-- Button to Add New Customer -->
        <?php include 'view-customers-newform.php'; ?>

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" id="searchInput" class="form-control" placeholder="Search customers by name, email, or phone...">
        </div>

        <!-- Customers Accordion -->
        <div class="accordion" id="customersAccordion">
            <?php if ($customersWithOrders && $customersWithOrders->num_rows > 0): ?>
                <?php while ($row = $customersWithOrders->fetch_assoc()): ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading<?php echo $row['customer_id']; ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $row['customer_id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $row['customer_id']; ?>">
                                <?php echo htmlspecialchars($row['firstname'] . ' ' . $row['lastname']); ?>
                            </button>
                        </h2>
                        <div id="collapse<?php echo $row['customer_id']; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $row['customer_id']; ?>" data-bs-parent="#customersAccordion">
                            <div class="accordion-body">
                                <p>
                                    <strong>Email:</strong> <?php echo htmlspecialchars($row['email'] ?? 'Not Provided'); ?><br>
                                    <strong>Phone:</strong> <?php echo htmlspecialchars($row['phone'] ?? 'Not Provided'); ?><br>
                                    <strong>Latest Order Date:</strong> <?php echo htmlspecialchars($row['order_date'] ?? 'No Orders'); ?><br>
                                    <strong>Product(s):</strong> <?php echo htmlspecialchars($row['product_names'] ?? 'N/A'); ?><br>
                                    <strong>Total Quantity:</strong> <?php echo htmlspecialchars($row['total_quantity'] ?? 0); ?><br>
                                    <strong>Total Amount:</strong> $<?php echo htmlspecialchars($row['total_amount'] ?? '0.00'); ?>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <a href="view-order-details.php?customer_id=<?php echo htmlspecialchars($row['customer_id']); ?>" class="btn btn-primary btn-sm">View Orders</a>
                                    <!-- Edit Customer -->
                                    <?php include 'view-customers-editform.php'; ?>
                                    <!-- Delete Customer -->
                                    <form method="post" action="" class="d-inline">
                                        <input type="hidden" name="cid" value="<?php echo htmlspecialchars($row['customer_id']); ?>">
                                        <input type="hidden" name="actionType" value="Delete">
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this customer?');">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="text-center alert alert-warning">No customer data available.</div>
            <?php endif; ?>
        </div>

        <!-- Pagination (if needed) -->
        <!-- Add your pagination logic here -->
        <div class="container mt-5">
            <h3 class="text-center">New Customers Over Time</h3>
            <p class="text-center">This chart displays the number of new customers acquired each month.</p>
            <div id="customer-chart" style="height: 400px;"></div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
        <script>
            const customerChart = echarts.init(document.getElementById('customer-chart'));
            const options = {
                title: { text: 'Customer Growth Over Time', left: 'center' },
                tooltip: { trigger: 'axis' },
                xAxis: { type: 'category', data: <?php echo json_encode($months); ?> },
                yAxis: { type: 'value', name: 'New Customers' },
                series: [{
                    name: 'New Customers',
                    type: 'bar',
                    data: <?php echo json_encode($newCustomers); ?>,
                    itemStyle: { color: '#6b3e26' },
                }],
            };
            customerChart.setOption(options);
        </script>


        <!-- Chart for New Customers -->
        <div class="container mt-5">
            <h3 class="text-center">New Customers Over Time</h3>
            <div id="customer-chart" style="height: 400px;"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
    <script>
        // Search Functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const accordionItems = document.querySelectorAll('.accordion-item');

::contentReference[oaicite:0]{index=0}
 
