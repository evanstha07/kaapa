<?php
include "navbar.php";
include "dbconnect.php";

$productid = $_GET['pid'];

// Fetch product details
$productDetail = mysqli_query($conn, "SELECT * FROM products WHERE pid = '$productid'");
$product = mysqli_fetch_assoc($productDetail);


// Fetch corresponding images for the product
$imageQuery = mysqli_query($conn, "SELECT url, color FROM image WHERE car_id = '$productid'");

// Initialize arrays to store image URLs and colors
$imageUrls = array();
$colors = array();
while ($image = mysqli_fetch_assoc($imageQuery)) {
    $imageUrls[$image['color']][] = $image['url'];
    $colors[] = $image['color'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <h2><?php echo $product['product_name']; ?></h2>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="<?php echo reset($imageUrls)[0]; ?>" alt="Product Image" id="productImage">
                    <div class="card-body">
                        <div class="btn-group d-flex" role="group" aria-label="Color Buttons">
                            <?php foreach (array_unique($colors) as $color) { ?>
                                <button type="button" class="btn btn-<?php echo $color; ?> flex-grow-1" onclick="updateImage('<?php echo $color; ?>')"><?php echo ucfirst($color); ?></button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <p class="lead"><?php echo $product['product_description']; ?></p>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Color:</strong> <?php foreach (array_unique($colors) as $color) {
                                                        echo ucfirst($color) . ', ';
                                                    } ?></p>
                        <p><strong>Price:</strong> Rs. <?php echo $product['product_price']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <?php if ($product['product_stock'] == 0) { ?>
                            <h5 class="text-danger">Out of Stock</h5>
                        <?php } else { ?>
                            <h5 class="text-success">Available stock: <?php echo $product['product_stock']; ?></h5>
                            <?php if (isset($_SESSION['username'])) { ?>
                                <form action="addtocart.php" method="post">
                                    <div class="mb-3">
                                        <input type="number" name="pid" value="<?php echo $product['pid']; ?>" hidden>
                                        <label for="Mod_Quantity" class="form-label">Quantity</label>
                                        <input type="number" name="Mod_Quantity" id="Mod_Quantity" class="form-control" required placeholder="Enter quantity" onchange="validateQuantity()">
                                    </div>
                                    <button type="submit" name="addtocart" class="btn btn-outline-dark">Add to cart</button>
                                </form>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, only if you need JavaScript functionality) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> -->
    <script>
        <?php
        // Pass image URLs to JavaScript as JSON
        $imageUrlsJson = json_encode($imageUrls);
        ?>

        function updateImage(color) {
            var imageUrls = <?php echo $imageUrlsJson; ?>;
            var productImage = document.getElementById('productImage');
            productImage.src = imageUrls[color][0];
            validateQuantity();
        }

        function validateQuantity() {
            var quantityInput = document.getElementById('Mod_Quantity');
            if (parseInt(quantityInput.value) < 1) {
                alert('Quantity cannot be negative.');
                quantityInput.value = 1; // Set quantity to 0
            }
        }
    </script>
    <?php include "footer.php" ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>


</html>