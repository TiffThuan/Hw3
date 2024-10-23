<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Custom styles */
        .navbar-brand {
            font-weight: bold;
            color: #6b3e26;
        }

        .nav-link {
            color: #555;
        }

        .nav-link:hover {
            color: #6b3e26;
        }

        .navbar-light .navbar-toggler {
            border-color: rgba(0, 0, 0, 0.1);
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-item .active {
            color: #6b3e26 !important; /* Color for active tab */
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">King Coffee Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link <?php if($pageTitle == 'Home') { echo 'active'; } ?>" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($pageTitle == 'Orders') { echo 'active'; } ?>" href="orders.php">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($pageTitle == 'Customers') { echo 'active'; } ?>" href="customers.php">Customers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($pageTitle == 'Products') { echo 'active'; } ?>" href="products.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($pageTitle == 'Reviews') { echo 'active'; } ?>" href="reviews.php">Reviews</a>
                </li>
            </ul>
            <!-- Optional right-side links or buttons -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
