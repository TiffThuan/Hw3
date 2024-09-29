<h1>Customers with Orders</h1>
<div class="card-group">
<?php
// Ensure $customers contains valid data
if ($customers->num_rows == 0) {
    echo "No customers found."; // Debugging step: Check if customers data is present
} else {
    while ($customer = $customers->fetch_assoc()) {
        ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $customer['firstname']; ?></h5>
                <p class="card-text">
                    <ul class="list-group">
                        <?php
                        // Fetch the orders for each customer
                        $orders = selectOrdersByCustomer($customer['customer_id']);
                        if ($orders->num_rows == 0) {
                            echo "<li class='list-group-item'>No orders found for this customer.</li>"; // Debugging step
                        } else {
                            while ($order = $orders->fetch_assoc()) {
                                ?>
                                <li class="list-group-item">
                                    <?php echo $order['order_id']; ?> - <?php echo $order['status']; ?> - <?php echo $order['quantity']; ?> - <?php echo $order['price']; ?>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </p>
                <p class="card-text">
                    <small class="text-body-secondary">Address: <?php echo $customer['address']; ?></small>
                </p>
            </div>
        </div>
        <?php
    }
}
?>
</div>
