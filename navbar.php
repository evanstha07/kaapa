<?php
// Check if a session is not already active before starting one
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kaapa</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/437518571d.js" crossorigin="anonymous"></script>
</head>

<body>

  <nav class="navbar navbar-expand-lg " style="background-color: #e4f0d0;">

    <div class="logo">
      <a href="index.php"><img src="img/logo-t.png"></a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="ourProducts.php">Our Products</Button></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="about.php">About Us</Button></a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Categories
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="men.php">Men</a></li>
          <li><a class="dropdown-item" href="women.php">Women</a></li>
        </ul>
      </li>

      <li>
        <div class="search" style="position: absolute;left: 679px; top: 17px;">
          <form class="d-flex" role="search" action="search.php" method="POST">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </li>
    </ul>

    <?php if (isset($_SESSION['username'])) { ?>
      <a class="nav-link px-4" href="logout.php">
        <i class="bi bi-person"></i> <?php echo $_SESSION['username']; ?>
      </a>
    <?php } else { ?>
      <a href="login.php" class="nav-link px-4">Login</a>
    <?php } ?>

    <?php if (isset($_SESSION['username'])) { ?>
      <a href="mycart.php" class="text-decoration-none text-black"><i class="fa-solid fa-cart-shopping px-5"></i></a>
    <?php } ?>

  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>