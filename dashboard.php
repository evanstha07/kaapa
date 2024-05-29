<?php 
include "dbconnect.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashoard</title>
</head>
<body style="height:100%;">


    <div style="width: 100%;background-color: grey;  height: 3rem;text-align: center; justify-content: center;">
        <h2>FABBRIK Admin Dashboard</h2>
    </div>


<div class="dashboardMain">
    <div style=" background-color: #A1CCD1;
        height: 100%;
        width: 30%;
        float: left;
        display: flex;
        align-items: center;
        position: relatives;
        margin: 0px;
        flex-direction: column;">
    
        <div class="dashboardButton">
            Add Item
        </div>
    
        <div class="dashboardButton">
            Manage Item
        </div>
    
        <div class="dashboardButton">
            Orders
        </div>
    
        <div class="dashboardButton">
            <a href="admin-panel/registered.php">Users</a>
        </div>
        <div class="dashboardButton">
            Inbox
        </div>
    
    </div>
           <div class="dashboardRight">

            <div class="itemForm">
    <form action="dashboard.php" method="post">
        <label>Product Name:</label>
        <input type="text" name="product_name" required><br>

        <label>Product Description:</label><br>
        <textarea name="product_description" required></textarea><br>

        <label>Product Price:</label>
        <input type="number" name="product_price"  required><br>

        <label>Product Image:</label>
        <input type="file" name="product_image" accept="image/*" required><br>

        <input type="submit" value="Upload">
    </form>

    <!-- Add ITEM -->
<?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $product_name = $_POST["product_name"];
                $product_description = $_POST["product_description"];
                $product_price = $_POST["product_price"];
                $product_image = $_POST["product_image"];

               // To Check if an image was uploaded successfully
                if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
                    // Handle uploaded image
                    $target_dir = "uploads/";
                    $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
                    
                  } 

                // Using prepared statement to prevent SQL injection
                $sql = "INSERT INTO products (product_name, product_description, product_price, product_image) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);

                // Binding parameters to the prepared statement
                mysqli_stmt_bind_param($stmt, "ssds", $product_name, $product_description, $product_price, $product_image);

                // Execute the prepared statement
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    echo "Record added";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }

                // Close the prepared statement
                mysqli_stmt_close($stmt);
            }
        
            ?>  
        </div> 
</div>
</body>
</html>