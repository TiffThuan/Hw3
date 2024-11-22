<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - King Coffee Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

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
            margin-bottom: 30px;
        }

        .promotion-card {
            background: linear-gradient(135deg, #f9e0ac, #fef7e0);
            padding: 20px;
            border-radius: 10px;
        }

        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .loyalty-card {
            background-color: #fef7e0;
            border: 1px solid #f9e0ac;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-5">Our Products</h1>

        <!-- Current Products Section -->
        <section class="mb-5">
            <h2 class="mb-4 text-center">Current Products</h2>
            <div class="row g-4">
                <?php while ($product = $currentProducts->fetch_assoc()): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm">
                            <img src="images/products/<?php echo htmlspecialchars($product['productid']); ?>.jpg" class="card-img-top" alt="<?php echo htmlspecialchars($product['product_name']); ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($product['product_description']); ?></p>
                                <p class="card-text text-success fw-bold">$<?php echo htmlspecialchars($product['price']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>

        <!-- Promotions Section -->
        <section class="mb-5">
            <h2 class="mb-4 text-center">Special Promotions</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="promotion-card shadow-sm">
                        <h5 class="fw-bold">Get 20% Off Your First Order!</h5>
                        <p>Sign up now and enjoy an exclusive discount on your first purchase with us.</p>
                        <form method="POST" action="register-discount.php">
                            <input type="email" name="email" class="form-control mb-3" placeholder="Enter your email" required>
                            <button type="submit" class="btn btn-primary w-100">Register Now</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="promotion-card shadow-sm">
                        <h5 class="fw-bold">Limited-Time Offer</h5>
                        <p>Buy 2 pastries and get 1 coffee free. Don't miss out on this deal!</p>
                        <a href="promotion-details.php" class="btn btn-success w-100">Learn More</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Customer Loyalty Section -->
        <section class="mb-5">
            <h2 class="mb-4 text-center">Customer Loyalty Program</h2>
            <div class="loyalty-card shadow-sm">
                <h5 class="fw-bold">Join Our Loyalty Program</h5>
                <p>Earn points for every dollar you spend and redeem them for exclusive rewards. It's our way of saying thank you!</p>
                <a href="loyalty-program.php" class="btn btn-warning">Join Now</a>
            </div>
        </section>


 <!-- New Arrivals (Planned Products) Section -->
    <section class="mb-5">
        <h2 class="mb-4 text-center">Planned Products for Future Sale</h2>
        <div class="row g-4">
            <!-- First Planned Product -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0">
                    <img src="images/mockup1.jpg" alt="Planned Product 1" class="card-img-top" style="height: 300px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Summer Delight Iced Coffee</h5>
                        <p class="card-text">A refreshing blend of iced coffee with hints of vanilla and caramel. Perfect for the summer heat!</p>
                        <p class="badge bg-warning text-dark">Coming Soon</p>
                    </div>
                </div>
            </div>
    
            <!-- Second Planned Product -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0">
                    <img src="images/mockup2.jpg" alt="Planned Product 2" class="card-img-top" style="height: 300px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Gourmet Matcha Latte</h5>
                        <p class="card-text">A premium matcha latte with organic Japanese matcha and creamy oat milk.</p>
                        <p class="badge bg-warning text-dark">Coming Soon</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
