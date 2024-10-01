<h1>Customers with Orders and Products</h1>
<div class="card-group">
<?php
if ($customers->num_rows == 0) {
    echo "No customers found.";
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
                            echo "<li class='list-group-item'>No orders found for this customer.</li>";
                        } else {
                            while ($order = $orders->fetch_assoc()) {
                                ?>
                                <li class="list-group-item">
                                    <strong>Order ID:</strong> <?php echo $order['order_id']; ?> - 
                                    <strong>Status:</strong> <?php echo $order['status']; ?> - 
                                    <strong>Total:</strong> <?php echo $order['total_amount']; ?>

                                    <ul class="list-group mt-2">
                                    <?php
                                    // Fetch products for each order
                                    $products = selectProductsByOrder($order['order_id']); // Create this model function
                                    if ($products->num_rows == 0) {
                                        echo "<li class='list-group-item'>No products found for this order.</li>";
                                    } else {
                                        while ($product = $products->fetch_assoc()) {
                                            ?>
                                            <li class="list-group-item">
                                                <strong>Product:</strong> <?php echo $product['name']; ?> - 
                                                <strong>Description:</strong> <?php echo $product['description']; ?> - 
                                                <strong>Price:</strong> <?php echo $product['price']; ?>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                    </ul>
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
