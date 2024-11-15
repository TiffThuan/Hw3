<!-- Button trigger modal -->
<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editCustomerModal<?php echo $customer['customer_id']; ?>">
    Edit
</button>

<!-- Modal -->
<div class="modal fade" id="editCustomerModal<?php echo $customer['customer_id']; ?>" tabindex="-1" aria-labelledby="editCustomerModalLabel<?php echo $customer['customer_id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="post" action="customers.php">
                    <div class="col-md-6">
                        <label for="cFName<?php echo $customer['customer_id']; ?>" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="cFName<?php echo $customer['customer_id']; ?>" name="cFName" value="<?php echo htmlspecialchars($customer['firstname']); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="cLName<?php echo $customer['customer_id']; ?>" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="cLName<?php echo $customer['customer_id']; ?>" name="cLName" value="<?php echo htmlspecialchars($customer['lastname']); ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="cEmail<?php echo $customer['customer_id']; ?>" class="form-label">Email</label>
                        <input type="email" class="form-control" id="cEmail<?php echo $customer['customer_id']; ?>" name="cEmail" value="<?php echo htmlspecialchars($customer['email']); ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="cPhone<?php echo $customer['customer_id']; ?>" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="cPhone<?php echo $customer['customer_id']; ?>" name="cPhone" value="<?php echo htmlspecialchars($customer['phone']); ?>" required>
                    </div>
                    <input type="hidden" name="cid" value="<?php echo $customer['customer_id']; ?>">
                    <input type="hidden" name="actionType" value="Edit">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
