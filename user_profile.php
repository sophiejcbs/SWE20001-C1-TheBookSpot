<?php
    session_start();
    include_once 'settings.php';
    include_once 'inc/functions.php';
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="utf‐8" /> 
    <meta name="description" content="SWE20001 The Book Spot"/>
    <meta name="keywords" content="book, store"/> 
    <meta name="author"   content="The Flying Fish" />
    <title>Profile - The Book Spot</title>
    
    <link rel="icon" type="image/x-icon" href="images\logo.png">
    <!-- CSS -->
    <link href = "styles/user.css" rel="stylesheet">
    <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)"/>

    <!-- Javascript -->
    <script src="scripts/index.js"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    
    <!-- Header & Navigation Menu-->
    <?php
        include_once 'inc/header.inc';
        include_once 'inc/menu.inc';
    ?>
    <!-- User Profile Container -->
    <div class="container">
        <!-- Side Panel -->
        <div class="side-panel">
            <div class="profile-blue-box">
                <i class="bi bi-person-circle icon-large"></i>
                <p class="profile-info">Welcome, <?php echo $_SESSION["username"]; ?>.</p>
                <p class="profile-info"><?php echo $_SESSION["email"];?></p>
                <p class="profile-info">Phone number: <?php echo $_SESSION["phone"];?></p>
            </div>
        </div>
        <!-- Right Panel -->
        <div class="right-content">
            <!-- Change User Information Form -->
            <div class="form">
                <form method="post" action="inc/editUserInfo.inc.php" novalidate>
                    <fieldset>
                        <legend class="formGroup">Account Information <i class="bi bi-person-fill"></i></legend>
                        <?php
                        if(isset($_GET["error"])){
                            if($_GET["error"] == "emptynameinput"){
                                echo "<p class = \"errormessage\">Fields must not be empty!*</p>";
                            }
                            else if($_GET["error"] == "nameerror"){
                                echo "<p class = \"errormessage\">An error occured! Please try again later.</p>";
                            }
                            else if($_GET["error"] == "namesuccess"){
                                echo "<p class = \"success\">Name successfully updated!</p>";
                            }
                        }
                      ?>
                        <div class="txt_field">
                            <input type="text" name="fname" id="fname" required <?php if (!empty($_SESSION["fname"])) { echo "value='{$_SESSION['fname']}'"; } ?>>
                            <span></span>
                            <label for="fname">First Name</label>
                        </div>
                    
                        <div class="txt_field">
                            <input type="text" name="lname" id="lname" required <?php if (!empty($_SESSION["lname"])) { echo "value='{$_SESSION['lname']}'"; } ?>>
                            <span></span>
                            <label for="lname">Last Name</label>
                        </div>

                        <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'];?>">

                    </fieldset>
                    <input class="submit" type="submit" name="changeInfo" value="Submit">
                </form>
            </div>

            <!-- Change Password Form -->
            <div class="form">
                <form method="post" action="inc/changePassword.inc.php" novalidate>
                    <fieldset>
                        <legend class="formGroup">Change password <i class="bi bi-lock-fill"></i></legend>
                        <?php
                        if(isset($_GET["error"])){
                            if($_GET["error"] == "pwdemptyinput"){
                                echo "<p class = \"errormessage\">Fill in all fields!*</p>";
                            }
                            else if($_GET["error"] == "wrongoldpwd"){
                                echo "<p class = \"errormessage\">Current Password does not match!*</p>";
                            }
                            else if($_GET["error"] == "oldnewsame"){
                                echo "<p class = \"errormessage\">New Passwords cannot be same as the Old Password!*</p>";
                            }
                            else if($_GET["error"] == "pwdnomatch"){
                                echo "<p class = \"errormessage\">New Passwords does not match!*</p>";
                            }
                            else if($_GET["error"] == "pwdsuccess"){
                                echo "<p class = \"success\">Password successfully changed!</p>";
                            }
                        }
                      ?>
                        <div class="txt_field">
                            <input type="password" name="pwdold" id="pwdold" required>
                            <span></span>
                            <label for="pwdold">Current Password</label>
                        </div>
                    
                        <div class="txt_field">
                            <input type="password" name="pwd" id="password" required>
                            <span></span>
                            <label for="password">New Password</label>
                        </div>
                    
                        <div class="txt_field">
                            <input type="password" name="repeatpwd" id="repeatPassword" required>
                            <span></span>
                            <label for="repeatPassword">Repeat Password</label>
                        </div>

                        <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'];?>">
                    
                    </fieldset>
                    <input class="submit" type="submit" name="changepwd" value="Submit">
                </form>
            </div>

            <!-- Change Shipping Information Form -->
            <div class="form">
                <form method="post" action="inc/editUserInfo.inc.php" novalidate>
                    <fieldset>
                        <legend class="formGroup">Shipping Address <i class="bi bi-house-door-fill"></i></legend>
                        <?php
                        if(isset($_GET["error"])){
                            if($_GET["error"] == "addressempty"){
                                echo "<p class = \"errormessage\">Fill in all fields!*</p>";
                            }
                            else if($_GET["error"] == "addresserror"){
                                echo "<p class = \"errormessage\">Error occured! Please try again later.</p>";
                            }
                            else if($_GET["error"] == "addresssuccess"){
                                echo "<p class = \"success\">Shipping address successfully updated!</p>";
                            }
                        }
                      ?>
                        <div class="txt_field">
                            <input type="text" name="address" id="address" required <?php if (!empty($_SESSION["address"])) { echo "value='{$_SESSION['address']}'"; } ?>>
                            <span></span>
                            <label for="address">Full Address</label>
                        </div>

                        <div class="txt_field">
                            <input type="text" name="postcode" id="postcode" required <?php if (!empty($_SESSION["postcode"])) { echo "value='{$_SESSION['postcode']}'"; } ?>>
                            <span></span>
                            <label for="postcode">Postcode</label>
                        </div>
                    
                        <div class="txt_field">
                            <input type="text" name="city" id="city" required <?php if (!empty($_SESSION["city"])) { echo "value='{$_SESSION['city']}'"; } ?>>
                            <span></span>
                            <label for="city">City</label>
                        </div>

                        <div class="txt_field">
                            <input type="text" name="state" id="state" required <?php if (!empty($_SESSION["state"])) { echo "value='{$_SESSION['state']}'"; } ?>>
                            <span></span>
                            <label for="state">State</label>
                        </div>

                        <div class="txt_field">
                            <input type="text" name="country" id="country" required <?php if (!empty($_SESSION["country"])) { echo "value='{$_SESSION['country']}'"; } ?> readonly>
                            <span></span>
                            <label for="country">Country</label>
                        </div>

                        <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'];?>">

                    </fieldset>
                    <input class="submit" type="submit" name="addressInfo" value="Submit">
                </form>
            </div>

            <!-- Change Payment Information Form -->
            <div class="form">
                <form method="post" action="inc/editUserInfo.inc.php" novalidate>
                    <fieldset>
                        <legend class="formGroup">Payment Information <i class="bi bi-credit-card-fill"></i></legend>
                        <?php
                        if(isset($_GET["error"])){
                            if($_GET["error"] == "paymentempty"){
                                echo "<p class = \"errormessage\">Fill in all fields!*</p>";
                            }
                            else if($_GET["error"] == "cardTypeempty"){
                                echo "<p class = \"errormessage\">Select a card type!</p>";
                            }
                            else if($_GET["error"] == "paymenterror"){
                                echo "<p class = \"errormessage\">Error occured! Please try again later.</p>";
                            }
                            else if($_GET["error"] == "paymentsuccess"){
                                echo "<p class = \"success\">Payment information successfully updated!</p>";
                            }
                        }
                      ?>
                        <section id = "ccTypeSect">
                            <section class = "ccSub" id = "visaContainer">
                                <input type="radio" name="ccType" id="visa" value="Visa" <?php if ($_SESSION["ccType"] === "Visa") { echo ' checked'; } ?>>
                                <label for="visa" id = "visaLabel" class = "ccType"><img class = "ccIcon" src = "images/visa.png" alt = "Visa Credit Card Icon"><p>Visa</p></label>
                            </section>

                            <section class = "ccSub" id = "mcContainer">
                                <input type="radio" name="ccType" id="mastercard" value="Mastercard" <?php if ($_SESSION["ccType"] === "Mastercard") { echo ' checked'; } ?>>
                                <label for="mastercard" class = "ccType"><img class = "ccIcon" src = "images/mastercard.png" alt = "Mastercard Card Icon"><p>Mastercard</p></label>
                            </section>

                            <section class = "ccSub" id = "amexContainer">
                                <input type="radio" name="ccType" id="amex" value="American Express" <?php if ($_SESSION["ccType"] === "American Express") { echo ' checked'; } ?>>
                                <label for="amex" class = "ccType"><img class = "ccIcon" src = "images/american-express.png" alt = "American Express Credit Card Icon"><p id = "amexOpt">AmEx</p></label>
                            </section>
                        </section>

                        <div class="txt_field">
                            <input type="text" name="cardNo" id="cardNo" required <?php if (!empty($_SESSION["cardno"])) { echo "value='{$_SESSION['cardno']}'"; } ?>>
                            <span></span>
                            <label for="cardNo">Card Number</label>
                        </div>

                        <div class="txt_field">
                            <input type="text" name="ccName" id="ccName" required <?php if (!empty($_SESSION["ccName"])) { echo "value='{$_SESSION['ccName']}'"; } ?>>
                            <span></span>
                            <label for="ccName">Name on Card</label>
                        </div>
                    
                        <div class="txt_field">
                            <input type="text" name="expiry" id="expiry" required <?php if (!empty($_SESSION["expiry"])) { echo "value='{$_SESSION['expiry']}'"; } ?>>
                            <span></span>
                            <label for="expiry">Expiry Date (MM/YY)</label>
                        </div>

                        <div class="txt_field">
                            <input type="text" name="cvv" id="cvv" required <?php if (!empty($_SESSION["cvv"])) { echo "value='{$_SESSION['cvv']}'"; } ?>>
                            <span></span>
                            <label for="cvv">CVV</label>
                        </div>

                        <input type="hidden" name="userid" value="<?php echo $_SESSION['userid'];?>">

                    </fieldset>
                    <input class="submit" type="submit" name="payment" value="Submit">
                </form>
            </div>
        </div>
    </div>

    <?php
        // close the database connection
        mysqli_close ($conn) ;

        // Footer
        include_once 'inc/footer.inc';
    ?>
</body>
</html>
