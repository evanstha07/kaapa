<?php
// Start session
session_start();

// Include database connection
include('./dbconnect.php');

// Check if 'cart' is set in the session, initialize it if not
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Check if the form was submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Adding product to cart
    if (isset($_POST['addtocart'])) {
        // Get product ID from the form
        $pid = $_POST['pid'];
        // Query the database to fetch product details
        $productDetail = mysqli_query($conn, "SELECT * FROM products WHERE pid= '$pid'");

        // Fetch the product details
        $product = mysqli_fetch_array($productDetail);

        // Check if product exists
        if (!$product) {
            echo '<script>alert("Product not found");
            window.location.href="./index.php";</script>';
            exit(); // Stop further execution
        }

        // Check if requested quantity is greater than available stock
        if ($product['product_stock'] < $_POST['Mod_Quantity']) {
            echo '<script>alert("Insufficient stock");
            window.location.href="./index.php";</script>';
            exit(); // Stop further execution
        }

        // Check if product is already in the cart
        $myitems = array_column($_SESSION['cart'], 'cid');
        if (in_array($pid, $myitems)) {
            echo "<script>
                alert('Product already added');
                window.location.href='./mycart.php';
                </script>";
            exit(); // Stop further execution
        }

        // Add product to cart
        $newCartItem = array(
            'Item_name' => $product['product_name'],
            'price' => $product['product_price'],
            'Quantity' => $_POST['Mod_Quantity'],
            'pid' => $product['pid']
        );
        $_SESSION['cart'][] = $newCartItem;

        // Redirect to cart page
        echo "<script> alert('Product added to the cart');
            window.location.href='./mycart.php';
            </script>";
        exit(); // Stop further execution
    }

    // For remove button
    if (isset($_POST['Remove_Item'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['Item_name'] == $_POST['Item_name']) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                echo "<script>
                    alert('Product Removed from the cart');
                    window.location.href='./mycart.php';
                    </script>";
                exit(); // Stop further execution
            }
        }
    }

    // To modify quantity
    if (isset($_POST['Mod_Quantity'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['Item_name'] == $_POST['product_name']) {
                $_SESSION['cart'][$key]['Quantity'] = $_POST['Mod_Quantity'];
                echo "<script>window.location.href='./mycart.php';</script>";
                exit(); // Stop further execution
            }
        }
    }
}

// If none of the conditions are met or there's a direct access, redirect to index page
header("Location: ./index.php");
exit(); // Stop further execution
