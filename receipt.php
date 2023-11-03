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
    <link href = "styles/receipt.css" rel="stylesheet">


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

        
       if(!isset($_SESSION["fname"])) {
            header("index.php");
        }
    ?>
    
    <div class = "receiptContainer">
        <div class = "paymentContainer">
            <h1 class = "thanksMsg">Thank you for your purchase!</h1>
            <?php
                echo "<h3 class = 'greetings'>Hi $_SESSION[fname] $_SESSION[lname], here's your receipt!</h3>";
                echo "<hr class = 'divider'>";
                $formattedDateTime = date('Y-m-d H:i', strtotime($_SESSION["create_at"]));
                $ccNum = substr($_SESSION["p_cardNo"], -4);
                echo <<<EOD
                <div class = "paySubcontainer">
                    <h1 class = 'itemsHeader'>Order Details</h1>
                </div>
                <div class = "paySubcontainer">
                    <div class = "paymentDetails">
                        <div class="labels">
                            <p class="orderNum">Order Number</p>
                            <p>Date/Time</p>
                            <p>Order Status</p>
                            <p>Payment Method</p>
                            <p>Shipping To</p>
                        </div>
                    
                        <div class="details">
                            <p>#$_SESSION[salesID]</p>
                            <p>$formattedDateTime</p>
                            <p>$_SESSION[status]</p>
                            <p>$_SESSION[p_ccType] *$ccNum</p>
                            <p>
                                $_SESSION[p_address]<br>
                                $_SESSION[p_postcode] $_SESSION[p_city]<br>
                                $_SESSION[p_state]<br>
                                $_SESSION[p_country]
                            </p>
                        </div>
                    </div>
                </div>
EOD;
            ?>
        </div>
        <div>
            <?php
                echo "<h1 class = 'itemsHeader'>Items</h1>";
                foreach ($_SESSION["orderDetails"] as $item) {
                    $book_id = $item['book_id'];
                    $qty = $item['qty'];
                    $price = number_format($item['price'], 2);
                    
                    $query = "SELECT * FROM books WHERE book_id LIKE '$book_id'";
                    $result = mysqli_query($conn, $query);


                    if($conn && $result) {
                        if($row = mysqli_fetch_assoc($result)) {
                            $title = $row['title']; 
                            $img = $row['image']; 
                            $author = $row['author'];
                            $format = $row['format'];

                            $indvTotal = ((float)$row['price']*(int)$qty);
                            $indvTotal = number_format($indvTotal, 2);

                            echo <<<EOD
                            <div class = "orderItem">
                                <div class = "coverContainer">
                                    <img src = '$img' class = "cover" onclick = displayBook($book_id)></img>
                                </div>
                                <div class = "bookDetails">
                                    <div class = "detailsContainer">
                                        <p class = "title" onclick = displayBook($book_id)>$title</p>
                                        <p class = "bookPrice">RM$indvTotal</p>
                                    </div>
                                    <p class = "qty">x $qty</p>
                                    <p class = "author">by $author</p>
                                    <p class = "price">RM $price</p>
                                    <p class = "format">$format</p>
                                </div>
                            </div>
EOD;
                        }
                    }
                }

                $totalPrice = number_format($_SESSION["totalPrice"], 2);

                echo <<<EOD
                    <hr class = "divider2">
                    <div class = "priceContainer">
                        <div class = "priceLabels">
                            <p>Subtotal<p>
                            <p>Sales Tax (6%)<p>
                        </div>
                        <div class = "priceVal">
                            <p>RM$_SESSION[totalB4Tax]<p>
                            <p>RM$_SESSION[salesTax]<p>
                        </div>
                    </div>
                    <hr class = "divider3">
                    <div class = "priceContainer">
                        <div class = "priceLabels" id = "totalLabel">
                            <p>Total</p>
                        </div>
                        <div class = "priceVal" id = "totalVal">
                            <p>RM$totalPrice</p>
                        </div>
                    </div>
EOD;                
            ?>
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
