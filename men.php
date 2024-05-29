<?php
session_start();
include "navbar.php";
include "dbconnect.php";
$products = mysqli_query($conn, "SELECT * FROM products where categories = 'Men'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaapa:</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

</head>

<body>
    <!-- <h1 class="text-center;">Mens Collection</h1> -->
    <h1 style="text-align:center">Men's Collection</h1>
    <div class="container">
        <!-- // $select_data = "SELECT * FROM products order by rand() limit 0,8";
      // $result = mysqli_query($conn,$select_data); 
      // while ( $row = mysqli_fetch_assoc($result))  
        //    $product_name = $row['product_name'];
        //    $product_description = $row['product_description'];
        //    $product_price = $row['product_price'];
        //    $product_image = $row['product_image']; -->

        <?php
        while ($prod = mysqli_fetch_array($products)) { ?>
            <div class='card' style='width: 18rem;'>
                <img src='<?php echo $prod['product_image']; ?>' class='card-img-top' alt='...'>
                <div class='card-body' style='margin-bottom:25px;'>
                    <h5 class='card-title'>
                        <?php echo $prod['product_name'] ?>
                    </h5>
                    <p class='card-text'>Rs.
                        <?php echo $prod['product_price'] ?>
                    </p>
                    <?php if (isset($_SESSION['username'])) { ?>
                        <a href='buyPage.php?pid=<?php echo $prod["pid"]; ?>' class='btn btn-primary'>Buy</a>
                    <?php } else { ?>
                        <a href='login.php' class='btn btn-primary'>Buy</a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php include "footer.php" ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>