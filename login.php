<?php
include "navbar.php";
?>

<?php
include "dbconnect.php";
$login = FALSE;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM register WHERE username= '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $login = TRUE;
        session_start();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['username'] = $username;

        header("Location: index.php");
    } else {
        echo "Invalid Credentials";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaapa: | Log In</title>
</head>


<body>
    <?php
    if ($login) {
        echo "Logged in Successfully";
    }
    ?>
    <div class="container" style="flex-direction: column">
        <img src="img/logo-t.png" style="width: 500px;">
        <!-- <h1 class="text-center" style="    top: 1rem; position:relative;">Welcome to</h1> -->
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Enter username" style="width: 30rem;">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" style="width: 30rem;">
            </div>
            <button type="logIn" name="login" class="btn btn-primary" style="float: right;">LOG IN</button>
            <p>Don't have an account? <a href="register.php">Create New Account.</a></p>
        </form>


    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



    <div style="position: relative; top: 6rem;">
        <?php include "footer.php" ?>
    </div>
</body>

</html>