<?php
include "./dbconnect.php";

$query = "INSERT INTO products (`product_name`, `product_image`, `product_description`, `product_price`, `product_stock`, `categories`,`size`,`color`) 
              VALUES ('test', 'w.jpeg', 'description', '12', '12', 'testcategory', 'small', 'green')";

if (mysqli_query($conn, $query)) {
    $pid = mysqli_insert_id($conn);
    echo $pid;
}
