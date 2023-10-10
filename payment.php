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
        
        include_once 'inc/header.inc';
        include_once 'inc/menu.inc';

        // For database connection
        require_once "settings.php";
        $conn=@mysqli_connect ($host, $user, $pwd, $sql_db);

        $sql_table="books";
        $query = "SELECT * FROM $sql_table";
        $result = mysqli_query($conn, $query);

    ?>
    
    <div class = "checkoutContainer">
        <!-- Order Summary -->
        <div class = "checkoutSubcontainer">
            <?php
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
                                        <form class = "cartForm" action="cart.php?action=remove&id=$book_id" method="post">
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
EOD;
                                $count++;
                            }
                        }
                    }
                    
                    if($count == 0) {
                        $emptyCart = true;
                    }
                    else {
                        echo "</form>";
                    }
                }
        
                if($emptyCart || !isset($_SESSION["cart"])) {
                    header("cart.php");
                }
            ?>
        </div>

        <!-- Shipment Form -->
        <div class = "checkoutSubcontainer">
            <form class = "shipmentForm">
                <h1 class = "cartHeader">2. Shipment Details</h1>
                <div class = "shipmentFields">
                    <p>
                        <label for = "fname">First name</label><br>
                        <input type = "text" name = "fname" id = "fname" pattern = "[a-zA-Z]{2,25}" required>
                    </p>
                    
                    <p>
                        <label for = "lname">Last name</label><br>
                        <input type = "text" name = "lname" id = "lname" pattern = "[a-zA-Z]{2,25}" required>
                    </p>
                    <p>
                        <label for = "email">Email</label><br>
                        <input type = "email" name = "email" id = "email" placeholder = "johndoe123@example.com" required>
                    </p>

                    <p>
                        <label for = "phoneNumber">Phone number</label><br>
                        <input type = "text" name = "phoneNumber" id = "phoneNumber" pattern = "\d{8,10}" placeholder = "0123456789" required>
                    </p>
                
                    <p>
                        <label for = "shipmentAddress">Shipment address</label><br>
                        <input type = "text" name = "shipmentAddress" id = "shipmentAddress" pattern = ".{5,40}" required>
                    </p>
                    
                    <p>
                        <label for = "city">City</label><br>
                        <input type = "text" name = "city" id = "city" pattern = "[a-zA-Z ]{2,20}" required>
                    </p>
                    <p><label for = "state">State</label><br>
                        <select name = "state" id = "state" required>
                            <option value = "">Please Select</option>
                            <option value = "VIC">VIC</option>
                            <option value = "NSW">NSW</option>
                            <option value = "QLD">QLD</option>
                            <option value = "NT">NT</option>
                            <option value = "WA">WA</option>
                            <option value = "SA">SA</option>
                            <option value = "TAS">TAS</option>
                            <option value = "ACT">ACT</option>
                        </select>
                    </p>
                    <p>
                        <label for = "postCode">Postcode</label><br>
                        <input type = "text" name = "postCode" id = "postCode" pattern = "[0-9]{4,4}" required>
                    </p>
                </div>
            </form>
        </div>

        <!-- Payment Form -->
        <div class = "checkoutSubcontainer">
            <form class = "paymentForm">
                <div class = "paymentFields">
                    <section id = "ccTypeSect">
                        <section class = "ccSub">
                            <input type="radio" name="ccType" id="visa" value="Visa"></input> <!-- -->
                            <label for="visa" class = "ccType"><img class = "ccIcon" src = "images/visa.png" alt = "Visa Credit Card Icon"><p>Visa</p></label>
                        </section>
                        
                        <section class = "ccSub">
                            <input type="radio" name="ccType" id="mastercard" value="Mastercard">
                            <label for="mastercard" class = "ccType"><img class = "ccIcon" src = "images/mastercard.png" alt = "Mastercard Card Icon"><p>Mastercard</p></label>
                        </section>
                        
                        <section class = "ccSub">
                            <input type="radio" name="ccType" id="amex" value="American Express">
                            <label for="amex" class = "ccType"><img class = "ccIcon" src = "images/american-express.png" alt = "American Express Credit Card Icon"><p id = "amexOpt">AmEx</p></label><br>
                        </section>
                    </section>
                        
                    <label for = "ccName">Name on Credit Card</label><br>
                    <input type = "text" name = "ccName" id = "ccName" placeholder="John Doe" pattern="[a-zA-Z ]{2,40}" required><br>

                    <label for = "ccNum">Credit Card Number</label><br>
                    <input type = "text" name = "ccNum" id = "ccNum" placeholder="1111222233334444" pattern="\d{15,16}" required><br>

                    <label for="expDate">Credit Card Expiry Date</label><br>
                    <input type="text" id="expDate" name="expDate" placeholder="MM-YY" pattern="\d{2}-\d{2}" required><br>

                    <label for = "cvv">Card Verification Value (CVV)</label><br>
                    <input type = "text" name = "cvv" id = "cvv" placeholder="123" pattern="\d{3,4}" required><br>
                </div>
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
