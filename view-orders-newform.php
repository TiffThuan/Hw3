<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newOrderModal">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
        <path d="M8 0a1 1 0 0 1 1 1v1h4a1 1 0 0 1 .96 1.28l-1 4a1 1 0 0 1-.96.72H5a1 1 0 0 1 0-2h6.59l.67-2.5H5.84L5 2H1a1 1 0 0 1 0-2h4a1 1 0 0 1 1 1v1h4a1 1 0 0 1 1 1v1h-1V1H8v1H7V1H5v1H1a1 1 0 0 1 0 2h4a1 1 0 0 1 .84.45l.67 2.5H12l.4-1.5H8V0z"/>
        <path fill-rule="evenodd" d="M12 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM6 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
    </svg>
</button>

<!-- New Order Modal -->
<div class="modal fade" id="newOrderModal" tabindex="-1" aria-labelledby="newOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newOrderModalLabel">Add New Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="order_date" class="form-label">Order Date</label>
                        <input type="date" class="form-control" id="order_date" name="order_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="cFName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="cFName" name="cFName" required>
                    </div>
                    <div class="mb-3">
                        <label for="cLName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="cLName" name="cLName" required>
                    </div>
                    <div class="mb-3">
                        <label for="total_amount" class="form-label">Total Amount</label>
                        <input type="number" step="0.01" class="form-control" id="total_amount" name="total_amount" required>
                    </div>
                    <input type="hidden" name="actionType" value="Add">
                    <button type="submit" class="btn btn-primary">Add Order</button>
                </form>
            </div>
        </div>
    </div>
</div>

