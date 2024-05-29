<?php
session_start();
include '../dbconnect.php';

function pretty_file()
{
  // Encode the $_FILES array as JSON for better formatting
  $files_json = json_encode($_FILES, JSON_PRETTY_PRINT);

  // Decode the JSON string back to a PHP array for manipulation
  $files_array = json_decode($files_json, true);

  // Print the prettified version of the $_FILES array
  echo '<pre>';
  echo htmlentities($files_json); // Use htmlentities to escape HTML tags
  echo '</pre>';
}

$product_name = '';
$product_image = 'no-image.jpg';
$product_description = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $product_name = $_POST['product_name'];
  $product_image = hash('sha256', $_FILES['product_image']['name'] . time());
  $temp_image = $_FILES['product_image']['tmp_name'];
  $product_price = $_POST['product_price'];
  $product_description = $_POST['product_description'];
  $product_stock = $_POST['product_stock'];
  $colors = $_POST['color'];
  $categories = $_POST['categories']; // Retrieve selected category
  $target_dir =   "../uploads/";
  $tempdir = $target_dir . basename($product_image);
  if (move_uploaded_file($temp_image, $tempdir)) {
    $product_image = 'uploads/' . $product_image;
    echo '<script>console.log("file uploaded")</script>';
  }
  foreach ($colors as $color) {
    $file_name = hash('sha256', $_FILES[$color]['name'] . time());
    $target_file = $target_dir . basename($file_name);
    $file_tmp = $_FILES[$color]['tmp_name'];

    if (move_uploaded_file($file_tmp, $target_file)) {
      $image_urls[$color] = 'uploads/' . $file_name;
    } else {
      echo "Failed to upload image for color $color.";
    }
  }
  // Insert product into the database
  $query = "INSERT INTO products (`product_name`,`product_image`,`product_description`,`product_price`,`product_stock`,`categories`) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($query);

  $stmt->bind_param("sssdis", $product_name, $product_image, $product_description, $product_price, $product_stock, $categories);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {
    $product_id = $stmt->insert_id;

    foreach ($image_urls as $color => $url) {
      $query = "INSERT INTO image (`car_id`, `url`, `color`) VALUES (?, ?, ?)";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("iss", $product_id, $url, $color);
      $stmt->execute();
    }

    echo '<script>alert("Product Added")</script>';
  } else {
    echo '<script>alert("Error: Unable to Add Product");</script>';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kaapa:| Add new product</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="stylesheet" href="../assets/css/bootstrap.css" />
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />

  <!-- Theme style -->
  <link rel="stylesheet" href="css/adminlte.min.css" />

  <link rel="icon" type="image/x-icon" href="../assets/images/logos/webw.png" />

</head>

<body>
  <?php
  include '../includes/aside.php';
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container d-flex justify-content-center">
        <b class="font">
          <h1>Add New Product</h1>
        </b>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">

        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body font">
        <form method="POST" id="ProductDetails" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-md-6 col-lg-6">
              <label>Product Name</label>
              <input type="text" name="product_name" id="product_name" class="form-control border-1 border-secondary" value="" required placeholder="Product_name">
            </div>

            <div class="form-group col-md-6 col-lg-6">
              <label>Product Image</label>
              <input type="file" name="product_image" id="image" class="form-control border-1 border-secondary" required>
            </div>

            <div class="form-group col-sm-4">
              <label>Price</label>
              <input type="number" name="product_price" id="price" required placeholder="Price" class="form-control border-1 border-secondary">
            </div>

            <div class="form-group col-sm-4">
              <label>Category</label>
              <select name="categories" id="categories" required class="form-control border-1 border-secondary">
                <option value="" selected disabled>Select Category</option>
                <option value="Men"><a href="./men.php">Men</a></option>
                <option value="Women"><a href="./women.php">Women</a></option>
                <option value="Child"><a href="./child.php">Child</a></option>
              </select>
            </div>

            <div class="form-group col-md-8 col-lg-12">
              <label>Description:</label>
              <textarea name="product_description" id="description" cols="10" rows="5" class="form-control border-1 border-secondary" required placeholder="Product Description"></textarea>
            </div>

            <div class="form-group col-sm-4">
              <label>Stock</label>
              <input type="number" name="product_stock" id="stock" required placeholder="Stock" class="form-control border-1 border-secondary">
            </div>

            <!-- <div class="form-group col-md-6 col-lg-6">
              <label>Size</label>
              <select name="size" id="size" required class="form-control border-1 border-secondary">
                <option value="" selected disabled>Select Size</option>
                <option value="Small">Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
              </select>
            </div>

            <div class="form-group col-md-6 col-lg-6">
              <label>Color</label>
              <select name="color" id="color" required class="form-control border-1 border-secondary">
                <option value="" selected disabled>Select Color</option>
                <option value="Red">White</option>
                <option value="Blue">Black</option>
                <option value="Green">Gray</option>
                <option value="Red">Green</option>
                <option value="Blue">Pink</option>
                <option value="Green">Blue</option>
              </select>
            </div> -->

            <div class="form-group col-md-6 col-lg-6">
              <label>Color</label><br>
              <select name="color[]" id="color" class="form-control border-1 border-secondary color-select" required multiple>
                <option value="" selected disabled>Select Color</option>
                <option value="white">White</option>
                <option value="black">Black</option>
                <option value="gray">Gray</option>
                <!-- Add more color options as needed -->
              </select>

              <div id="imageUploads"></div>
            </div>
            <!-- <div class="form-group col-md-6 col-lg-6">
              <label>Color</label><br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="color[]" id="color_white" value="White" required>
                <label class="form-check-label" for="color_white">White</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="color[]" id="color_black" value="Black">
                <label class="form-check-label" for="color_black">Black</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="color[]" id="color_gray" value="Gray">
                <label class="form-check-label" for="color_gray">Gray</label>
              </div>
              <!-- Add more color options as needed -->
          </div>



          <div class="form-group col-md-12">
            <input type="submit" value="ADD" name="submit_prod" id="submit" class="btn bg-dark text-white" />
            <input type="reset" value="RESET" name="" id="submit" class="btn bg-purple" />
          </div>
      </div>
      </form>
  </div>
  </section>
  </div>

  <?php
  require '../footer.php';
  ?>

  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'GET') { ?>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        function createImageUploadFields() {
          document.getElementById('imageUploads').innerHTML = '';

          var selectedColors = Array.from(document.querySelectorAll('.color-select option:checked')).map(option => option.value);

          // Create image upload fields for each selected color
          selectedColors.forEach(function(color) {
            var imageUploadField = document.createElement('div');
            imageUploadField.innerHTML = `
                <div class="form-group">
                    <label>Image for ${color}</label>
                    <input type="file" name="${color.toLowerCase()}" class="form-control border-1 border-secondary" required>
                </div>
            `;
            document.getElementById('imageUploads').appendChild(imageUploadField);
          });
        }

        // Event listener for color selection
        document.querySelector('.color-select').addEventListener('change', function() {
          createImageUploadFields();
        });
      });
    </script>

  <?php }

  ?>