<?php
include("./navbar.php");
include("./dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaapa: | Cart</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" defer></script>
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    <!-- js for dropdown -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <link href="./css/bootstrap.min.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="container" style="font-family:'Loco',serif;">
        <div class="row">
            <div class="col-lg-12 text-center text-dark border rounded my-5">
                <h1>MY CART</h1>
            </div>

            <div class="col-lg-9 font">
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">Serial No.</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        $total = 0;
                        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $key => $value) {
                                $sr = $key + 1;
                                if (isset($value['price'],  $value['Quantity'])) {

                                    $total = $value['price'] * $value['Quantity']; // Check if required keys exist in $value;
                                    echo "
                    <tr>
                        <td>$sr</td>
                        <td>$value[Item_name]</td>
                        <td>$value[price]<input type='hidden' class='iprice' value='$value[price]'></td>
                        <td>
                            <form action='./addtocart.php' method='POST'>
                                $value[Quantity]<input class='text-center iquantity' name='Mod_Quantity' id='Mod_Quantity' onchange='this.form.submit();' type='hidden' value='$value[Quantity]' min='1' max=''>
                                <input type='hidden' name='Item_name' value='$value[Item_name]'>
                            </form>
                        </td>
                        <td class='itotal'>$total</td>
                        <td>
                            <form action='./addtocart.php' method='POST'>
                                <button name='Remove_Item' class='btn btn-sm btn-danger'>REMOVE</button>
                                <input type='hidden' name='Item_name' value='$value[Item_name]'>
                            </form>
                        </td>
                    </tr>";
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <?php
            $username = $_SESSION['username'];
            $userDetail = mysqli_query($conn, "SELECT * FROM register WHERE username= '$username'");

            while ($userinfo = mysqli_fetch_array($userDetail)) { ?>
                <div class="col-lg-3 font">
                    <div class="border border-secondary mb-5 border-2 bg-light rounded p-4">
                        <h4>Grand Total:</h4>
                        <h5 class="text-right" id="gtotal"></h5>
                        <?php
                        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                        ?>
                            <!--customer details for payment -->

                            <form method="POST" class="my-0" enctype="multipart/form-data" id="cart-form">
                                <div class="form-group mt-3 mb-3">
                                    <b><label>Name: </label></b>
                                    <?php echo $userinfo['fname']; ?><input type="hidden" name="fname" id="fname" value="<?php echo $userinfo['fname'] . " " . $userinfo['lname']; ?>" placeholder="Full Name" class="form-control border-secondary" required>
                                </div>
                                <div class="form-group mt-3 mb-3">
                                    <b><label>Phone: </label></b>
                                    <?php echo $userinfo['phone'] ?><input type="hidden" name="phone_no" id="phone_no" value="<?php echo $userinfo['phone'] ?>" placeholder="Phone Number" class="form-control border-secondary" required>
                                </div>
                                <div class="form-group mt-3 mb-3">
                                    <b><label>Address: </label></b>
                                    <?php echo $userinfo['address'] ?><input type="hidden" name="address" id="address" value="<?php echo $userinfo['address'] ?>" placeholder="Address" class="form-control border-secondary" required>
                                </div>
                                <div class="form-group mt-3 mb-3">
                                    <select name="pay_mode" required id="select" class="form-control">
                                        <option value="">Select Payment Method</option>
                                        <option value="COD">Cash On Delivery</option>
                                        <option value="khalti">Khalti</option>
                                    </select>
                                </div>
                                <button class="btn btn-dark text-white m-auto d-flex justify-content-center" name="purchase" id="purchase">Purchase</button>
                            </form>

                        <?php
                        } ?>
                    </div>

                </div>
            <?php
            } ?>
        </div>
    </div>
    <!--for grand total of the items-->

    i
    <script type="text/javascript" defer>
        const btn = document.getElementById("purchase");
        const payment = document.getElementById("select");
        payment.onchange = function() {
            if (payment.value === "khalti") {
                btn.style.backgroundColor = "#5e338dff";
                btn.innerHTML = "Pay with Khalti";
            } else {
                btn.style.backgroundColor = "black";
                btn.innerHTML = "Purchase"
            }
        }
        btn.onclick = function(event) {
            const form = document.getElementById("cart-form");
            const formdata = new FormData(form);
            const dataObject = {};
            formdata.forEach((value, key) => {
                dataObject[key] = value;
            })
            if (payment.value === "COD") {
                event.preventDefault();
                $.post("./purchase.php", dataObject, result => {
                    if (result === 'Order Placed')
                        alert("Order placed");
                    window.location.href = "index.php";
                })
            } else {
                event.preventDefault();
                const pay_mode = document.getElementById("select").value;
                const address = document.getElementById("address").value;
                var config = {
                    "publicKey": "test_public_key_1059426c6e474dcd8aba71df6f39df8f",
                    "productIdentity": "rgfasdgse",
                    "productName": "354tfdff",
                    "productUrl": "http://localhost/products.php",
                    "paymentPreference": [
                        "KHALTI",
                    ],
                    "eventHandler": {
                        onSuccess(payload) {
                            $.post("./purchase.php", dataObject, result => {
                                if (result === 'Order Placed')
                                    alert(result);
                                window.location.href = "index.php";
                            })
                            console.log(payload)
                        },
                        onError(error) {
                            console.log(error);
                        },
                        onClose() {
                            console.log('widget is closing');
                        }
                    }
                };

                var checkout = new KhaltiCheckout(config);
                checkout.show({
                    amount: 1000
                })
            }
        }
    </script>
    <!-- <script type="text/javascript">
        var gt = 0; //grand total
        var iprice = document.getElementsByClassName('iprice');
        var iquantity = document.getElementsByClassName('iquantity');
        var itotal = document.getElementsByClassName('itotal');
        var gtotal = document.getElementById('gtotal');

        function subTotal() {
            gt = 0;
            for (i = 0; i < iprice.length; i++) {
                itotal[i].innerText = (iprice[i].value) * (iquantity[i].value);
                gt = gt + (iprice[i].value) * (iquantity[i].value);
                /* price 650 quantity 1      gt=0+(650*1)
                price 750 quantity 2          gt= 650+(750*2) === gt = 2150
                price 850 quantity 1          gt= 2150+(850*1)=== gt = 3000 */
            }
            gtotal.innerText = gt;
        }
        subTotal();
    </script> -->
    <?php
    require './footer.php';
    ?>

</body>

</html>