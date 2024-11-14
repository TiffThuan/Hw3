<!-- Button to trigger the New Order Modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newOrderModal">
    Add New Order
</button>

<!-- New Order Modal -->
<!-- Modal -->
<div class="modal fade" id="newOrderModal" tabindex="-1" aria-labelledby="newOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newOrderModalLabel">Add New Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <!-- Display Customer Full Name -->
                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Customer Full Name</label>
                        <select class="form-select" id="customer_name" name="customer_id" required>
                            <?php foreach ($customers as $customer): ?>
                                <option value="<?php echo $customer['customer_id']; ?>">
                                    <?php echo htmlspecialchars($customer['firstname'] . ' ' . $customer['lastname']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <!-- Order Date -->
                    <div class="mb-3">
                        <label for="order_date" class="form-label">Order Date</label>
                        <input type="date" class="form-control" id="order_date" name="order_date" required>
                    </div>

                    <!-- Other Fields -->
                    <div class="mb-3">
                        <label for="total_amount" class="form-label">Total Amount</label>
                        <input type="number" step="0.01" class="form-control" id="total_amount" name="total_amount" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select class="form-select" id="payment_method" name="payment_method" required>
                            <option value="Credit Card">Credit Card</option>
                            <option value="Cash">Cash</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>
                    
                    <!-- Submit -->
                    <input type="hidden" name="actionType" value="Add">
                    <button type="submit" class="btn btn-success">Add Order</button>
                </form>
            </div>
        </div>
    </div>
</div>
