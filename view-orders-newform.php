<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newOrderModal">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
        <path d="M8 0a1 1 0 0 1 1 1v1h4a1 1 0 0 1 .96 1.28l-1 4a1 1 0 0 1-.96.72H5a1 1 0 0 1 0-2h6.59l.67-2.5H5.84L5 2H1a1 1 0 0 1 0-2h4a1 1 0 0 1 1 1v1h4a1 1 0 0 1 1 1v1h-1V1H8v1H7V1H5v1H1a1 1 0 0 1 0 2h4a1 1 0 0 1 .84.45l.67 2.5H12l.4-1.5H8V0z"/>
        <path fill-rule="evenodd" d="M12 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM6 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
    </svg>
</button>

<!-- Modal -->
<div class="modal fade" id="newOrderModal" tabindex="-1" aria-labelledby="newOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="newOrderModalLabel">New Order</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="post" action="">
                    <div class="col-md-6">
                        <label for="customerId" class="form-label">Customer</label>
                        <select class="form-select" id="customerId" name="customerId" required>
                            <option value="">Select Customer</option>
                            <?php
                            // Assume $customers is an array of customer options passed to this view
                            foreach ($customers as $customer) {
                                echo "<option value='" . htmlspecialchars($customer['customer_id']) . "'>" . htmlspecialchars($customer['firstname'] . ' ' . $customer['lastname']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="orderDate" class="form-label">Order Date</label>
                        <input type="date" class="form-control" id="orderDate" name="orderDate" required>
                    </div>
                    <div class="col-12">
                        <label for="totalAmount" class="form-label">Total Amount</label>
                        <input type="number" class="form-control" id="totalAmount" name="totalAmount" step="0.01" required>
                    </div>
                    <input type="hidden" name="actionType" value="AddOrder">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
