<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Customers</h1>

    <!-- Introduction Section -->
    <div class="alert alert-info text-center">
        <p>Welcome! Manage your existing customers below or register a new customer.</p>
    </div>

    <!-- Accordion for Customers -->
    <div class="accordion" id="customerAccordion">
        <?php if ($customersWithOrders && $customersWithOrders->num_rows > 0): ?>
            <?php while ($row = $customersWithOrders->fetch_assoc()): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?php echo $row['customer_id']; ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $row['customer_id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $row['customer_id']; ?>">
                            <?php echo htmlspecialchars($row['firstname'] . ' ' . $row['lastname']); ?>
                        </button>
                    </h2>
                    <div id="collapse<?php echo $row['customer_id']; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $row['customer_id']; ?>" data-bs-parent="#customerAccordion">
                        <div class="accordion-body">
                            <strong>Email:</strong> <?php echo htmlspecialchars($row['email'] ?? 'Not Provided'); ?><br>
                            <strong>Phone:</strong> <?php echo htmlspecialchars($row['phone'] ?? 'Not Provided'); ?><br>
                            <strong>Latest Order Date:</strong> <?php echo htmlspecialchars($row['order_date'] ?? 'No Orders'); ?><br>
                            <strong>Product(s):</strong> <?php echo htmlspecialchars($row['product_names'] ?? 'N/A'); ?><br>
                            <strong>Total Quantity:</strong> <?php echo htmlspecialchars($row['total_quantity'] ?? 0); ?><br>
                            <strong>Total Amount:</strong> $<?php echo htmlspecialchars($row['total_amount'] ?? '0.00'); ?><br>
                            <a href="view-order-details.php?customer_id=<?php echo $row['customer_id']; ?>" class="btn btn-primary btn-sm mt-2">View Full Order Details</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="text-center alert alert-warning">No customer data available.</div>
        <?php endif; ?>
    </div>


    <!-- Chart for New Customers -->
    <div class="container mt-5">
        <h3 class="text-center">New Customers Over Time</h3>
        <div id="customer-chart" style="height: 400px;"></div>
    </div>
</div>

<!-- Chart JS -->
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
