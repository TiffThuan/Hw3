<h1>Customers with Orders</h1>
<div class="card-group">
<?php
if ($customers->num_rows == 0) {
    echo "No customers found.";
} else {
    while ($customer = $customers->fetch_assoc()) {
        ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $customer['firstname'] . ' ' . $customer['lastname']; ?></h5>
                <p class="card-text">
                    <ul class="list-group">
                        <?php
                        // Fetch the orders for each customer using selectCustomersWithOrders()
                        $orders = selectCustomersWithOrders($customer['customer_id']);
                        if ($orders->num_rows == 0) {
                            echo "<li class='list-group-item'>No orders found for this customer.</li>";
                        } else {
                            while ($order = $orders->fetch_assoc()) {
                                ?>
                                <li class="list-group-item">
                                    <strong>Order ID:</strong> <?php echo $order['order_id']; ?> - 
                                    <strong>Status:</strong> <?php echo $order['status']; ?> - 
                                    <strong>Total Amount:</strong> <?php echo $order['total_amount']; ?> - 
                                    <strong>Order Date:</strong> <?php echo $order['order_date']; ?>
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
