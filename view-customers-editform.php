<!-- Button trigger modal -->
<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editCustomerModal<?php echo htmlspecialchars($customer['customer_id']); ?>">
    Edit
</button>

<!-- Modal -->
<div class="modal fade" id="editCustomerModal<?php echo htmlspecialchars($customer['customer_id']); ?>" tabindex="-1" aria-labelledby="editCustomerModalLabel<?php echo htmlspecialchars($customer['customer_id']); ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="post" action="customers.php">
                    <!-- First Name -->
                    <div class="col-md-6">
                        <label for="cFName<?php echo htmlspecialchars($customer['customer_id']); ?>" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="cFName<?php echo htmlspecialchars($customer['customer_id']); ?>" name="cFName" value="<?php echo htmlspecialchars($customer['firstname']); ?>" required>
                    </div>
                    
                    <!-- Last Name -->
                    <div class="col-md-6">
                        <label for="cLName<?php echo htmlspecialchars($customer['customer_id']); ?>" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="cLName<?php echo htmlspecialchars($customer['customer_id']); ?>" name="cLName" value="<?php echo htmlspecialchars($customer['lastname']); ?>" required>
                    </div>
                    
                    <!-- Email -->
                    <div class="col-12">
                        <label for="cEmail<?php echo htmlspecialchars($customer['customer_id']); ?>" class="form-label">Email</label>
                        <input type="email" class="form-control" id="cEmail<?php echo htmlspecialchars($customer['customer_id']); ?>" name="cEmail" value="<?php echo htmlspecialchars($customer['email']); ?>" required>
                    </div>
                    
                    <!-- Phone -->
                    <div class="col-12">
                        <label for="cPhone<?php echo htmlspecialchars($customer['customer_id']); ?>" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="cPhone<?php echo htmlspecialchars($customer['customer_id']); ?>" name="cPhone" value="<?php echo htmlspecialchars($customer['phone']); ?>" required>
                    </div>
                    
                    <!-- Hidden Inputs -->
                    <input type="hidden" name="cid" value="<?php echo htmlspecialchars($customer['customer_id']); ?>">
                    <input type="hidden" name="actionType" value="Edit">
                    
                    <!-- Save Changes Button -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
