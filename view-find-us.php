<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Us - King Coffee Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Welcome to King Coffee Shop</h1>

    <!-- Location and Hours -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Our Location</h2>
            <p>123 Coffee Lane, Brewtown, USA</p>
            <p><strong>Opening Hours:</strong></p>
            <ul>
                <li>Monday - Friday: 7:00 AM - 8:00 PM</li>
                <li>Saturday: 8:00 AM - 10:00 PM</li>
                <li>Sunday: 9:00 AM - 6:00 PM</li>
            </ul>
        </div>
        <div class="col-md-6">
            <h2>Mission, Vision, and Values</h2>
            <p><strong>Mission:</strong> To brew happiness, one cup at a time.</p>
            <p><strong>Vision:</strong> To become the most beloved coffee shop in the community.</p>
            <p><strong>Values:</strong> Quality, Community, Sustainability.</p>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="row">
        <div class="col">
            <h2>Customer Reviews</h2>
        </div>
        <div class="col-auto">
            <!-- Add Review Button -->
            <?php include 'view-reviews-newform.php'; ?>
        </div>
    </div>
    <div class="row">
        <?php if ($reviews && $reviews->num_rows > 0): ?>
            <?php while ($review = $reviews->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Rating: <?php echo htmlspecialchars($review['rating']); ?>/5</h5>
                            <p class="card-text"><?php echo htmlspecialchars($review['review_text']); ?></p>
                            <small class="text-muted">Product ID: <?php echo htmlspecialchars($review['product_id']); ?></small>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No reviews yet. Be the first to leave one!</p>
        <?php endif; ?>
    </div>

    <!-- Job Site Section -->
    <div class="row mt-5">
        <div class="col-md-12">
            <h2>Careers at King Coffee Shop</h2>
            <p>Interested in joining our team? <a href="job-site.php" class="btn btn-secondary">View Job Openings</a></p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
