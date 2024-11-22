<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - King Coffee Shop</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1, h2 {
            font-weight: bold;
            color: #6b3e26;
        }

        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .btn {
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        .btn:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <!-- Page Header -->
        <h1 class="text-center mb-5 text-uppercase" style="letter-spacing: 2px;">Manage Products</h1>

        <!-- Add Product Button -->
        <div class="text-center mb-5">
            <button class="btn btn-success btn-lg shadow-sm" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="fas fa-plus me-2"></i>Add Product
            </button>
        </div>

        <!-- Add Product Modal -->
        <?php include 'view-products-newform.php'; ?>

        <!-- Shop Visuals Section -->
        <section class="mb-5">
            <h2 class="text-center mb-4">Our Coffee Shop & Products</h2>
            <div class="row g-3">
                <div class="col-md-4">
                    <img src="images/shop1.jpg" alt="Coffee Shop" class="img-fluid rounded shadow-sm" style="height: 300px; object-fit: cover;">
                </div>
                <div class="col-md-4">
                    <img src="images/shop2.jpg" alt="Coffee Products" class="img-fluid rounded shadow-sm" style="height: 300px; object-fit: cover;">
                </div>
                <div class="col-md-4">
                    <img src="images/shop3.jpg" alt="Catering Services" class="img-fluid rounded shadow-sm" style="height: 300px; object-fit: cover;">
                </div>
            </div>
        </section>

        <!-- Products Section -->
        <section>
            <h2 class="text-center mb-4">Available Products</h2>
            <div class="row g-4">
                <?php 
                $productIds = []; // To track displayed products and avoid duplicates
                while ($product = $products->fetch_assoc()) { 
                    if (in_array($product['productid'], $productIds)) {
                        continue; // Skip duplicate product
                    }
                    $productIds[] = $product['productid']; // Track displayed product IDs
                ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-0" style="border-radius: 10px;">
                            <!-- Product Image -->
                            <img src="images/products/<?php echo htmlspecialchars($product['productid']); ?>.jpg" 
                                 alt="<?php echo htmlspecialchars($product['product_name']); ?>" 
                                 class="card-img-top rounded-top" 
                                 style="height: 200px; object-fit: cover;">

                            <!-- Product Details -->
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                                <p class="card-text text-muted"><?php echo htmlspecialchars($product['product_description']); ?></p>
                                <p class="card-text text-success fw-bold">Price: $<?php echo htmlspecialchars($product['price']); ?></p>
                            </div>

                            <!-- Actions -->
                            <div class="card-footer text-center bg-light">
                                <button class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#orderProductModal<?php echo $product['productid']; ?>">
                                    <i class="fas fa-shopping-cart me-1"></i>Order Now
                                </button>
                                <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editProductModal<?php echo $product['productid']; ?>">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </button>
                                <form method="POST" action="products.php" class="d-inline">
                                    <input type="hidden" name="actionType" value="deleteProduct">
                                    <input type="hidden" name="productid" value="<?php echo $product['productid']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">
                                        <i class="fas fa-trash-alt me-1"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Order Modal for Individual Product -->
                    <div class="modal fade" id="orderProductModal<?php echo $product['productid']; ?>" tabindex="-1" aria-labelledby="orderProductModalLabel<?php echo $product['productid']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="orderProductModalLabel<?php echo $product['productid']; ?>">Order <?php echo htmlspecialchars($product['product_name']); ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="orders.php">
                                        <input type="hidden" name="productid" value="<?php echo $product['productid']; ?>">
                                        <div class="mb-3">
                                            <label for="quantity" class="form-label">Quantity</label>
                                            <input type="number" name="quantity" class="form-control" min="1" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="specialRequest" class="form-label">Special Request</label>
                                            <textarea name="special_request" class="form-control"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Place Order</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Product Modal -->
                    <?php include 'view-products-editform.php'; ?>
                <?php } ?>
            </div>
        </section>

        <!-- Catering Order Form -->
        <section class="mt-5">
            <h2 class="text-center mb-4">Catering Services</h2>
            <div class="card shadow-sm border-0" style="border-radius: 10px;">
                <div class="card-body">
                    <form method="POST" action="catering-orders.php">
                        <div class="mb-3">
                            <label for="eventName" class="form-label">Event Name</label>
                            <input type="text" name="event_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventDate" class="form-label">Event Date</label>
                            <input type="date" name="event_date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="guestCount" class="form-label">Number of Guests</label>
                            <input type="number" name="guest_count" class="form-control" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="specialRequests" class="form-label">Special Requests</label>
                            <textarea name="special_requests" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit Catering Request</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
