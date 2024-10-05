<h1>Customers</h1>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($customer = $customers->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($customer['customer_id']); ?></td>
                    <td><?php echo htmlspecialchars($customer['firstname']) . ' ' . htmlspecialchars($customer['lastname']); ?></td>
                    <td><?php echo htmlspecialchars($customer['email']); ?></td>
                    <td><?php echo htmlspecialchars($customer['phone']); ?></td>
                    <td><a href="customers-with-orders.php?customer_id=<?php echo $customer['customer_id']; ?>" class="btn btn-primary"> Customers With Orders</a></td>          
                </tr>
            <?php
            }
            ?>  
        </tbody>
    </table>
</div>
