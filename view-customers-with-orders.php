<div class="container mt-5">
    <h1 class="text-center">Customers and Their Orders</h1>
    <div class="row">
        <?php if ($customersWithOrders && $customersWithOrders->num_rows > 0): ?>
            <?php while ($customer = $customersWithOrders->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($customer['firstname'] . ' ' . $customer['lastname']); ?></h5>
                            <p class="card-text">
                                <strong>Email:</strong> <?php echo htmlspecialchars($customer['email'] ?? 'N/A'); ?><br>
                                <strong>Phone:</strong> <?php echo htmlspecialchars($customer['phone'] ?? 'N/A'); ?><br>
                                <strong>Latest Order:</strong> <?php echo htmlspecialchars($customer['order_date'] ?? 'No Orders'); ?><br>
                                <strong>Total Orders:</strong> <?php echo htmlspecialchars($customer['total_quantity'] ?? 0); ?><br>
                                <strong>Total Amount:</strong> $<?php echo htmlspecialchars($customer['total_amount'] ?? '0.00'); ?>
                            </p>
                            <a href="view-order-details.php?customer_id=<?php echo $customer['customer_id']; ?>" class="btn btn-primary btn-sm">View Orders</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p>No customers with orders found.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
