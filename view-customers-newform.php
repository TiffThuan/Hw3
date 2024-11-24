<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newCustomerModal">
    Register New Customer
</button>

<!-- Modal -->
<div class="modal fade" id="newCustomerModal" tabindex="-1" aria-labelledby="newCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCustomerModalLabel">Register New Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="post" action="customers.php">
                    <div class="col-md-6">
                        <label for="cFName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="cFName" name="cFName" required>
                    </div>
                    <div class="col-md-6">
                        <label for="cLName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="cLName" name="cLName" required>
                    </div>
                    <div class="col-12">
                        <label for="cEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="cEmail" name="cEmail" required>
                    </div>
                    <div class="col-12">
                        <label for="cPhone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="cPhone" name="cPhone" required>
                    </div>
                    <input type="hidden" name="actionType" value="Add">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Add Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
