<!-- Edit Order Modal -->
<div class="modal fade" id="editOrderModal<?php echo $order['order_id']; ?>" tabindex="-1" aria-labelledby="editOrderModalLabel<?php echo $order['order_id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOrderModalLabel<?php echo $order['order_id']; ?>">Edit Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['order_id']); ?>">
                    <input type="hidden" name="actionType" value="Edit">

                    <div class="mb-3">
                        <label for="order_date<?php echo $order['order_id']; ?>" class="form-label">Order Date</label>
                        <input type="date" class="form-control" id="order_date<?php echo $order['order_id']; ?>" name="order_date" value="<?php echo htmlspecialchars($order['order_date']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="customer_name<?php echo $order['order_id']; ?>" class="form-label">Customer Name</label>
                        <input type="text" class="form-control" id="customer_name<?php echo $order['order_id']; ?>" name="customer_name" value="<?php echo htmlspecialchars($order['firstname'] . ' ' . $order['lastname']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="total_amount<?php echo $order['order_id']; ?>" class="form-label">Total Amount</label>
                        <input type="number" step="0.01" class="form-control" id="total_amount<?php echo $order['order_id']; ?>" name="total_amount" value="<?php echo htmlspecialchars($order['total_amount']); ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
