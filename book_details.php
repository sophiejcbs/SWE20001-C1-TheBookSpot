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
    <link href = "styles/bookCat.css" rel="stylesheet">
    <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)"/>
    <link href = "styles/bookCat_resp.css" rel="stylesheet" media ="screen and (max-width:1024px)"/>

    <!-- Javascript -->
    <script src="scripts/book_details.js"></script>

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

        // Get the book_id parameter from the URL
        if (isset($_GET['book_id'])) {
            $book_id = urldecode($_GET['book_id']);
        }

        $sql_table="books";
        $query = "SELECT * FROM $sql_table WHERE book_id LIKE '$book_id'";
        $result = mysqli_query($conn, $query);

        $stock = 0;

        if ($conn && $result){
            // Check if a row was returned from the query
            if ($row = mysqli_fetch_assoc($result)) {
                $image = $row['image'];
                $title = $row['title'];
                $author = $row['author'];
                $format = $row['format'];
                $price = $row['price'];
                $publisher = $row['publisher'];
                $ISBN = $row['book_ISBN'];
                $language = $row['language'];
                $stock = $row['stock'];
                $description = $row['description'];

                //Stock status
                if ($row['stock']>0){
                    $stockIndicator = "instock";
                    $stockTxt="In Stock";
                }
                else{
                    $stockIndicator = "outstock";
                    $stockTxt="Out of Stock";
                }
            } else {
                // Handle the case where no matching book was found
                echo " <h2> Book not found. <h2>";
            }
        }
    ?>

    <?php
        if(isset($_POST['add']) && $_POST["stock"]>0) {
            if(isset($_SESSION["cart"])) {
                $exist = false; 
                foreach($_SESSION["cart"] as $index => $item) {
                    if($item["book_id"] == $_POST["book_id"]) {
                        $newQty = intval($_SESSION['cart'][$index]["qty"]) + intval($_POST["qty"]);
                        $_SESSION['cart'][$index]["qty"] = $newQty;
                        $exist = true;
                    }
                }

                if(!$exist) {
                    $count = count($_SESSION['cart']);

                    $book_array= [];
                    $book_array["book_id"] = $_POST["book_id"];
                    $book_array["qty"] = $_POST["qty"];
                    $book_array["dateTime"] = time();
        
                    array_push($_SESSION['cart'], $book_array);
                }
            }
            else {
                $book_array= [];
                $book_array["book_id"] = $_POST["book_id"];
                $book_array["qty"] = $_POST["qty"];
                $book_array["dateTime"] = time();

                //create new session var
                $_SESSION["cart"][0] = $book_array;
            }

            usort($_SESSION['cart'], function($a, $b) {
                return $a['dateTime'] - $b['dateTime'];
            });

            $_SESSION['cart'] = array_reverse($_SESSION['cart']);
            
            header('Location: cart.php'); //redirect to cart pg (PRG pattern)
            exit(); 
        }
    ?>

    <!-- Back button -->
    <div class="backContainer">
        <a href="javascript:history.back()"><i class="bi bi-arrow-left text-dark"></i></a>
    </div>

    <!-- Details -->
    <div class="bookContainer">
        <!-- Book Image -->
        <div class="imageContainer"><img src = "<?php echo $image?>"></div>
        <div class="infoContainer">
            <h1><?php echo $title?></h1>
            <h3 id="author">by <?php echo $author?></h3>
            <h3 style="font-size: 0.9rem;"><?php echo $format?></h3>
            <h2>RM <?php echo $price?></h2>
            <h3 class="bi bi-circle-fill <?php echo $stockIndicator?>"> <span class="stockTxt"><?php echo $stockTxt?></span></h3>
            <br>
            <div class="quanContainer">
                <h3 id="quan">Quantity:</h3> 
                <button type="button" class="decrementButton" onclick = "decrement()">—</button>
                <input type="text" name="Quantity" value="1" class="quanInput" id = "quantity" readonly>  
                <button type="button" class="incrementButton" onclick = "increment()">+</button>
            </div>
        
            <!-- form for submitting prod data -->
            <form id = "cartForm" action = "book_details.php?book_id=<?php echo $book_id?>" method = "post">
                <div class="purchaseContainer">
                    <button type="submit" name = "add" class="cartButton" id = "addToCart">Add To Cart</button>
                    <button type="button" class="buyButton">Buy It Now</button>

                    <!-- hidden product id to submit with add click -->
                    <input type = "hidden" name = "book_id" value = "<?php echo $book_id?>"/>
                    <input type = "hidden" name = "qty" id = "hiddenQty" value = "1"/>
                    <?php echo "<input type = 'hidden' name = 'stock' value = '$stock'/>"; ?>
                </div>
            </form>
            <hr>
            <div class="prodDetails">
                <table>
                    <tr>
                        <td>
                            <p><strong>Publisher</strong></p>
                        </td>
                        <td>
                            <p><strong>ISBN</strong></p>
                        </td>
                        <td>
                            <p><strong>Language</strong></p>
                        </td>
                        <td>
                            <p><strong>Format</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <i class="bi bi-building"></i>
                        </td>
                        <td>
                            <i class="bi bi-hash"></i>
                        </td>
                        <td>
                            <i class="bi bi-globe"></i>
                        </td>
                        <td>
                            <i class="bi bi-book"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><?php echo $publisher?></p>
                        </td>
                        <td>
                            <p><?php echo $ISBN?></p>
                        </td>
                        <td>
                            <p><?php echo $language?></p>
                        </td>
                        <td>
                            <p><?php echo $format?></p>
                        </td>
                    </tr>
                </table>
            </div>         
        </div>
        <div class="description">
            <h2> Description</h2>
            <p><?php echo $description?></p>
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
