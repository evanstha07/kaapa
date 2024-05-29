<?php
session_start();
include('./dbconnect.php');
extract($_POST);
if (mysqli_connect_error()) {
    echo "<script>
  alert('cannot connect to database');
    window.location.href='./mycart.php';
  </script>";
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST")    //checking the server method is post or not
{
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            $sr = $key + 1;
            if (isset($_POST))   //checking make purchse button
            {
                $pname = $value['Item_name'];
                $productDetail = mysqli_query($conn, "SELECT * FROM products WHERE product_name= '$pname'");

                $oid = rand(1, 100);
                $query1 = "INSERT INTO orders(item_name, price, quantity, order_id, orderedby, address, phone_no, payment_mode) VALUES ('$value[Item_name]','$value[price]','$value[Quantity]',$oid,'$_POST[fname]','$_POST[address]','$_POST[phone_no]','$_POST[pay_mode]')";
                if (mysqli_query($conn, $query1)) {
                    while ($product = mysqli_fetch_array($productDetail)) {
                        $stmt = null; // Initialize $stmt to avoid undefined errors (optional)

                        // if ($product['product_stock'] >= $value['Quantity']) {
                        //     $query3 = "UPDATE products SET product_stock= '$product[product_stock]'-'$value[Quantity]' WHERE product_name = '$pname'";
                        //     $stmt = mysqli_prepare($conn, $query3); // Prepare statement here
                        // } else {
                        //     echo "<script>
                        //     alert('Insufficient Stock!!!');
                        //     window.location.href='./p_details.php';
                        //   </script>";
                        // }
                        if ($product['product_stock'] >= $value['Quantity']) {
                            $query3 = "UPDATE products SET product_stock = product_stock - ? WHERE product_name = ?";
                            $stmt = mysqli_prepare($conn, $query3); // Prepare statement here

                            // Bind parameters
                            mysqli_stmt_bind_param($stmt, "is", $value['Quantity'], $pname);

                            // Execute the statement
                            mysqli_stmt_execute($stmt);
                        } else {
                            echo "<script>
                            alert('Insufficient Stock!!!');
                            window.location.href='./p_details.php';
                            </script>";
                        }


                        if ($stmt) { // Check if $stmt is prepared successfully
                            // mysqli_stmt_bind_param($stmt, $Order_Id, $Item_Name, $Price, $Quantity); //binding the prepare statement with parameters '?' (if needed)
                            foreach ($_SESSION['cart'] as $key => $values) {
                                $Item_Name = $values['Item_name']; //values = form names
                                $Price = $values['price'];
                                $Quantity = $values['Quantity'];
                                mysqli_stmt_execute($stmt); // Execute the statement for each item
                            }
                            unset($_SESSION['cart']);
                            echo "Order Placed";
                        } else {
                            return; // Or handle the error differently
                            echo "<script>
                            alert('SQL query prepared error');
                            window.location.href='./mycart.php';
                          </script>";
                        }
                    }
                } else { {
                        echo "<script>
    alert('SQL error');
      window.location.href='./mycart.php';
    </script>";
                    }
                }
            }
        }
    }
}
