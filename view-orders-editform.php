<!-- Edit Order Modal -->
<div class="modal fade" id="editOrderModal<?php echo $order['order_id']; ?>" tabindex="-1" aria-labelledby="editOrderModalLabel<?php echo $order['order_id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editOrderModalLabel">Edit Order</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="customer_id" class="form-label">Customer ID</label>
                        <input type="number" class="form-control" id="customer_id" name="customer_id" value="<?php echo htmlspecialchars($order['customer_id']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="total_amount" class="form-label">Total Amount</label>
                        <input type="number" class="form-control" id="total_amount" name="total_amount" value="<?php echo htmlspecialchars($order['total_amount']); ?>" step="0.01" required>
                    </div>
                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                    <input type="hidden" name="actionType" value="Edit">
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
