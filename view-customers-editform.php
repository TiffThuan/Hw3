<!-- Button trigger modal -->
<button type="button" class="btn" style="background-color: #28a745; color: white;" data-bs-toggle="modal" data-bs-target="#editCustomerModal<?php echo $customer['customer_id']; ?>">
    Edit
</button>

<!-- Modal -->
<div class="modal fade" id="editCustomerModal<?php echo htmlspecialchars($row['customer_id']); ?>" tabindex="-1" aria-labelledby="editCustomerModalLabel<?php echo htmlspecialchars($row['customer_id']); ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCustomerModalLabel<?php echo htmlspecialchars($row['customer_id']); ?>">Edit Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="customers.php">
                    <div class="mb-3">
                        <label for="cFName<?php echo htmlspecialchars($row['customer_id']); ?>" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="cFName<?php echo htmlspecialchars($row['customer_id']); ?>" name="cFName" value="<?php echo htmlspecialchars($row['firstname']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="cLName<?php echo htmlspecialchars($row['customer_id']); ?>" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="cLName<?php echo htmlspecialchars($row['customer_id']); ?>" name="cLName" value="<?php echo htmlspecialchars($row['lastname']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="cEmail<?php echo htmlspecialchars($row['customer_id']); ?>" class="form-label">Email</label>
                        <input type="email" class="form-control" id="cEmail<?php echo htmlspecialchars($row['customer_id']); ?>" name="cEmail" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="cPhone<?php echo htmlspecialchars($row['customer_id']); ?>" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="cPhone<?php echo htmlspecialchars($row['customer_id']); ?>" name="cPhone" value="<?php echo htmlspecialchars($row['phone']); ?>" required>
                    </div>
                    <input type="hidden" name="cid" value="<?php echo htmlspecialchars($row['customer_id']); ?>">
                    <input type="hidden" name="actionType" value="Edit">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
