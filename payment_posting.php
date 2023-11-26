<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="UTF-8" />
    <meta name="description" content="The Book Spot" />
    <meta name="author" content="The Flying Fish" />
    <meta name="keywords" content="The Book Spot Book Management" />
    <title>Book Information Status | Administrator</title>

    <link rel="icon" type="image/x-icon" href="images\logo.png" />
    <!-- CSS -->
    <link href = "styles/addBook_ps.css" rel="stylesheet" />
    <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)" />
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
    
<?php
    $url = parse_url($_SERVER['REQUEST_URI']);
    $genre = isset($_GET['genre']) ? $_GET['genre'] : ''; // Check if 'genre' is set, if not, set it to an empty string
    $shade = basename($url['path']);
    include_once 'inc/header.inc';
    include_once 'inc/menu.inc';

    function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //shipment details
    if (isset($_POST["fname"])) $fname = $_POST["fname"];
    if (isset($_POST["lname"])) $lname = $_POST["lname"];
    if (isset($_POST["email"])) $email = $_POST["email"];
    if (isset($_POST["phoneNumber"])) $phoneNumber = $_POST["phoneNumber"];
    if (isset($_POST["shipmentAddress"])) $shipmentAddress = $_POST["shipmentAddress"];
    if (isset($_POST["city"])) $city = $_POST["city"];
    if (isset($_POST["state"])) $state = $_POST["state"];
    if (isset($_POST["postCode"])) $postCode = $_POST["postCode"];

    //payment details
    if (isset($_POST["ccType"])) $ccType = $_POST["ccType"];
    if (isset($_POST["ccName"])) $ccName = $_POST["ccName"];
    if (isset($_POST["ccNum"])) $ccNum = $_POST["ccNum"];
    if (isset($_POST["expDate"])) $expDate = $_POST["expDate"];
    if (isset($_POST["cvv"])) $cvv = $_POST["cvv"];
    
    if (isset($_POST["totalB4Tax"])) $totalB4Tax = $_POST["totalB4Tax"];
    if (isset($_POST["salesTax"])) $salesTax = $_POST["salesTax"];
    if (isset($_POST["totalPrice"])) $total_price = $_POST["totalPrice"];

    if (isset($_POST["saveDetails"])) $saveDetails = $_POST["saveDetails"];

    $fname = sanitise_input($fname);
    $lname = sanitise_input($lname);
    $email = sanitise_input($email);
    $phoneNumber = sanitise_input($phoneNumber);
    $shipmentAddress = sanitise_input($shipmentAddress);
    $city = sanitise_input($city);
    $state = sanitise_input($state);
    $postCode = sanitise_input($postCode);

    $ccType = sanitise_input($ccType);
    $ccName = sanitise_input($ccName);
    $ccNum = sanitise_input($ccNum);
    $expDate = sanitise_input($expDate);
    $cvv = sanitise_input($cvv);

    $totalB4Tax = sanitise_input($totalB4Tax);
    $salesTax = sanitise_input($salesTax);
    $total_price = sanitise_input($total_price);

    $saveDetails = sanitise_input($saveDetails);

    require_once ("settings.php"); //Connection Info
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

    $orderPlaced = true;

    $loggedIn = false;
    if(isset($_SESSION["userid"])) {
        $loggedIn = true;
    }
    
    if(!$conn) //Connection Failed
    {
        //Displays an error message
        echo "<p>Database conn failure</p>"; //Not in production script
    }
    else //Connection Successful
    {
        if(!$loggedIn) {
            $sql_table="guests";
            $fieldDefinition="`guestID` int(11) AUTO_INCREMENT PRIMARY KEY,
            `firstName` varchar(50) DEFAULT NULL,
            `lastName` varchar(50) DEFAULT NULL,
            `email` varchar(100) DEFAULT NULL,
            `phone` varchar(100) DEFAULT NULL,
            `address` varchar(100) DEFAULT NULL,
            `city` varchar(50) DEFAULT NULL,
            `state` varchar(50) DEFAULT NULL,
            `country` varchar(50) DEFAULT 'Malaysia',
            `postcode` varchar(10) DEFAULT NULL,
            `ccName` varchar(100) DEFAULT NULL,
            `cardNo` bigint(16) DEFAULT NULL,
            `expiry` varchar(10) DEFAULT NULL,
            `cvv` int(3) DEFAULT NULL,
            `ccType` VARCHAR(50) DEFAULT NULL";

            $query_G1 = "show tables like '$sql_table'";
            $result_G1 = @mysqli_query($conn, $query_G1);

            if(mysqli_num_rows($result_G1) == 0) {
                echo "<p>Table does not exist - creating table $sql_table ...</p>"; // Might not show in a production script 
                $query_G2 = "create table " . $sql_table . "(" . $fieldDefinition . ")";; 
                $result_G2 = @mysqli_query($conn, $query_G2);
                // checks if the table was created
                if($result_G2 === false) 
                {
                    echo "<p>Unable to create Table $sql_table.". mysqli_error($conn) . ":". mysqli_error($conn) ." </p>"; //Would not show in a production script 
                    $orderPlaced = false;
                } 
                else 
                {                
                    $query = "INSERT INTO $sql_table (firstName, lastName, email, phone, address, city, state, postcode, ccName, cardNo, expiry, cvv, ccType) 
                    VALUES ('$fname', '$name', '$email', '$phone', '$shipmentAddress', '$city', '$state', '$postCode', '$ccName', '$ccNum', '$expDate', '$cvv', '$ccType')";        

                    if(mysqli_query($conn, $query)) 
                    {
                        echo "Guest User Record stored successfully.";
                    }
                    else 
                    {
                        echo "<br>Error storing Guest User Record.";
                        $orderPlaced = false;
                    }
                } // if successful query operation
            }
            else
            {
                $query = "INSERT INTO $sql_table (firstName, lastName, email, phone, address, city, state, postcode, ccName, cardNo, expiry, cvv, ccType) 
                VALUES ('$fname', '$lname', '$email', '$phoneNumber', '$shipmentAddress', '$city', '$state', '$postCode', '$ccName', '$ccNum', '$expDate', '$cvv', '$ccType')";        

                if(mysqli_query($conn, $query)) 
                {
                    echo "<br>Guest User Record stored successfully.";
                    $extract_GuestID = mysqli_insert_id($conn);
                }
                else 
                {
                    echo "<br>Error storing Guest User Record.";
                    $orderPlaced = false;
                }
            }
        }

        else if($loggedIn && $saveDetails) {
            $sql_table="users";
            $fieldDefinition="`userID` int(11) NOT NULL,
            `username` varchar(50) NOT NULL,
            `pwd` varchar(255) DEFAULT NULL,
            `firstName` varchar(50) DEFAULT NULL,
            `lastName` varchar(50) DEFAULT NULL,
            `email` varchar(100) DEFAULT NULL,
            `phone` varchar(100) DEFAULT NULL,
            `address` varchar(100) DEFAULT NULL,
            `country` varchar(50) DEFAULT 'Malaysia',
            `city` varchar(50) DEFAULT NULL,
            `state` varchar(50) DEFAULT NULL,
            `postcode` varchar(10) DEFAULT NULL,
            `cardNo` bigint(16) DEFAULT NULL,
            `expiry` varchar(10) DEFAULT NULL,
            `cvv` int(3) DEFAULT NULL,
            `ccType` varchar(50) DEFAULT NULL,
            `ccName` varchar(100) DEFAULT NULL";

            $query_U1 = "show tables like '$sql_table'";
            $result_U1 = @mysqli_query($conn, $query_U1);

            if(mysqli_num_rows($result_U1) == 0) {
                echo "<p>Table does not exist - creating table $sql_table ...</p>"; // Might not show in a production script 
                $query_U2 = "create table " . $sql_table . "(" . $fieldDefinition . ")";; 
                $result_U2 = @mysqli_query($conn, $query_U2);
                // checks if the table was created
                if($result_U2 === false) 
                {
                    echo "<p>Unable to create Table $sql_table.". mysqli_error($conn) . ":". mysqli_error($conn) ." </p>"; //Would not show in a production script 
                    $orderPlaced = false;
                } 
                else 
                {                
                    $query = "UPDATE $sql_table
                    SET
                        address = '$shipmentAddress',
                        city = '$city',
                        state = '$state',
                        postcode = '$postCode',
                        ccName = '$ccName',
                        cardNo = '$ccNum',
                        expiry = '$expDate',
                        cvv = '$cvv',
                        ccType = '$ccType'
                    WHERE
                        userID = $_SESSION[userid];";        

                    if(mysqli_query($conn, $query)) 
                    {
                        echo "User Record stored successfully.";
                    }
                    else 
                    {
                        echo "<br>Error storing User Record.";
                        $orderPlaced = false;
                    }
                } // if successful query operation
            }
            else
            {
                $query = "UPDATE $sql_table
                    SET
                        address = '$shipmentAddress',
                        city = '$city',
                        state = '$state',
                        postcode = '$postCode',
                        ccName = '$ccName',
                        cardNo = '$ccNum',
                        expiry = '$expDate',
                        cvv = '$cvv',
                        ccType = '$ccType'
                    WHERE
                        userID = $_SESSION[userid];";        

                if(mysqli_query($conn, $query)) 
                {
                    echo "User Record stored successfully.";
                }
                else 
                {
                    echo "<br>Error storing User Record.";
                    $orderPlaced = false;
                }
            }
        }
        
        $sql_table="sales";
        $fieldDefinition="`sales_id` int(11) NOT NULL,
        `total_price` double DEFAULT NULL,
        `status` varchar(255) DEFAULT NULL,
        `create_at` datetime DEFAULT NULL,
        `user_id` int(11) DEFAULT NULL,
        `guest_id` int(11) DEFAULT NULL,
        `address` varchar(100) DEFAULT NULL,
        `city` varchar(50) DEFAULT NULL,
        `state` varchar(50) DEFAULT NULL,
        `country` varchar(50) DEFAULT 'Malaysia',
        `postcode` varchar(10) DEFAULT NULL,
        `ccName` varchar(100) DEFAULT NULL,
        `cardNo` bigint(16) DEFAULT NULL,
        `expiry` varchar(10) DEFAULT NULL,
        `cvv` int(3) DEFAULT NULL,
        `ccType` VARCHAR(50) DEFAULT NULL";

        //Check if table does not exist, create it
        $query_S1 = "show tables like '$sql_table'";  
        $result_S1 = @mysqli_query($conn, $query_S1);

        //Check if any tables of this name exist
        if(mysqli_num_rows($result_S1) == 0) 
        {
            echo "<p>Table does not exist - creating table $sql_table ...</p>"; // Might not show in a production script 
            $query2 = "create table " . $sql_table . "(" . $fieldDefinition . ")";; 
            $result2 = @mysqli_query($conn, $query2);
            // checks if the table was created
            if($result2 === false) 
            {
                echo "<p>Unable to create Table $sql_table.". mysqli_error($conn) . ":". mysqli_error($conn) ." </p>"; //Would not show in a production script 
                $orderPlaced = false;
            } 
            else 
            {                
                $guestID = -1;
                $userID = -1;

                if($loggedIn) {
                    $userID = $_SESSION["userid"];
                }
                else {
                    $guestID = $extract_GuestID;
                }

                $query = "INSERT INTO $sql_table 
                (total_price, status, user_id, guest_id, address, city, state, postcode, ccName, cardNo, expiry, cvv, ccType) 
                VALUES ('$total_price', 'PENDING', '$userID', '$guestID ', '$shipmentAddress', '$city', '$state', '$postCode', '$ccName', '$ccNum', '$expDate', '$cvv', '$ccType')";

                if(mysqli_query($conn, $query)) 
                {
                    echo "<br>Sales Record stored successfully.";
                }
                else 
                {
                    echo "<br>Error storing Sales Record.";
                    $orderPlaced = false;
                }
            } // if successful query operation
        }
        else
        {
            $guestID = -1;
            $userID = -1;

            if($loggedIn) {
                $userID = $_SESSION["userid"];
            }
            else {
                $guestID = $extract_GuestID;
            }

            $query = "INSERT INTO $sql_table 
            (total_price, status, user_id, guest_id, address, city, state, postcode, ccName, cardNo, expiry, cvv, ccType) 
            VALUES ('$total_price', 'PENDING', '$userID', '$guestID ', '$shipmentAddress', '$city', '$state', '$postCode', '$ccName', '$ccNum', '$expDate', '$cvv', '$ccType')";

            if(mysqli_query($conn, $query)) 
            {
                echo "<br>Sales Record stored successfully.";
                $extract_SalesID = mysqli_insert_id($conn);
            }
            else 
            {
                echo "<br>Error storing Sales Record.";
                $orderPlaced = false;
            }
        }

        $sql_table="orders";
        $fieldDefinition="`order_id` int(11) NOT NULL,
        `sales_id` int(11) DEFAULT NULL,
        `book_id` int(11) DEFAULT NULL,
        `quantity` int(11) DEFAULT NULL,
        `price` double DEFAULT NULL";

        //Check if table does not exist, create it
        $query1 = "show tables like '$sql_table'";  
        $result1 = @mysqli_query($conn, $query1);

        //Check if any tables of this name exist
        if(mysqli_num_rows($result1) == 0) 
        {
            echo "<p>Table does not exist - creating table $sql_table ...</p>"; // Might not show in a production script 
            $query2 = "create table " . $sql_table . "(" . $fieldDefinition . ")";; 
            $result2 = @mysqli_query($conn, $query2);
            // checks if the table was created
            if($result2 === false) 
            {
                echo "<p>Unable to create Table $sql_table.". mysqli_error($conn) . ":". mysqli_error($conn) ." </p>"; //Would not show in a production script 
                $orderPlaced = false;
            } 
            else 
            {
                foreach ($_SESSION["cart"] as $item) {
                    $book_id = $item['book_id'];
                    $qty = (int)$item['qty'];
                    $price = 0;

                    $query = "UPDATE books
                    SET amt_sold = amt_sold + $qty
                    WHERE book_id = '$book_id'";
                    $result = mysqli_query($conn, $query);

                    $query = "UPDATE books
                    SET stock = stock - $qty
                    WHERE book_id = '$book_id'";
                    $result = mysqli_query($conn, $query);
                    
                    $query = "SELECT * FROM books WHERE book_id LIKE '$book_id'";
                    $result = mysqli_query($conn, $query);

                    if($result) {
                        if($row = mysqli_fetch_assoc($result)) {
                            $price = $row['price']; 
                        }
                    }

                    $salesID = $extract_SalesID;
                    $query = "INSERT INTO $sql_table 
                    (sales_id, book_id, quantity, price) 
                    VALUES ('$salesID', '$book_id', '$qty', '$price')";

                    if(mysqli_query($conn, $query)) 
                    {
                        echo "<br>Order Record(s) stored successfully.";
                        $extract_OrderID = mysqli_insert_id($conn);
                    }
                    else 
                    {
                        echo "<br>Error storing Order Record(s).";
                        $orderPlaced = false;
                    }
                }
            } // if successful query operation
        }
        else
        {
            foreach ($_SESSION["cart"] as $item) {
                $book_id = $item['book_id'];
                $qty = (int)$item['qty'];
                $price = 0;

                $query = "UPDATE books
                SET amt_sold = amt_sold + $qty
                WHERE book_id = '$book_id'";
                $result = mysqli_query($conn, $query);

                $query = "UPDATE books
                SET stock = stock - $qty
                WHERE book_id = '$book_id'";
                $result = mysqli_query($conn, $query);

                $query = "SELECT * FROM books WHERE book_id LIKE '$book_id'";
                $result = mysqli_query($conn, $query);

                if($result) {
                    if($row = mysqli_fetch_assoc($result)) {
                        $price = $row['price']; 
                    }
                }

                $salesID = $extract_SalesID;
                $query = "INSERT INTO $sql_table 
                (sales_id, book_id, quantity, price) 
                VALUES ('$salesID', '$book_id', '$qty', '$price')";

                if(mysqli_query($conn, $query)) 
                {
                    echo "<br>Order Record(s) stored successfully.";
                    $extract_OrderID = mysqli_insert_id($conn);
                }
                else 
                {
                    echo "<br>Error storing Order Record(s).";
                    $orderPlaced = false;
                }
            }
        }

        if($orderPlaced) {
            if($loggedIn) {
                $query = "select * from users where userID like '$userID'";
                $result = mysqli_query($conn, $query);

                if($result) {
                    if($row = mysqli_fetch_assoc($result)) {
                        $_SESSION["fname"] = $row['firstName']; 
                        $_SESSION["lname"] = $row['lastName']; 
                    }
                }
            }
            else {
                $query = "select * from guests where guestID like '$guestID'";
                $result = mysqli_query($conn, $query);

                if($result) {
                    if($row = mysqli_fetch_assoc($result)) {
                        $_SESSION["fname"] = $row['firstName']; 
                        $_SESSION["lname"] = $row['lastName']; 
                    }
                }
            }

            $sql_table = "sales";
            $_SESSION["salesID"] = $extract_SalesID;
            $_SESSION["totalB4Tax"] = $totalB4Tax;
            $_SESSION["salesTax"] = $salesTax;

            $query = "select * from $sql_table where sales_id like '$extract_SalesID'";
            $result = mysqli_query($conn, $query);

            if($result) {
                if($row = mysqli_fetch_assoc($result)) {
                    $_SESSION["totalPrice"] = $row['total_price']; 
                    $_SESSION["status"] = $row['status']; 
                    $_SESSION["create_at"] = $row['create_at']; 
                    $_SESSION["p_address"] = $row['address']; 
                    $_SESSION["p_city"] = $row['city']; 
                    $_SESSION["p_state"] = $row['state']; 
                    $_SESSION["p_country"] = $row['country']; 
                    $_SESSION["p_postcode"] = $row['postcode']; 
                    $_SESSION["p_ccName"] = $row['ccName']; 
                    $_SESSION["p_cardNo"] = $row['cardNo']; 
                    $_SESSION["p_expiry"] = $row['expiry']; 
                    $_SESSION["p_cvv"] = $row['cvv']; 
                    $_SESSION["p_ccType"] = $row['ccType']; 
                }
            }

            $sql_table = "orders";
            $query = "SELECT * from $sql_table where sales_id like '$extract_SalesID'";
            $result = mysqli_query($conn, $query);

            if($result) {
                while($row = mysqli_fetch_assoc($result)) {
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
                $_SESSION['orderDetails'] = $bookDetailsArr;
            }

            unset($_SESSION["cart"]);
            header("location: receipt.php");
        }

        mysqli_close($conn); // Close the connection here
    }

    include 'inc/footer.inc';
?>
