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
    <!-- Search Input -->
    <input type="text" id="customerSearch" class="form-control mb-3" placeholder="Search customers by name or email...">
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
                        <!-- Delete Button -->
                        <form method="post" action="" style="display:inline;">
                            <input type="hidden" name="cid" value="<?php echo $customer['customer_id']; ?>">
                            <input type="hidden" name="actionType" value="Delete">
                            <button class="btn btn-danger btn-sm" 
                                    onclick="return confirm('Are you sure you want to delete this customer?');">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- JavaScript for Search Filter -->
<script>
    // Get search input and table rows
    const searchInput = document.getElementById('customerSearch');
    const tableRows = document.querySelectorAll('#customerTable tbody tr');

    // Add event listener for search input
    searchInput.addEventListener('input', () => {
        const filter = searchInput.value.toLowerCase();
        tableRows.forEach(row => {
            const name = row.cells[1].textContent.toLowerCase(); // Name column
            const email = row.cells[2].textContent.toLowerCase(); // Email column
            row.style.display = name.includes(filter) || email.includes(filter) ? '' : 'none'; // Filter rows
        });
    });
</script>
</body>
</html>
