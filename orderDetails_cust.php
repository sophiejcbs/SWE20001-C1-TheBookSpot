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
    <link href = "styles/order_details.css" rel="stylesheet">
    <link href = "styles/orderDetails_resp.css" rel="stylesheet" media ="screen and (max-width:1024px)"/>

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

        if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
            //in session
        }
        else {
            //no session id
            header("location: index.php");
            exit();
        }

        // For database connection
        require_once "settings.php";
        $conn=@mysqli_connect ($host, $user, $pwd, $sql_db);

        $sales_id = $_GET['sales_id'];
        $guest = false;

        $sql_table="sales";
        $query = "SELECT * FROM $sql_table S
                  INNER JOIN orders O ON
                  S.sales_id = O.sales_id
                  WHERE S.sales_id = $sales_id";
        $result = mysqli_query($conn, $query);

        if($result) {
            while($row = mysqli_fetch_assoc($result)) {
                $total_price = $row['total_price']; 
                $status = $row['status']; 
                $create_at = $row['create_at'];
                $user_id = $row['user_id'];
                $guest_id = $row['guest_id'];
                $address = $row['address']; 
                $city = $row['city']; 
                $state = $row['state']; 
                $postcode = $row['postcode']; 
                $country = $row['country'];
                $ccName = $row['ccName']; 
                $ccType = $row['ccType']; 
                $cardNo = $row['cardNo']; 
                $expiry = $row['expiry']; 
                $cvv = $row['cvv']; 

                $book_id = $row['book_id']; 
                $qty = $row['quantity']; 
                $price = $row['price']; 

                $bookDetails = array(
                    'book_id' => $book_id,
                    'qty' => $qty,
                    'price' => $price
                );
            
                // Push the book details array into the main array
                $bookDetailsArr[] = $bookDetails;
            }

            if($user_id == -1) {
                $guest = true;
                $sql_table="guests";
                $query = "SELECT * FROM $sql_table WHERE guestID = $guest_id";
                $result = mysqli_query($conn, $query);

                if($result) {
                    if($row = mysqli_fetch_assoc($result)) {
                        $firstName = $row["firstName"];
                        $lastName = $row["lastName"];
                        $email = $row["email"];
                        $phone = $row["phone"];
                    }
                }
            }
            else if($guest_id == -1) {
                $sql_table="users";
                $query = "SELECT * FROM $sql_table WHERE userID = $user_id";
                $result = mysqli_query($conn, $query);

                if($result) {
                    if($row = mysqli_fetch_assoc($result)) {
                        $firstName = $row["firstName"];
                        $lastName = $row["lastName"];
                        $email = $row["email"];
                        $phone = $row["phone"];
                    }
                }
            }
        }
        else if(!$result) 
        {
            echo "<p>Something is wrong with ", $query, "</p>";
        } 
    ?>
    <?php
        $color = "";
        $bg = "";
        if (strtolower($status) == "pending") {
            $color = "#3498DB"; // Light blue
            $bg = "#E5F2FD"; 
        } elseif (strtolower($status) == "fulfilled") {
            $color = "#27AE60"; // Green
            $bg = "#D6EFBF"; 
        } elseif (strtolower($status) == "archived") {
            $color = "#95A5A6"; // Gray
            $bg = "#F1F3F3"; 
        }

        $formattedDateTime = date('Y-m-d H:i', strtotime($create_at));
        echo <<<EOD
        <h4 class = "dateTime">$formattedDateTime</h4>
        <div class = "orderHeader"><h1 class = "orderNum">Order #$sales_id</h1><h3 class = "status" style="color: $color; background-color: $bg;">$status</h3></div>
        <!-- <div class = "orderSubHeader"><h3>Order Details</h3><h3 >Customer Details</h3></div> -->
EOD;
        echo "<div class = 'orderDetContainer'>";
            echo "<div class = 'orderSummaryContainer'>";
                echo "<div class=\"table-responsive\" id = 'orderDetTable'>";
                    echo "<table id=\"orderTable\" class=\"table table-bordered table-hover\">";
                        echo "<thead class=\"table-dark\">";
                        echo "<tr>\n"
                            ."<th><div class=\"column-width\"></div>Book #</th>\n"
                            ."<th><div class=\"column-width\">Title</div></th>\n"
                            ."<th><div class=\"column-width\">Cover</div></th>\n"
                            ."<th><div class=\"column-width\">Quantity</div></th>\n"
                            ."<th><div class=\"column-width\">Price (RM)</div></th>\n"
                            ."<th><div class=\"column-width\">Total (RM)</div></th>\n"
                            ."</tr>\n";
                        echo "</thead>";

                        $totalB4Tax = 0;
                        $totalQty = 0;

                        foreach ($bookDetailsArr as $item) {
                            $book_id = $item['book_id'];
                            $qty = $item['qty'];
                            $price = number_format($item['price'], 2);

                            $indvTotal = ((float)$item['price']*(int)$qty);
                            $indvTotal = number_format($indvTotal, 2);

                            $totalQty += $qty;

                            $totalB4Tax += $indvTotal;
                            $totalB4Tax = number_format($totalB4Tax, 2);

                            $query = "SELECT * FROM books WHERE book_id LIKE '$book_id'";
                            $result = mysqli_query($conn, $query);

                            if($result) {
                                if($row = mysqli_fetch_assoc($result)) {
                                    $title = $row['title']; 
                                    $img = $row['image']; 
                                }
                            }

                            echo "<tbody class=\"table-group-divider\">";
                            echo "<tr>";
                            echo "<td>", $book_id,"</td>";  
                            echo "<td>", $title, "</td>";  
                            echo "<td><img src='", $img, "'alt='Book Cover' width=100></td>";
                            echo "<td>", $qty, "</td>";
                            echo "<td>", $price, "</td>";
                            echo "<td>", $indvTotal, "</td>";
                            echo "</tr>";
                            echo "</tbody>";
                        }

                    echo "</table></div>";

                    $salesTax = number_format(0.06*$totalB4Tax, 2);
                    $total_price = number_format($total_price, 2);
                    $ccNum = substr($cardNo, -4);

                    echo <<<EOD
                    <h3 class = "subHeader">Paid by Customer</h1>
                    <div class = "paySubcontainer">
                        <div class = "paymentDetails">
                            <div class="labels">
                                <p>Subtotal ($totalQty items)</p>
                                <p>Sales Tax (6%)</p>
                                <p>TOTAL</p>
                            </div>
                        
                            <div class="details">
                                <p>RM$totalB4Tax</p>
                                <p>RM$salesTax</p>
                                <p>RM$total_price</p>
                            </div>
                        </div>
                    </div>
EOD;
            echo "</div>";

            $idLabel = "User ID";
            if($guest) {
                $idLabel = "Guest ID";
                $user_id = $guest_id;
            }

            echo <<<EOD
            <div class = "custDetContainer">
                <p class = "label">First Name<p>
                <span>$firstName</span>
                <p class = "label">Last Name<p>
                <span>$lastName</span>
                <p class = "label">Email Address<p>
                <span>$email</span>
                <p class = "label">Phone Number<p>
                <span>$phone</span>
                <p class = "label">Shipment Address<p>
                <span>$address<br>
                $postcode $city<br>
                $state<br>
                $country</span>
                <p class = "label">Payment Method<p>
                <span>$ccType *$ccNum</span>
            </div>
EOD;
        echo "</div>";

    ?>

    <?php
        // close the database connection
        mysqli_close ($conn) ;

        // Footer
        include_once 'inc/footer.inc';
    ?>
</body>
</html>
