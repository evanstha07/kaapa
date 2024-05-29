<?php
	include "./dbconnect.php";
	session_start();

	extract($_POST);
	if(isset($update)){
		mysqli_query($conn,"UPDATE products SET name='$name' where pid='". $_GET['pid'] ."'");
		echo '<script>
		alert("Product Updated");
		</script>';
	}

	$query = mysqli_query($conn, "SELECT * FROM products WHERE pid='".$_GET['pid'] ."'");
	$result = mysqli_fetch_assoc($query);
?>

<?php

?>
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
