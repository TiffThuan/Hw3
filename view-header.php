<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">King Coffee Shop</a> <!-- Home page link -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a> <!-- Home tab -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="orders.php">Orders</a> <!-- Link to Orders -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="customers.php">Customers</a> <!-- Link to Customers -->
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="products.php">Products</a> <!-- Link to Products -->
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
