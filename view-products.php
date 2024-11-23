<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - King Coffee Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
        }
        
        h1, h2, h3 {
            font-weight: bold;
            color: #6b3e26;
        }
        
        /* Section Header */
        .section-header {
            background-color: #fdf8ec;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        
        /* Card Styles */
        .card, .promotion-card, .loyalty-card {
            border-radius: 10px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }
        
        .promotion-card {
            background: linear-gradient(135deg, #f9e0ac, #fef7e0);
            padding: 20px;
        }
        
        .loyalty-card {
            background-color: #fef7e0;
            border: 1px solid #f9e0ac;
            padding: 20px;
            text-align: center;
        }
        
        /* Table Styles */
        .table-hover tbody tr:hover {
            background-color: #fdf8ec;
        }
        
        .table-light th {
            color: #6b3e26;
            font-weight: bold;
            text-align: center;
        }
        
        /* Button Styles */
        .btn {
            transition: transform 0.2s ease;
        }
        
        .btn:hover {
            transform: scale(1.05);
        }
        
        /* Image Styles */
        td img, .card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

</style>

</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-5">Our Products</h1>
        <p class="text-center lead" style="font-style: italic;">
            Welcome to our Products page, where we proudly showcase our curated selection of premium coffee beverages and delightful treats. Each offering is crafted with the finest ingredients to provide an exceptional experience for every palate. Explore our diverse menu and discover your next favorite indulgence.
        </p>
    </div>

<!-- New Arrivals (Planned Products) Section -->
    <section class="mb-5">
        <h2 class="mb-4 text-center">New Beverage Rehearsal </h2>
        <div class="row g-4">
            <!-- First Planned Product -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0">
                    <div style="height: 300px; overflow: hidden; border-radius: 10px;">
                        <img src="https://images.pexels.com/photos/302901/pexels-photo-302901.jpeg"
                             alt="Summer Delight Iced Coffee"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
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
                    <div style="height: 300px; overflow: hidden; border-radius: 10px;">
                        <img src="https://images.pexels.com/photos/28893064/pexels-photo-28893064.jpeg"
                             alt="Gourmet Matcha Latte"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">Gourmet Matcha Latte</h5>
                        <p class="card-text">A premium matcha latte with organic Japanese matcha and creamy oat milk.</p>
                        <p class="badge bg-warning text-dark">Coming Soon</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



        <!-- Current Products Section -->
            <section class="mb-5">
                <h2 class="mb-4 text-center">Current Products</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 10%;">Image</th>
                                <th style="width: 40%;">Product Name</th>
                                <th style="width: 30%;">Description</th>
                                <th style="width: 10%;">Price</th>
                                <th style="width: 10%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($product = $currentProducts->fetch_assoc()): ?>
                                <tr>
                                    <!-- Product Image -->
                                    <td>
                                        <div style="width: 80px; height: 80px; overflow: hidden; border-radius: 10px; border: 1px solid #ddd;">
                                            <img src="https://images.pexels.com/photos/302901/pexels-photo-302901.jpeg"
                                                 alt="Cappuccino"
                                                 onerror="this.onerror=null; this.src='images/placeholder.jpg';"
                                                 style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    </td>
            
                                    <!-- Product Name -->
                                    <td>
                                        <h6 class="fw-bold"><?php echo htmlspecialchars($product['product_name']); ?></h6>
                                    </td>
            
                                    <!-- Product Description -->
                                    <td>
                                        <p class="text-muted"><?php echo htmlspecialchars($product['product_description']); ?></p>
                                    </td>
            
                                    <!-- Product Price -->
                                    <td>
                                        <span class="text-success fw-bold">$<?php echo htmlspecialchars($product['price']); ?></span>
                                    </td>
            
                                    <!-- Actions -->
                                    <td>
                                        <a href="products-with-reviews.php?productid=<?php echo htmlspecialchars($product['productid']); ?>" class="btn btn-primary btn-sm mb-2 w-100">Learn More</a>
                                        <a href="view-products-editform.php?productid=<?php echo htmlspecialchars($product['productid']); ?>" class="btn btn-warning btn-sm mb-2 w-100">Edit</a>
                                    </td>
                                    
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
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




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
