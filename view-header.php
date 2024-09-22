<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <style>
      .navbar-nav .nav-link {
        color: blue;
      }
      .navbar-nav .nav-link.active {
        background-color: #003366;
        color: white;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">HW2 - King Coffee Shop</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link <?= $pageTitle == 'Welcome to Our King Coffee Shop' ? 'active' : '' ?>" href="/">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= $pageTitle == 'Contact Us' ? 'active' : '' ?>" href="post.php">Contact Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= $pageTitle == 'Contact Result' ? 'active' : '' ?>" href="post-result.php">Contact Result</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= $pageTitle == 'Order Coffee' ? 'active' : '' ?>" href="get.php">Order Coffee</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= $pageTitle == 'Order Result' ? 'active' : '' ?>" href="get-result.php">Order Result</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
