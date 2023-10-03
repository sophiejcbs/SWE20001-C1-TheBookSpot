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
    <link href = "styles/cart.css" rel="stylesheet"/>
    <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)"/>

    <!-- Javascript -->
    <script src="scripts/cart.js"></script>

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

        function displayBooks ($conn, $query){
            $result = mysqli_query($conn, $query);

            // Counter variable to limit the number of displayed results
            $counter = 0;
            if ($conn){
                if($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Limit the display to the first 5 results
                        if ($counter >= 5) {
                            break;
                        }

                        // Extract data for each book
                        $id=$row['book_id'];
                        $imgSrc = $row['image']; 
                        $bookTitle = $row['title']; 
                        $price = $row['price']; 

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
                        <div class="bookCard">
                            <a href="book_details.php?book_id=$id">
                                <img src="$imgSrc">
                                <p class = "bookTitle">$bookTitle</p>
                            </a>
                            
                            <p class="price">RM$price</p>
                            <p class="$stockIndicator" ><i class="bi bi-circle-fill"></i> <span class="stockTxt">$stockTxt</span></p>
                        </div>
EOD;
                        // Increment the counter
                        $counter++;
                    }
                }
            }
        }

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
                            <div class = "cartContainer">
                                <form class = "cartForm" action="cart.php?action=remove&id=$book_id" method="post">
                                <h1 class = "cartHeader">Shopping Cart ($totalQty items)</h1>
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
            
            if($count != 0) {
                echo <<<EOD
                    </form>
                    <div class = "subtotalContainer">
                        <div class = "labelAmtContainer">
                            <p class = "subtotal">Subtotal</p><span class = "subtotal">RM$total</span>
                        </div>
                        <hr class = "divider">
                        <br>
                        <div class = "checkoutContainer">
                            <button class = "checkout" onclick = "checkout()">Checkout</button>
                        </div>
                    </div>
                </div>
EOD;                    
            } 
            else {
                $emptyCart = true;
            }
        }

        if($emptyCart || !isset($_SESSION["cart"])) {
            echo <<<EOD
            <h1 class = "emptyHeader">Your Cart is Empty</h1>
            <button class = "shopNow" onclick = "bookCatalogue()">Shop for Books Now</button>

            <h1 class="emptyReco">You may also like</h1>
            <div class="bookCatalogue">
EOD;
            $sql_table="books";
            $query = "SELECT * FROM $sql_table ORDER BY amt_sold DESC";
            displayBooks ($conn, $query);

            echo "</div>";
        }
    ?>

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