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

    <!-- Button to Add New Customer -->
    <div class="text-end mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newCustomerModal">
            Add New Customer
        </button>
    </div>

    <!-- Accordion for Customers -->
    <div class="accordion" id="customerAccordion">
        <?php if ($customersWithOrders && $customersWithOrders->num_rows > 0): ?>
            <?php while ($row = $customersWithOrders->fetch_assoc()): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?php echo htmlspecialchars($row['customer_id']); ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo htmlspecialchars($row['customer_id']); ?>" aria-expanded="false" aria-controls="collapse<?php echo htmlspecialchars($row['customer_id']); ?>">
                            <?php echo htmlspecialchars($row['firstname'] . ' ' . $row['lastname']); ?>
                        </button>
                    </h2>
                    <div id="collapse<?php echo htmlspecialchars($row['customer_id']); ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo htmlspecialchars($row['customer_id']); ?>" data-bs-parent="#customerAccordion">
                        <div class="accordion-body">
                            <strong>Email:</strong> <?php echo htmlspecialchars($row['email'] ?? 'Not Provided'); ?><br>
                            <strong>Phone:</strong> <?php echo htmlspecialchars($row['phone'] ?? 'Not Provided'); ?><br>
                            <strong>Latest Order Date:</strong> <?php echo htmlspecialchars($row['order_date'] ?? 'No Orders'); ?><br>
                            <strong>Product(s):</strong> <?php echo htmlspecialchars($row['product_names'] ?? 'N/A'); ?><br>
                            <strong>Total Quantity:</strong> <?php echo htmlspecialchars($row['total_quantity'] ?? 0); ?><br>
                            <strong>Total Amount:</strong> $<?php echo htmlspecialchars($row['total_amount'] ?? '0.00'); ?><br>
                            
                            <!-- Action Buttons -->
                            <div class="mt-3">
                                <a href="view-order-details.php?customer_id=<?php echo htmlspecialchars($row['customer_id']); ?>" class="btn btn-primary btn-sm">View Full Order Details</a>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editCustomerModal<?php echo $row['customer_id']; ?>">Edit</button>
                                <form method="post" action="customers.php" class="d-inline">
                                    <input type="hidden" name="cid" value="<?php echo $row['customer_id']; ?>">
                                    <input type="hidden" name="actionType" value="Delete">
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this customer?');">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Customer Modal -->
                <div class="modal fade" id="editCustomerModal<?php echo $row['customer_id']; ?>" tabindex="-1" aria-labelledby="editCustomerModalLabel<?php echo $row['customer_id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editCustomerModalLabel<?php echo $row['customer_id']; ?>">Edit Customer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="customers.php">
                                    <div class="mb-3">
                                        <label for="cFName<?php echo $row['customer_id']; ?>" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="cFName<?php echo $row['customer_id']; ?>" name="cFName" value="<?php echo htmlspecialchars($row['firstname']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cLName<?php echo $row['customer_id']; ?>" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="cLName<?php echo $row['customer_id']; ?>" name="cLName" value="<?php echo htmlspecialchars($row['lastname']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cEmail<?php echo $row['customer_id']; ?>" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="cEmail<?php echo $row['customer_id']; ?>" name="cEmail" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cPhone<?php echo $row['customer_id']; ?>" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="cPhone<?php echo $row['customer_id']; ?>" name="cPhone" value="<?php echo htmlspecialchars($row['phone']); ?>" required>
                                    </div>
                                    <input type="hidden" name="cid" value="<?php echo $row['customer_id']; ?>">
                                    <input type="hidden" name="actionType" value="Edit">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
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

    <!-- Chart for New Customers -->
    <div class="container mt-5">
        <h3 class="text-center">New Customers Over Time</h3>
        <div id="customer-chart" style="height: 400px;"></div>
    </div>
</div>

<!-- Add Customer Modal -->
<div class="modal fade" id="newCustomerModal" tabindex="-1" aria-labelledby="newCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCustomerModalLabel">Add New Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="customers.php">
                    <div class="mb-3">
                        <label for="cFName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="cFName" name="cFName" required>
                    </div>
                    <div class="mb-3">
                        <label for="cLName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="cLName" name="cLName" required>
                    </div>
                    <div class="mb-3">
                        <label for="cEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="cEmail" name="cEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="cPhone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="cPhone" name="cPhone" required>
                    </div>
                    <input type="hidden" name="actionType" value="Add">
                    <button type="submit" class="btn btn-success">Add Customer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
<script>
    const customerChart = echarts.init(document.getElementById('customer-chart'));
    const options = {
        title: { text: 'Customer Growth Over Time', left: 'center' },
        tooltip: { trigger: 'axis' },
        xAxis: { type: 'category', data: <?php echo json_encode($months); ?> },
        yAxis: { type: 'value', name: 'New Customers' },
        series: [{ name:
