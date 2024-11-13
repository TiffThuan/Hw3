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
    <div class="row mb-4">
        <div class="col text-center">
            <h1>Customers</h1>
        </div>
    </div>

    <!-- Search Box -->
    <div class="mb-4">
        <input type="text" id="customerSearch" class="form-control" placeholder="Search customers by name or email...">
    </div>

    <!-- Customer Table -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="customerTable">
            <thead class="thead-dark">
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
                        <!-- Edit -->
                        <form method="post" action="" style="display:inline;">
                            <input type="hidden" name="cid" value="<?php echo $customer['customer_id']; ?>">
                            <input type="hidden" name="actionType" value="Edit">
                            <button class="btn btn-primary btn-sm">Edit</button>
                        </form>
                        <!-- Delete -->
                        <form method="post" action="" style="display:inline;">
                            <input type="hidden" name="cid" value="<?php echo $customer['customer_id']; ?>">
                            <input type="hidden" name="actionType" value="Delete">
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- ECharts Integration -->
    <div class="mt-5">
        <h3 class="text-center">Customer Email Domains</h3>
        <div id="email-chart" style="height: 300px;"></div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
<script>
    // Filter Customer Table
    const searchInput = document.getElementById('customerSearch');
    const tableRows = document.querySelectorAll('#customerTable tbody tr');

    searchInput.addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        tableRows.forEach(row => {
            const name = row.cells[1].textContent.toLowerCase();
            const email = row.cells[2].textContent.toLowerCase();
            row.style.display = (name.includes(filter) || email.includes(filter)) ? '' : 'none';
        });
    });

    // Highlight Rows on Hover
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', () => row.style.backgroundColor = '#f1f1f1');
        row.addEventListener('mouseleave', () => row.style.backgroundColor = '');
    });

    // Email Domain Chart
    const emailChart = echarts.init(document.getElementById('email-chart'));
    emailChart.setOption({
        title: { text: 'Customer Email Distribution', left: 'center' },
        tooltip: { trigger: 'item' },
        series: [{
            name: 'Email Domains',
            type: 'pie',
            radius: '50%',
            data: <?php echo json_encode(array_map(function ($row) {
                return ['name' => $row['domain'], 'value' => $row['count']];
            }, iterator_to_array($emailDomains))); ?>
        }]
    });
</script>
</body>
</html>
