    <?php
    include "dbconnect.php";
    ?>
    <?php
    $fname_err = $lname_err = $username_err = $email_err = $address_err = $email_err1 = $phone_err = $phone_err1 = $pass_err = $pass_err1 = $success = null;
    if (isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];
        $username = $_POST['username'];

        $existsSql = "SELECT * FROM register WHERE email = '$email'";
        $result = mysqli_query($conn, $existsSql);
        $numExistRows = mysqli_num_rows($result);
        if ($numExistRows > 0) {
            echo "Email already Exists";
        } else if (empty($fname)) {
            $fname_err = "First name cannot be empty";
        } else if (empty($lname)) {
            $lname_err = "Last name cannot be empty";
        } else if (empty($email)) {
            $email_err = "Email Field is mandatory";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err1 = "Invalid Email";
        } else if (empty($phone)) {
            $phone_err = "Phone field is empty";
        } else if (empty($username)) {
            $username_err = "Username field is empty";
        } else if (empty($address)) {
            $address_err = "Address field is empty";
        } else if (!preg_match('/^[0-9]{10}+$/', $phone)) {
            $phone_err1 = "Invalid phone number";
        } else if (strlen($pass) < 8) {
            $pass_err = "Atleast 8 characters needed";
        } else if ($pass !== $cpass) {
            $pass_err1 = "Passwords do not match";
        } else {
            $sql = "INSERT INTO `register` (`username`,`fname`, `lname`, `email`,`address`, `phone`, `password`) VALUES ('$username','$fname', '$lname', '$email','$address', '$phone', '$pass')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $success = "Signed Up successfully";
                header("Location: login.php");
            }
        }
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Register</title>
        <style>
            .logo img {
                width: 300px;
                display: flex;
                justify-content: center;
            }

            .error {
                display: none;
                color: red;
            }

            .success {
                display: none;
                color: green;
            }
        </style>

        <?php
        if ($fname_err != null) {
        ?><style>
                .fname-err {
                    display: block;
                }
            </style><?php
                }
                    ?>

        <?php
        if ($lname_err != null) {
        ?><style>
                .lname-err {
                    display: block;
                }
            </style><?php
                }
                    ?>
        <?php
        if ($email_err != null) {
        ?><style>
                .email-err {
                    display: block;
                }
            </style><?php
                }
                    ?>
        <?php
        if ($username_err != null) {
        ?><style>
                .username-err {
                    display: block;
                }
            </style><?php
                }
                    ?>
        <?php
        if ($address_err != null) {
        ?><style>
                .address-err {
                    display: block;
                }
            </style><?php
                }
                    ?>
        <?php
        if ($email_err1 != null) {
        ?><style>
                .email-err {
                    display: block;
                }
            </style><?php
                }
                    ?>
        <?php
        if ($phone_err != null) {
        ?><style>
                .phone-err {
                    display: block;
                }
            </style><?php
                }
                    ?>
        <?php
        if ($phone_err1 != null) {
        ?><style>
                .phone-err {
                    display: block;
                }
            </style><?php
                }
                    ?>
        <?php
        if ($pass_err != null) {
        ?><style>
                .pass-err {
                    display: block;
                }
            </style><?php
                }
                    ?>
        <?php
        if ($pass_err1 != null) {
        ?><style>
                .pass-err {
                    display: block;
                }
            </style><?php
                }
                    ?>
        <?php
        if ($success != null) {
        ?><style>
                .success {
                    display: block;
                }
            </style><?php
                }
                    ?>
    </head>


    <?php
    include "navbar.php";
    ?>

    <body>
        <div class="container" style="flex-direction:column;">
            <!-- <div class="logo"> <img src="img/logo-t.png" /> </div> -->
            <div class="success">
                <p class="success"><?php echo $success ?></p>
            </div>

            <div class="container-fluid d-flex justify-content-center">
                <form class="form-section" action="register.php" method="POST">
                    <div class="form-group">

                        <label for="first name">First name</label>
                        <input type="text" name="fname" class="form-control" id="fNAme" placeholder="First Name" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>">
                        <p class="error fname-err"><?php echo $fname_err ?></p>


                        <label for="lastName">Last name</label>
                        <input type="text" name="lname" class="form-control" id="lNAme" placeholder="Last Name" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>">
                        <p class="error lname-err"><?php echo $lname_err ?></p>

                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>">
                        <p class="error username-err"><?php echo $lname_err ?></p>

                        <label for="email">Email address</label>
                        <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                        <p class="error email-err"><?php echo $email_err ?></p>
                        <p class="error email-err"><?php echo $email_err1 ?></p>

                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="Enter address" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                        <p class="error address-err"><?php echo $address_err ?></p>
                        <p class="error address-err"><?php echo $address_err1 ?></p>


                        <label for="lastName">Phone Number</label>
                        <input type="text" class="form-control" name="phone" id="phoneNumber" placeholder="Phone Number" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>">
                        <p class="error phone-err"><?php echo $phone_err ?></p>
                        <p class="error phone-err"><?php echo $phone_err1 ?></p>

                        <label for="Password">Password</label>
                        <input type="password" class="form-control" name="pass" id="Password1" placeholder="Password" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>">
                        <p class="error pass-err"><?php echo $pass_err ?></p>

                        <label for="retypePassword">Retype Password</label>
                        <input type="Password" name="cpass" class="form-control" id="retypePassword1" placeholder="Password">
                        <p class="error pass-err"><?php echo $pass_err1 ?></p>

                    </div>
                    <input type="submit" name="submit" value="Sign Up" class="btn btn-primary">
                    <p>Already have an account? <a href="login.php">Log in.</a></p>
                </form>
            </div>
        </div>



        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


        <div style="position: relative; top: 5rem;">
            <?php include "footer.php" ?>
        </div>
    </body>

    </html>