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

    <!-- Search Bar -->
    <input type="text" id="customerSearch" class="form-control mb-4" placeholder="Search customers by name or email...">

    <!-- Customers Table -->
    <table class="table table-striped table-hover" id="customerTable">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Latest Order Date</th>
                <th>Product(s)</th>
                <th>Quantity</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($customersWithOrders && $customersWithOrders->num_rows > 0): ?>
                <?php while ($row = $customersWithOrders->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['customer_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['firstname'] . ' ' . $row['lastname']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['order_date'] ?? 'No Orders'); ?></td>
                        <td><?php echo htmlspecialchars($row['product_names'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($row['total_quantity'] ?? 0); ?></td>
                        <td><?php echo htmlspecialchars($row['total_amount'] ?? '0.00'); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">No customer data available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- ECharts Script -->
<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
<script>
    const customerChart = echarts.init(document.getElementById('customer-chart'));
    const months = <?php echo json_encode($months); ?>;
    const newCustomers = <?php echo json_encode($newCustomers); ?>;
    customerChart.setOption({
        title: { text: 'Customer Growth Over Time', left: 'center' },
        xAxis: { type: 'category', data: months },
        yAxis: { type: 'value' },
        series: [{
            name: 'New Customers',
            type: 'bar',
            data: newCustomers,
            itemStyle: { color: '#6b3e26' },
        }],
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
