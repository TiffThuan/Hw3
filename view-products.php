<?php
require_once('model-products.php');

// Fetch current and new products
$currentProducts = fetchProducts();
$newArrivals = fetchNewArrivals(); // Add a new function for fetching recently added products
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - King Coffee Shop</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1, h2, h3 {
            font-weight: bold;
            color: #6b3e26;
        }

        .section-header {
            background-color: #fdf8ec;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
        }

        .promotion-card {
            background: linear-gradient(135deg, #f9e0ac, #fef7e0);
            padding: 20px;
            border-radius: 10px;
        }

        .product-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-5 text-uppercase" style="letter-spacing: 2px;">Our Products</h1>

        <!-- Current Products Section -->
        <section class="mb-5">
            <h2 class="text-center mb-4">Current Products</h2>
            <div class="row g-4">
                <?php while ($product = $currentProducts->fetch_assoc()) { ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card product-card h-100 shadow-sm border-0">
                            <img src="images/products/<?php echo htmlspecialchars($product['productid']); ?>.jpg" 
                                 alt="<?php echo htmlspecialchars($product['product_name']); ?>" 
                                 class="card-img-top rounded-top" 
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                                <p class="card-text text-muted"><?php echo htmlspecialchars($product['product_description']); ?></p>
                                <p class="card-text text-success fw-bold">Price: $<?php echo htmlspecialchars($product['price']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>

        <!-- New Arrivals Section -->
        <section class="mb-5">
            <h2 class="text-center mb-4">New Arrivals</h2>
            <div class="row g-4">
                <?php while ($product = $newArrivals->fetch_assoc()) { ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card product-card h-100 shadow-sm border-0">
                            <img src="images/products/<?php echo htmlspecialchars($product['productid']); ?>.jpg" 
                                 alt="<?php echo htmlspecialchars($product['product_name']); ?>" 
                                 class="card-img-top rounded-top" 
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                                <p class="card-text text-muted"><?php echo htmlspecialchars($product['product_description']); ?></p>
                                <p class="card-text text-success fw-bold">Price: $<?php echo htmlspecialchars($product['price']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>

        <!-- Mockups/Upcoming Ideas Section -->
        <section class="mb-5">
            <h2 class="text-center mb-4">Upcoming Ideas</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <img src="images/mockup1.jpg" alt="Mockup Product 1" class="img-fluid rounded">
                        <div class="card-body">
                            <h5 class="card-title">Exciting New Beverage</h5>
                            <p class="card-text">A sneak peek at our upcoming summer special drink!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <img src="images/mockup2.jpg" alt="Mockup Product 2" class="img-fluid rounded">
                        <div class="card-body">
                            <h5 class="card-title">Limited Edition Pastry</h5>
                            <p class="card-text">Get ready to savor our limited-edition pastry, coming soon!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Promotions and Incentives Section -->
        <section class="mb-5">
            <h2 class="text-center mb-4">Promotions & Incentives</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="promotion-card shadow-sm">
                        <h5 class="fw-bold">Get 20% Off Your First Order!</h5>
                        <p>Sign up now to receive an exclusive discount on your first purchase.</p>
                        <form method="POST" action="register-discount.php">
                            <input type="email" name="email" class="form-control mb-3" placeholder="Enter your email" required>
                            <button type="submit" class="btn btn-primary w-100">Register Now</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="promotion-card shadow-sm">
                        <h5 class="fw-bold">Loyalty Program</h5>
                        <p>Earn points with every purchase and redeem them for discounts!</p>
                        <a href="loyalty-program.php" class="btn btn-success w-100">Learn More</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
