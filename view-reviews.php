<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Us & Reviews - King Coffee Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        .section-header {
            font-size: 1.5rem;
            color: #6b3e26;
            margin-bottom: 1rem;
        }
        .accordion-button::after {
            transform: rotate(-90deg);
        }
        .accordion-button.collapsed::after {
            transform: rotate(0deg);
        }
        .reviews-dropdown {
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Find Us</h1>

        <!-- Location Section -->
        <div class="mb-4">
            <h2 class="section-header">Our Location</h2>
            <div class="card">
                <div class="card-body">
                    <p class="mb-0"><strong>Address:</strong> 123 Coffee Lane, OKC, OK, USA</p>
                    <p><strong>Phone:</strong> +1 555-COFFEE</p>
                    <div class="map mt-3">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509639!2d144.95592601568152!3d-37.81720974252773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf4c5f52bfbf8f273!2s123%20Coffee%20Lane!5e0!3m2!1sen!2sus!4v1681234567890!5m2!1sen!2sus"
                            width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- Opening Hours Section -->
        <div class="mb-4">
            <h2 class="section-header">Opening Hours</h2>
            <div class="card">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><strong>Monday - Friday:</strong> 7:00 AM - 9:00 PM</li>
                        <li><strong>Saturday:</strong> 8:00 AM - 10:00 PM</li>
                        <li><strong>Sunday:</strong> 9:00 AM - 8:00 PM</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Mission, Vision, and Values -->
        <div class="mb-4">
            <h2 class="section-header">Mission, Vision & Values</h2>
            <div class="accordion" id="missionVisionAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="missionHeading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMission" aria-expanded="true" aria-controls="collapseMission">
                            Our Mission
                        </button>
                    </h2>
                    <div id="collapseMission" class="accordion-collapse collapse show" aria-labelledby="missionHeading" data-bs-parent="#missionVisionAccordion">
                        <div class="accordion-body">
                            To serve the finest coffee experiences while fostering a sense of community and sustainability.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="visionHeading">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVision" aria-expanded="false" aria-controls="collapseVision">
                            Our Vision
                        </button>
                    </h2>
                    <div id="collapseVision" class="accordion-collapse collapse" aria-labelledby="visionHeading" data-bs-parent="#missionVisionAccordion">
                        <div class="accordion-body">
                            To be a global leader in the coffee industry known for innovation, quality, and community.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="valuesHeading">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseValues" aria-expanded="false" aria-controls="collapseValues">
                            Our Values
                        </button>
                    </h2>
                    <div id="collapseValues" class="accordion-collapse collapse" aria-labelledby="valuesHeading" data-bs-parent="#missionVisionAccordion">
                        <div class="accordion-body">
                            Excellence, sustainability, inclusivity, and community engagement are at the heart of what we do.
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- Reviews Section -->

<div class="reviews-section">
    <h3 class="text-center mb-4">Top Reviews</h3>
    <div class="row">
        <?php foreach (array_slice($topReviews, 0, 2) as $review): ?>
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($review['customer_name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($review['content']); ?></p>
                        <p class="card-text text-muted">
                            <em>Rating: <?php echo htmlspecialchars($review['rating']); ?>/5</em>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>



<!-- Reviews Accordion -->
<!-- Add Review Modal Trigger -->
<?php include 'view-reviews-newform.php'; ?>

<div class="accordion mt-4" id="reviewsAccordion">
    <?php while ($review = $reviews->fetch_assoc()): ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading<?php echo $review['review_id']; ?>">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $review['review_id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $review['review_id']; ?>">
                    Review #<?php echo htmlspecialchars($review['review_id']); ?>: <?php echo htmlspecialchars($review['rating']); ?>/5
                </button>
            </h2>
            <div id="collapse<?php echo $review['review_id']; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $review['review_id']; ?>" data-bs-parent="#reviewsAccordion">
                <div class="accordion-body">
                    <p><?php echo htmlspecialchars($review['review_text']); ?></p>
                    <div class="mt-3">
                        <!-- Edit Button -->
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editReviewModal<?php echo $review['review_id']; ?>">Edit</button>
                        <?php include "view-reviews-editform.php"; ?>

                        <!-- Delete Button -->
                        <form method="POST" action="reviews.php" class="d-inline">
                            <input type="hidden" name="actionType" value="deleteReview">
                            <input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this review?');">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
