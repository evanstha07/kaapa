<?php
include "navbar.php";
include "dbconnect.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>Kaapa:</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
        $searchTerm = $_POST['search'];

        // Sanitize the user input (to prevent SQL injection)
        $searchTerm = $conn->real_escape_string($searchTerm);

        // Construct the SQL query
        $sql = "SELECT * FROM products WHERE product_name LIKE '%$searchTerm%'";

        // Execute the query
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        if ($result->num_rows > 0) {
            echo "<h2 class='text-center'>Search Results:</h2>";
            echo "<div class='container'>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='card' style='width: 18rem;'>";
                echo "<img src='" . $row['product_image'] . "' class='card-img-top' alt='Product Image'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $row['product_name'] . "</h5>";
                echo "<p class='card-text'>Rs. " . $row['product_price'] . "</p>";
                if (isset($_SESSION['username'])) {
                    echo "<a href='buyPage.php?pid=" . $row['pid'] . "' class='btn btn-primary'>Buy</a>";
                } else {
                    echo "<a href='login.php' class='btn btn-primary'>Buy</a>";
                }
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<div class='container'>";
            echo "<p class='text-center'>No results found.</p>";
            echo "</div>";
        }
    }
    ?>


    <?php include "footer.php" ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>