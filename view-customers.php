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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($customer = $customers->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($customer['customer_id']); ?></td>
                    <td><?php echo htmlspecialchars($customer['firstname'] . ' ' . $customer['lastname']); ?></td>
                    <td><?php echo htmlspecialchars($customer['email']); ?></td>
                    <td><?php echo htmlspecialchars($customer['phone']); ?></td>
                    <td>
                        <!-- View Orders Button -->
                        <a href="customers-with-orders.php?customer_id=<?php echo $customer['customer_id']; ?>" 
                           target="_blank" 
                           class="btn btn-info btn-sm mb-1">
                           View Orders
                        </a>
                        <!-- Include Add Customer Modal -->
                        <?php include 'view-customers-newform.php'; ?>
                        <!-- Include the Edit Customer Modal -->
                        <?php include 'view-customers-editform.php'; ?>
                        <!-- Delete Button -->
                        <form method="post" action="" style="display:inline;">
                            <input type="hidden" name="cid" value="<?php echo $customer['customer_id']; ?>">
                            <input type="hidden" name="actionType" value="Delete">
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this customer?');">Delete</button>
                        </form>
                    </td>
                </tr>

            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<div class="container mt-5">
    <h3 class="text-center">New Customers Over Time</h3>
    <div id="customer-chart" style="height: 400px;"></div>
</div>

<script>
    // JavaScript for Search Filter
    const searchInput = document.getElementById('customerSearch');
    const tableRows = document.querySelectorAll('#customerTable tbody tr');

    searchInput.addEventListener('input', () => {
        const filter = searchInput.value.toLowerCase();
        tableRows.forEach(row => {
            const name = row.cells[1].textContent.toLowerCase();
            const email = row.cells[2].textContent.toLowerCase();
            row.style.display = name.includes(filter) || email.includes(filter) ? '' : 'none';
        });
    });
</script>
<div class="container mt-5">
    <h3 class="text-center">Customer Growth Over Time</h3>
    <div id="customer-chart" style="height: 400px;"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
<script>
    // ECharts for Customer Growth
    const customerChart = echarts.init(document.getElementById('customer-chart'));

    const options = {
        title: {
            text: 'Customer Growth Over Time',
            left: 'center',
            textStyle: { color: '#6b3e26' },
        },
        tooltip: { trigger: 'axis' },
        xAxis: {
            type: 'category',
            data: <?php echo json_encode($months); ?>,
            axisLabel: { rotate: 45 },
        },
        yAxis: {
            type: 'value',
            name: 'New Customers',
            axisLine: { lineStyle: { color: '#6b3e26' } },
        },
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
