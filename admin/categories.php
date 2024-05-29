<?php
// Assuming you've retrieved the selected category from a form submission or URL parameter
$categories = $_GET['categories']; // Example: 'men', 'women', 'child'

// Query to fetch products based on the selected category
$query = "SELECT * FROM products WHERE categories = '$categories'";
$result = mysqli_query($conn, $query);

// Check if there are any products in the selected category
if (mysqli_num_rows($result) > 0) {
    // Display products
    while ($row = mysqli_fetch_assoc($result)) {
        // Display each product here, e.g., within a loop
        echo '<div class="product">';
        echo '<h2>' . $row['product_name'] . '</h2>';
        echo '<img src="uploads/products/' . $row['product_image'] . '" alt="' . $row['product_name'] . '">';
        echo '<p>' . $row['product_description'] . '</p>';
        echo '<p>Price: $' . $row['product_price'] . '</p>';
        echo '</div>';
    }
} else {
    echo 'No products found in this category.';
}
