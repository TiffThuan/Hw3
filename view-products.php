<h1>Products with Orders</h1>
<div class="card-group">
<?php
$previousProduct = null; // To keep track of the current product

while ($product = $products->fetch_assoc()) {
    // If it's a new product, we create a new card
    if ($previousProduct != $product['productid']) {
        if ($previousProduct != null) {
            // Close previous card group and list
            echo "</ul></div></div>";
        }
        ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                <p class="card-text"><?php echo htmlspecialchars($product['product_description']); ?></p>
                <p class="card-text"><strong>Price:</strong> <?php echo htmlspecialchars($product['price']); ?></p>
                <ul class="list-group">
        <?php
    }

    // Show order details if available
    if (!empty($product['order_id'])) {
        ?>
        <li class="list-group-item">
            <strong>Order ID:</strong> <?php echo htmlspecialchars($product['order_id']); ?> - 
            <strong>Quantity:</strong> <?php echo htmlspecialchars($product['quantity']); ?> - 
            <strong>Price:</strong> <?php echo htmlspecialchars($product['order_price']); ?> - 
            <strong>Status:</strong> <?php echo htmlspecialchars($product['status']); ?>
        </li>
        <?php
    } else {
        echo "<li class='list-group-item'>No orders found for this product.</li>";
    }

    $previousProduct = $product['productid'];
}

// Close the last product card
if ($previousProduct != null) {
    echo "</ul></div></div>";
}
?>
</div>
