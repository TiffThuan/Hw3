<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers Data Tracking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Chart for New Customers -->
<div class="container mt-5">
    <h3 class="text-center">New Customers Over Time</h3>
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
<div class="container mt-5">
    <h1 class="text-center mb-4">Customers</h1>

    <!-- Introduction Section -->
    <div class="alert alert-info text-center">
        <p>Welcome! Manage your existing customers below or register a new customer.</p>
    </div>

    <!-- Button to Add New Customer -->
    <?php include 'view-customers-newform.php'; ?>

  
    <!-- Customer Cards -->
    <div class="row">
        <?php if ($customersWithOrders && $customersWithOrders->num_rows > 0): ?>
            <?php while ($row = $customersWithOrders->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['firstname'] . ' ' . $row['lastname']); ?></h5>
                            <p class="card-text">
                                <strong>Email:</strong> <?php echo htmlspecialchars($row['email'] ?? 'Not Provided'); ?><br>
                                <strong>Phone:</strong> <?php echo htmlspecialchars($row['phone'] ?? 'Not Provided'); ?><br>
                                <strong>Latest Order Date:</strong> <?php echo htmlspecialchars($row['order_date'] ?? 'No Orders'); ?><br>
                                <strong>Product(s):</strong> <?php echo htmlspecialchars($row['product_names'] ?? 'N/A'); ?><br>
                                <strong>Total Quantity:</strong> <?php echo htmlspecialchars($row['total_quantity'] ?? 0); ?><br>
                                <strong>Total Amount:</strong> $<?php echo htmlspecialchars($row['total_amount'] ?? '0.00'); ?><br>
                            </p>
                            <div class="d-flex justify-content-between">
                                <!-- View Full Orders -->
                                <a href="customers-with-orders.php?customer_id=<?php echo htmlspecialchars($row['customer_id']); ?>" class="btn btn-primary btn-sm">View Orders</a>
                                <!-- Include Edit Modal -->
                                <?php include 'view-customers-editform.php'; ?>
                                <!-- Delete Button -->
                                <form method="post" action="customers.php" style="display:inline;">
                                    <input type="hidden" name="cid" value="<?php echo htmlspecialchars($row['customer_id']); ?>">
                                    <input type="hidden" name="actionType" value="Delete">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this customer?');">Delete</button>
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
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
