<?php
include './dbconnect.php';

// Check if category parameter is set in the URL
if (isset($_GET['categoroies'])) {
    $categories = $_GET['categories'];

    // Query to fetch products based on the selected category
    $query = "SELECT * FROM products WHERE categories = '$categories'";
    $result = mysqli_query($conn, $query);

    // Check for errors in query execution
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Display products
    echo '<h2>Products in ' . $categories . ' Categories:</h2>';
    echo '<ul>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<li>' . $row['product_name'] . '</li>';
    }
    echo '</ul>';
} else {
    echo 'No category selected.';
}

// Close database connection
mysqli_close($conn);
