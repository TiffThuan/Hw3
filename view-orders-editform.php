<!-- Edit Button -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editOrderModal<?php echo $order['order_id']; ?>">
    Edit
</button>

<!-- Edit Order Modal -->
<div class="modal fade" id="editOrderModal<?php echo $order['order_id']; ?>" tabindex="-1" aria-labelledby="editOrderModalLabel<?php echo $order['order_id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOrderModalLabel<?php echo $order['order_id']; ?>">Edit Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="your-update-handler.php"> <!-- Make sure to point to the correct PHP file -->
                    
                    <!-- Order Date -->
                    <div class="mb-3">
                        <label for="order_date<?php echo $order['order_id']; ?>" class="form-label">Order Date</label>
                        <input type="date" class="form-control" id="editOrderDate<?php echo $order['order_id']; ?>" name="order_date" value="<?php echo htmlspecialchars($order['order_date'] ?? ''); ?>" required>
                    </div>

                    <!-- Customer Dropdown -->
                    <div class="mb-3">
                        <label for="customer_id<?php echo $order['order_id']; ?>" class="form-label">Customer</label>
                        <select class="form-control" id="editCustomer<?php echo $order['order_id']; ?>" name="customer_id" required>
                            <option value="">Select Customer</option>
                            <?php
                            // Fetch customers from the database
                            $customers = getCustomers(); // Ensure this function exists in your model
                            if ($customers && $customers->num_rows > 0) {
                                while ($customer = $customers->fetch_assoc()) {
                                    $selected = ($customer['customer_id'] == $order['customer_id']) ? "selected" : "";
                                    echo "<option value='" . $customer['customer_id'] . "' $selected>" .
                                        htmlspecialchars($customer['firstname'] . ' ' . $customer['lastname']) .
                                        "</option>";
                                }
                            } else {
                                echo "<option disabled>No customers found</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Total Amount -->
                    <div class="mb-3">
                        <label for="total_amount<?php echo $order['order_id']; ?>" class="form-label">Total Amount</label>
                        <input type="number" step="0.01" class="form-control" id="editTotalAmount<?php echo $order['order_id']; ?>" name="total_amount" value="<?php echo htmlspecialchars($order['total_amount'] ?? ''); ?>" required>
                    </div>

                    <!-- Hidden Inputs for Order ID and Action Type -->
                    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['order_id']); ?>">
                    <input type="hidden" name="actionType" value="Edit">

                    <!-- Save Changes Button -->
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
