<div class="container mt-5">
    <h1 class="text-center mb-4">Customers and Their Orders</h1>
    <div class="row g-4">
        <?php if ($customersWithOrders && $customersWithOrders->num_rows > 0): ?>
            <?php while ($customer = $customersWithOrders->fetch_assoc()): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary">
                                <?php echo htmlspecialchars($customer['firstname'] . ' ' . $customer['lastname']); ?>
                            </h5>
                            <p class="card-text text-muted small">
                                <strong>Email:</strong> <?php echo htmlspecialchars($customer['email'] ?? 'N/A'); ?><br>
                                <strong>Phone:</strong> <?php echo htmlspecialchars($customer['phone'] ?? 'N/A'); ?><br>
                                <strong>Latest Order:</strong> <?php echo htmlspecialchars($customer['order_date'] ?? 'No Orders'); ?><br>
                                <strong>Total Orders:</strong> <?php echo htmlspecialchars($customer['total_quantity'] ?? 0); ?><br>
                                <strong>Total Amount:</strong> $<?php echo htmlspecialchars($customer['total_amount'] ?? '0.00'); ?>
                            </p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <a href="view-order-details.php?customer_id=<?php echo $customer['customer_id']; ?>" class="btn btn-outline-primary btn-sm">
                                    View Orders
                                </a>
                                <a href="edit-customer.php?customer_id=<?php echo $customer['customer_id']; ?>" class="btn btn-outline-secondary btn-sm">
                                    Edit Customer
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <div class="alert alert-warning" role="alert">
                    No customers with orders found.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="text-center mt-5">
    <a href="index.php" class="btn btn-primary btn-lg">Return to Home Page</a>
</div>
