<h1 class="text-center mb-4">Products with Orders</h1>
<div class="container">
    <div class="row">
        <?php while ($product = $products->fetch_assoc()) { ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                        <p class="card-text">
                            <?php echo htmlspecialchars($product['product_description']); ?>
                        </p>
                        <p class="card-text">
                            <strong>Price:</strong> $<?php echo htmlspecialchars($product['price']); ?>
                        </p>
                        <?php if (!empty($product['order_id'])) { ?>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>Order ID:</strong> <?php echo htmlspecialchars($product['order_id']); ?>,
                                    <strong>Quantity:</strong> <?php echo htmlspecialchars($product['quantity']); ?>,
                                    <strong>Total:</strong> $<?php echo htmlspecialchars($product['order_price']); ?>
                                </li>
                            </ul>
                        <?php } else { ?>
                            <p>No orders found for this product.</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
