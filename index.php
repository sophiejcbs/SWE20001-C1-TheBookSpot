<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="utf‐8" /> 
    <meta name="description" content="SWE20001 The Book Spot"/>
    <meta name="keywords" content="book, store"/> 
    <meta name="author"   content="The Flying Fish" />
    <title>Home - The Book Spot</title>
    
    <link rel="icon" type="image/x-icon" href="images\logo.png">
    <!-- CSS -->
    <link href = "styles/style.css" rel="stylesheet">
    <link href = "styles/bookCat.css" rel="stylesheet">
    <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)"/>
    <link href = "styles/bookCat_resp.css" rel="stylesheet" media ="screen and (max-width:1024px)"/>

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
        include_once 'inc/functions.php';
    ?>

    <!-- Carousel -->
    <div class="carousel">

        <!-- Full-width images -->
        <div class="carousel_slide">
        <img src="https://cdn.shopify.com/s/files/1/0511/7575/1837/files/Pre-Order-Heart-of-the-Sun-Warrior-US-1920x530_1800x.jpg?v=1667448241">
        </div>

        <div class="carousel_slide">
        <img src="https://mphonline.com/cdn/shop/files/Pre-order_Welcome_to_the_Hyunam-Dong_Bookshop_Web_Banner_1920x530_1.jpg?v=1694505368&width=1540">
        </div>

        <div class="carousel_slide">
        <img src="https://mphonline.com/cdn/shop/files/Comic-promo_web-banner_1920x530_1.jpg?v=1694996371&width=1540">
        </div>

        <!-- Next and previous buttons -->
        <a class="prev" onclick="switchSlide(-1)">&#10094;</a>
        <a class="next" onclick="switchSlide(1)">&#10095;</a>
    </div>
    <br>

    <!-- The dots/circles -->
    <div class="carousel_indicator">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>

    <!-- PHP for book catalogue -->
    <?php
        // For database connection
        require_once "settings.php";
    ?>

    <!-- Recommendation -->
    <h1 class="heading">Best Sellers</h1>
    <div class="bookCatalogue">
        <!-- PHP dynamically display -->
        <?php
            $sql_table="books";
            $query = "SELECT * FROM $sql_table ORDER BY amt_sold DESC";
            displayBooks ($conn, $query);
        ?>
    </div>

    <h1 class="heading">New Arrivals</h1>
    <div class="bookCatalogue">
        <!-- PHP dynamically display -->
        <?php
            $query = "SELECT * FROM $sql_table ORDER BY create_at DESC";
            displayBooks ($conn, $query)
        ?>
    </div>

    <?php
        // close the database connection
        mysqli_close ($conn) ;

        // Footer
        include_once 'inc/footer.inc';
    ?>
</body>
</html>