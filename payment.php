<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="utf‐8" /> 
    <meta name="description" content="SWE20001 The Book Spot"/>
    <meta name="keywords" content="book, store"/> 
    <meta name="author"   content="The Flying Fish" />
    <title>The Book Spot</title>
    
    <link rel="icon" type="image/x-icon" href="images\logo.png">
    <!-- CSS -->
    <link href = "styles/style.css" rel="stylesheet">
    <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)"/>
    <link href = "styles/bookCat.css" rel="stylesheet">
    <link href = "styles/payment.css" rel="stylesheet">

    <!-- Javascript -->
    <script src="scripts/book_details.js"></script>
    <script src="scripts/payment.js"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    
    <!-- Header & Navigation Menu-->
    <?php
        $url = parse_url($_SERVER['REQUEST_URI']);
        $genre = isset($_GET['genre']) ? $_GET['genre'] : ''; // Check if 'genre' is set, if not, set it to an empty string
        $shade = basename($url['path']);
        include_once 'inc/header.inc';
        include_once 'inc/menu.inc';

        // For database connection
        require_once "settings.php";
        $conn=@mysqli_connect ($host, $user, $pwd, $sql_db);

        $sql_table="books";
        $query = "SELECT * FROM $sql_table";
        $result = mysqli_query($conn, $query);

        $loggedIn = false;
        if(isset($_SESSION["userid"])) {
            $loggedIn = true;
        }
    ?>
    
    <div class = "checkoutContainer">
        <!-- Order Summary -->
        <div class = "checkoutSubcontainer">
            <?php
                $totalTax = 0;
                $emptyCart = false;

                if(isset($_SESSION['cart'])) {
                    $count = 0;
                    $total = 0.0;
                    
                    foreach ($_SESSION["cart"] as $index => $item) {
                        $book_id = $item['book_id'];
                        $query = "SELECT * FROM $sql_table WHERE book_id LIKE '$book_id'";
                        $result = mysqli_query($conn, $query);
        
                        if($conn && $result) {
                            if($row = mysqli_fetch_assoc($result)) {
                                if($count == 0) {
                                    echo <<<EOD
                                        <div class = "cartForm">
                                        <h1 class = "cartHeader">1. Order Summary ($totalQty items)</h1>
EOD;
                                    }
        
                                // Extract data for each book
                                $id = $row['book_id'];
                                $img = $row['image']; 
                                $title = $row['title']; 
                                $author = $row['author'];
                                $price = $row['price']; 
                                $format = $row['format'];
                                $qty = $item['qty'];
        
                                //Calculate indv total and subtotal price
                                $indvTotal = ((float)$row['price']*(int)$item['qty']);
                                $indvTotal = number_format($indvTotal, 2);
                                $total += $indvTotal;
                                $total = number_format($total, 2);
        
                                //Stock status
                                if ($row['stock']>0){
                                    $stockIndicator = "instock";
                                    $stockTxt="In Stock";
                                }
                                else{
                                    $stockIndicator = "outstock";
                                    $stockTxt="Out of Stock";
                                }
                                
                                // Display book
                                echo <<<EOD
                                    <form action="payment.php?action=remove&id=$book_id" method="post">
                                        <div class = "cartItem">
                                            <div class = "coverContainer">
                                                <img src = '$img' class = "cover" onclick = displayBook($book_id)></img>
                                            </div>
                                            <div class = "bookDetails">
                                                <div class = "detailsContainer">
                                                    <p class = "title" onclick = displayBook($book_id)>$title</p>
                                                    <p class = "bookPrice">RM$indvTotal</p>
                                                </div>
                                                <p class = "author">by $author</p>
                                                <p class = "price">RM $price</p>
                                                <p class = "format">$format</p>
                                                <p class="$stockIndicator" ><i class="bi bi-circle-fill"></i> <span class="stockTxt">$stockTxt</span></p>
                                                <div class="quanContainer">
                                                    <button type="button" id = "decrement" class="decrementButton" onclick = "decrementFunc($book_id)">—</button>
                                                    <input type="text" name="Quantity" value="$qty" class="quanInput" id = "quantity_$book_id" readonly>  
                                                    <button type="button" id = "increment" class="incrementButton" onclick = "incrementFunc($book_id)">+</button>
                                                </div>
                                                <button type = "submit" class = "deleteBtn" name = "remove"><i class="bi bi-trash"></i>&nbsp;Delete</button>
                                            </div>
                                        </div>
                                    </form>
EOD;
                                $count++;
                            }
                        }
                    }
                    
                    if($count == 0) {
                        $emptyCart = true;
                    }
                    else {
                        echo "</div>";
                    }
                }
        
                if($emptyCart || !isset($_SESSION["cart"])) {
                    echo "<script>window.location.href = 'cart.php';</script>";
                }
            ?>
        </div>

        <?php
            if(!$loggedIn) {
                echo <<<EOD
            <!-- Shipment Form -->
            <div class = "checkoutSubcontainer">
                <form action = "payment_posting.php" method = "post" name="paymentForm" class = "paymentForm" novalidate onsubmit = "return validate()">
                    <h1 class = "cartHeader">2. Shipment Details</h1>
                    <div class = "shipmentFields">
                        <p>
                            <label for = "fname">First Name<span class="required">*</span></label><br>
                            <input type = "text" name = "fname" id = "fname" pattern = "[a-zA-Z]{2,25}" placeholder = "John" required>
                            <span id = "errFname" class = "errMsg"></span>
                        </p>
                        
                        <p>
                            <label for = "lname">Last Name<span class="required">*</span></label><br>
                            <input type = "text" name = "lname" id = "lname" pattern = "[a-zA-Z]{2,25}" placeholder = "Doe" required>
                            <span id = "errLname" class = "errMsg"></span>
                        </p>
                        <p>
                            <label for = "email">Email<span class="required">*</span></label><br>
                            <input type = "email" name = "email" id = "email" placeholder = "johndoe123@example.com" required>
                            <span id = "errEmail" class = "errMsg"></span>
                        </p>
    
                        <p>
                            <label for = "phoneNumber">Phone Number<span class="required">*</span></label><br>
                            <input type = "text" name = "phoneNumber" id = "phoneNumber" pattern = "\d{8,10}" placeholder = "0123456789" required>
                            <span id = "errPhoneNum" class = "errMsg"></span>
                        </p>
                    
                        <p>
                            <label for = "shipmentAddress">Shipment Address<span class="required">*</span></label><br>
                            <textarea name = "shipmentAddress" id = "shipmentAddress" pattern = ".{5,40}" placeholder = "No. 3, Jalan SS15/8" required></textarea>
                            <span id = "errAddr" class = "errMsg"></span>
                        </p>
                        
                        <p>
                            <label for = "city">City<span class="required">*</span></label><br>
                            <input type = "text" name = "city" id = "city" pattern = "[a-zA-Z ]{2,20}" placeholder = "Subang Jaya" required>
                            <span id = "errCity" class = "errMsg"></span>
                        </p>
                        <p><label for = "state">State<span class="required">*</span></label><br>
                            <select name = "state" id = "state" required>
                                <option value = "">Please Select</option>
                                <option value = "Johor">Johor</option>
                                <option value = "Kedah">Kedah</option>
                                <option value = "Kelantan">Kelantan</option>
                                <option value = "Malacca">Malacca</option>
                                <option value = "Negeri Sembilan">Negeri Sembilan</option>
                                <option value = "Pahang">Pahang</option>
                                <option value = "Penang">Penang</option>
                                <option value = "Perlis">Perlis</option>
                                <option value = "Sabah">Sabah</option>
                                <option value = "Sarawak">Sarawak</option>
                                <option value = "Selangor">Selangor</option>
                                <option value = "Terengganu">Terengganu</option>
                            </select>
                        </p>
                        <p>
                            <span id = "errState" class = "errMsg"></span>
                        </p>
                        <p>
                            <label for = "postCode">Postcode<span class="required">*</span></label><br>
                            <input type = "text" name = "postCode" id = "postCode" pattern = "[0-9]{4,4}" placeholder = "47500" required>
                            <span id = "errPostcode" class = "errMsg"></span>
                        </p>
                        <span class = "requiredText"><i><span class="required">*</span> indicates REQUIRED</i><br></span>
                    </div>
            </div>
    
            <!-- Payment Form -->
            <div id = "paymentSub" class = "checkoutSubcontainer">
                    <h1 class = "cartHeader">3. Payment Details</h1>
                    <div class = "paymentFields">
                        <p class = "unofficialLabel">Credit Card Type<span class="required">*</span></p>
                        <section id = "ccTypeSect">
                            <section class = "ccSub" id = "visaContainer">
                                <input type="radio" name="ccType" id="visa" value="Visa"></input> <!-- -->
                                <label for="visa" id = "visaLabel" class = "ccType"><img class = "ccIcon" src = "images/visa.png" alt = "Visa Credit Card Icon"><p>Visa</p></label>
                            </section>
                            
                            <section class = "ccSub" id = "mcContainer">
                                <input type="radio" name="ccType" id="mastercard" value="Mastercard">
                                <label for="mastercard" class = "ccType"><img class = "ccIcon" src = "images/mastercard.png" alt = "Mastercard Card Icon"><p>Mastercard</p></label>
                            </section>
                            
                            <section class = "ccSub" id = "amexContainer">
                                <input type="radio" name="ccType" id="amex" value="American Express">
                                <label for="amex" class = "ccType"><img class = "ccIcon" src = "images/american-express.png" alt = "American Express Credit Card Icon"><p id = "amexOpt">AmEx</p></label>
                            </section>
                        </section>
                        <p>
                            <span id = "errCCType" class = "errMsg"></span>
                        </p>
    
                        <p>
                            <label for = "ccName">Name on Credit Card<span class="required">*</span></label><br>
                            <input type = "text" name = "ccName" id = "ccName" placeholder="John Doe" pattern="[a-zA-Z ]{2,40}" required><br>
                            <span id = "errCCName" class = "errMsg"></span>
                        </p>
                        <p>
                            <label for = "ccNum">Credit Card Number<span class="required">*</span></label><br>
                            <input type = "text" name = "ccNum" id = "ccNum" placeholder="1111222233334444" pattern="\d{15,16}" required><br>
                            <span id = "errCCNum" class = "errMsg"></span>
                        </p>
                        <p>
                            <label for="expDate">Credit Card Expiry Date<span class="required">*</span></label><br>
                            <input type="text" id="expDate" name="expDate" placeholder="MM-YY" pattern="\d{2}-\d{2}" required><br>
                            <span id = "errExpDate" class = "errMsg"></span>
                        </p>
                        <p>
                            <label for = "cvv">Card Verification Value (CVV)<span class="required">*</span></label><br>
                            <input type = "text" name = "cvv" id = "cvv" placeholder="123" pattern="\d{3,4}" required><br>
                            <span id = "errCVV" class = "errMsg"></span>
                        </p>
                        <span class = "requiredText"><i><span class="required">*</span> indicates REQUIRED</i><br></span>
                    </div>
EOD;
            }
        else if($loggedIn) {
            $query = "SELECT * FROM users WHERE userID LIKE '$_SESSION[userid]'";
            $result = mysqli_query($conn, $query);

            if($result) {
                if($row = mysqli_fetch_assoc($result)) {
                    $fname = $row['firstName']; 
                    $lname = $row['lastName']; 
                    $email = $row['email'];
                    $phone = $row['phone']; 
                    $address = $row['address'];
                    $city = $row['city'];
                    $state = $row['state'];
                    $postcode = $row['postcode'];
                    $ccNum = $row['cardNo'];
                    $expDate = $row['expiry'];
                    $cvv = $row['cvv'];
                    $ccType = $row['ccType'];
                    $ccName = $row['ccName'];
                    
                    $checkedVisa = "";
                    $checkedMC = "";
                    $checkedAmEx = "";

                    if($ccType == "Visa") {
                        $checkedVisa = "checked";
                    }
                    else if($ccType == "Mastercard") {
                        $checkedMC = "checked";
                    }
                    else if($ccType == "American Express") {
                        $checkedAmEx = "checked";
                    }

                    $johorSelect = ($state == 'Johor') ? 'selected' : '';
                    $kedahSelect = ($state == 'Kedah') ? 'selected' : '';
                    $kelantanSelect = ($state == 'Kelantan') ? 'selected' : '';
                    $malaccaSelect = ($state == 'Malacca') ? 'selected' : '';
                    $negeriSembilanSelect = ($state == 'Negeri Sembilan') ? 'selected' : '';
                    $pahangSelect = ($state == 'Pahang') ? 'selected' : '';
                    $penangSelect = ($state == 'Penang') ? 'selected' : '';
                    $perlisSelect = ($state == 'Perlis') ? 'selected' : '';
                    $sabahSelect = ($state == 'Sabah') ? 'selected' : '';
                    $sarawakSelect = ($state == 'Sarawak') ? 'selected' : '';
                    $selangorSelect = ($state == 'Selangor') ? 'selected' : '';
                    $terengganuSelect = ($state == 'Terengganu') ? 'selected' : '';

            echo <<<EOD
            <!-- Shipment Form -->
            <div class = "checkoutSubcontainer">
                <form action = "payment_posting.php" method = "post" name="paymentForm" class = "paymentForm" novalidate onsubmit = "return validate()">
                    <h1 class = "cartHeader">2. Shipment Details</h1>
                    <div class = "shipmentFields">
                        <p>
                            <label for = "fname">First Name<span class="required">*</span></label><br>
                            <input type = "text" name = "fname" id = "fname" pattern = "[a-zA-Z]{2,25}" placeholder = "John" value = "$fname" readonly required>
                            <span id = "errFname" class = "errMsg"></span>
                        </p>
                        
                        <p>
                            <label for = "lname">Last Name<span class="required">*</span></label><br>
                            <input type = "text" name = "lname" id = "lname" pattern = "[a-zA-Z]{2,25}" placeholder = "Doe" value = "$lname" readonly required>
                            <span id = "errLname" class = "errMsg"></span>
                        </p>
                        <p>
                            <label for = "email">Email<span class="required">*</span></label><br>
                            <input type = "email" name = "email" id = "email" placeholder = "johndoe123@example.com" value = "$email" readonly required>
                            <span id = "errEmail" class = "errMsg"></span>
                        </p>
    
                        <p>
                            <label for = "phoneNumber">Phone Number<span class="required">*</span></label><br>
                            <input type = "text" name = "phoneNumber" id = "phoneNumber" pattern = "\d{8,10}" placeholder = "0123456789" value = "$phone" readonly required>
                            <span id = "errPhoneNum" class = "errMsg"></span>
                        </p>
                    
                        <p>
                            <label for = "shipmentAddress">Shipment Address<span class="required">*</span></label><br>
                            <textarea name = "shipmentAddress" id = "shipmentAddress" pattern = ".{5,40}" placeholder = "No. 3, Jalan SS15/8" required>$address</textarea>
                            <span id = "errAddr" class = "errMsg"></span>
                        </p>
                        
                        <p>
                            <label for = "city">City<span class="required">*</span></label><br>
                            <input type = "text" name = "city" id = "city" pattern = "[a-zA-Z ]{2,20}" placeholder = "Subang Jaya" value = "$city" required>
                            <span id = "errCity" class = "errMsg"></span>
                        </p>
                        <p><label for = "state">State<span class="required">*</span></label><br>
                            <select name = "state" id = "state" required>
                                <option value = "">Please Select</option>
                                <option value = "Johor" $johorSelect>Johor</option>
                                <option value = "Kedah" $kedahSelect>Kedah</option>
                                <option value = "Kelantan" $kelantanSelect>Kelantan</option>
                                <option value = "Malacca" $malaccaSelect>Malacca</option>
                                <option value = "Negeri Sembilan" $negeriSembilanSelect>Negeri Sembilan</option>
                                <option value = "Pahang" $pahangSelect>Pahang</option>
                                <option value = "Penang" $penangSelect>Penang</option>
                                <option value = "Perlis" $perlisSelect>Perlis</option>
                                <option value = "Sabah" $sabahSelect>Sabah</option>
                                <option value = "Sarawak" $sarawakSelect>Sarawak</option>
                                <option value = "Selangor" $selangorSelect>Selangor</option>
                                <option value = "Terengganu" $terengganuSelect>Terengganu</option>
                            </select>
                        </p>
                        <p>
                            <span id = "errState" class = "errMsg"></span>
                        </p>
                        <p>
                            <label for = "postCode">Postcode<span class="required">*</span></label><br>
                            <input type = "text" name = "postCode" id = "postCode" pattern = "[0-9]{4,4}" placeholder = "47500" value = "$postcode" required>
                            <span id = "errPostcode" class = "errMsg"></span>
                        </p>
                        <span class = "requiredText"><i><span class="required">*</span> indicates REQUIRED</i><br></span>
                    </div>
            </div>
    
            <!-- Payment Form -->
            <div id = "paymentSub" class = "checkoutSubcontainer">
                    <h1 class = "cartHeader">3. Payment Details</h1>
                    <div class = "paymentFields">
                        <p class = "unofficialLabel">Credit Card Type<span class="required">*</span></p>
                        <section id = "ccTypeSect">
                            <section class = "ccSub" id = "visaContainer">
                                <input type="radio" name="ccType" id="visa" value="Visa" $checkedVisa></input> <!-- -->
                                <label for="visa" id = "visaLabel" class = "ccType"><img class = "ccIcon" src = "images/visa.png" alt = "Visa Credit Card Icon"><p>Visa</p></label>
                            </section>
                            
                            <section class = "ccSub" id = "mcContainer">
                                <input type="radio" name="ccType" id="mastercard" value="Mastercard" $checkedMC>
                                <label for="mastercard" class = "ccType"><img class = "ccIcon" src = "images/mastercard.png" alt = "Mastercard Card Icon"><p>Mastercard</p></label>
                            </section>
                            
                            <section class = "ccSub" id = "amexContainer">
                                <input type="radio" name="ccType" id="amex" value="American Express" $checkedAmEx>
                                <label for="amex" class = "ccType"><img class = "ccIcon" src = "images/american-express.png" alt = "American Express Credit Card Icon"><p id = "amexOpt">AmEx</p></label>
                            </section>
                        </section>
                        <p>
                            <span id = "errCCType" class = "errMsg"></span>
                        </p>
    
                        <p>
                            <label for = "ccName">Name on Credit Card<span class="required">*</span></label><br>
                            <input type = "text" name = "ccName" id = "ccName" placeholder="John Doe" pattern="[a-zA-Z ]{2,40}" value = "$ccName"required><br>
                            <span id = "errCCName" class = "errMsg"></span>
                        </p>
                        <p>
                            <label for = "ccNum">Credit Card Number<span class="required">*</span></label><br>
                            <input type = "text" name = "ccNum" id = "ccNum" placeholder="1111222233334444" pattern="\d{15,16}" value = "$ccNum" required><br>
                            <span id = "errCCNum" class = "errMsg"></span>
                        </p>
                        <p>
                            <label for="expDate">Credit Card Expiry Date<span class="required">*</span></label><br>
                            <input type="text" id="expDate" name="expDate" placeholder="MM-YY" pattern="\d{2}-\d{2}" value = "$expDate" required><br>
                            <span id = "errExpDate" class = "errMsg"></span>
                        </p>
                        <p>
                            <label for = "cvv">Card Verification Value (CVV)<span class="required">*</span></label><br>
                            <input type = "text" name = "cvv" id = "cvv" placeholder="123" pattern="\d{3,4}" value = "$cvv" required><br>
                            <span id = "errCVV" class = "errMsg"></span>
                        </p>
                        <span class = "requiredText"><i><span class="required">*</span> indicates REQUIRED</i><br></span>
                    </div>
EOD;
                }
            }

        }

        ?>

                <div class = "summaryContainer">
                    <?php
                        if(isset($_SESSION["cart"])) {
                            echo "<h1 class = 'cartHeader'>Order Summary</h1><br>";
                            foreach ($_SESSION["cart"] as $index => $item) {
                                $book_id = $item['book_id'];
                                $query = "SELECT * FROM $sql_table WHERE book_id LIKE '$book_id'";
                                $result = mysqli_query($conn, $query);
                                
                                $price = 0;

                                if($result) {
                                    if($row = mysqli_fetch_assoc($result)) { 
                                        $price = $row['price']; 
                                        $qty = $item['qty'];
        
                                        //Calculate indv total and subtotal price
                                        $indvTotal = ((float)$price*(int)$item['qty']);
                                        $indvTotal = number_format($indvTotal, 2);

                                        echo "<div class = 'indvItemContainer'><span class = 'indvItem'>".$_SESSION['cart'][$index]["qty"]." x ".$row['title']."</span><span class = 'indvPrice'>RM".$indvTotal."</span><br></div>";
                                    }
                                }
                            }

                            echo "<hr class = 'divider'>";
                            echo "<div class = 'indvItemContainer' id = 'subtotalVal'><span class = 'indvItem'>Subtotal</span><span class = 'indvPrice'>RM$total</span></div>";
                            echo "<div class = 'indvItemContainer' id = 'shippingFee'><span class = 'indvItem'>Shipping within Malaysia</span><span class = 'indvPrice'>FREE</span></div>";

                            $salesTax = number_format(0.06*$total, 2);
                            $totalTax = number_format($salesTax + $total, 2);

                            echo "<div class = 'indvItemContainer'><span class = 'indvItem'>Sales Tax (6%)</span><span class = 'indvPrice'>RM$salesTax</span></div>";
                            echo "<div class = 'indvItemContainer' id = 'orderTotal'><span class = 'indvItem'>ORDER TOTAL</span><span class = 'indvPrice'>RM$totalTax</span></div>";

                            echo "<input type = 'hidden' name = 'totalB4Tax' value = '$total'</input>";
                            echo "<input type = 'hidden' name = 'salesTax' value = '$salesTax'</input>";
                            echo "<input type = 'hidden' name = 'totalPrice' value = '$totalTax'</input>";
                        }
                    ?>
                </div>
                <br>
                <button type = "submit" class = "submitOrderBtn">COMPLETE ORDER</button>
            </form>
        </div>
    </div>
    
    <?php
        //increase & decrease cart item qty
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // update qty in cart session variable from ajax request
            function updateQty() {
                $data = json_decode(file_get_contents("php://input"));

                if ($data !== null) { 
                    $book_id = $data->book_id;
                    $qty = $data->qty;

                    if(isset($_SESSION["cart"])) {
                        foreach ($_SESSION["cart"] as $index => $item) { 
                            if($book_id == $item["book_id"]) {
                                $_SESSION['cart'][$index]["qty"] = $qty;
                                break;
                            }
                        }
                    }
                }
            }
            // call php func on button click
            updateQty();
        }

        //delete from cart
        if(isset($_POST["remove"])) {
            if ($_GET['action'] == 'remove'){
                foreach ($_SESSION['cart'] as $index => $item){
                    if($item["book_id"] == $_GET['id']){
                        unset($_SESSION['cart'][$index]);
                        echo "<script>location.reload();</script>";
                    }
                }
            }
        }
    ?>

    <?php
        // close the database connection
        mysqli_close ($conn) ;

        // Footer
        include_once 'inc/footer.inc';
    ?>
</body>
</html>
