<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style>
		.box{
			display: flex;
			border: solid;
			height: 200px;
			width: 100%;
			margin: 0px;
			justify-content: center;
			align-items: center;
			
		}
	</style>
</head>
<body>
	<?php 
	include "../dbconnect.php";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $product_name = $_POST["product_name"];
            $product_description = $_POST["product_description"];
            $product_price = $_POST["product_price"];
            $product_image = $_POST["product_image"];
}
        	$select_data = "SELECT * FROM products";
	$result = mysqli_query($conn,$select_data);

	while ($row = mysqli_fetch_assoc($result)) {
		$product_name = $row['product_name'];
        $product_description = $row['product_description'];
        $product_price = $row['product_price'];
        $product_image = $row['product_image'];

		echo "<div class='box'>
		<div class='box'>$product_name</div>
		<div class='box'>$product_description</div>
		<div class='box'><img src= '../img/$product_image' alt='...'; height = '200px' width = '75%'></div>
		<div class='box'>$product_price</div>
		<div class='box'><button>Update</button></div>
		</div>";
	}
?> 
</body>
</html>