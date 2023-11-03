<?php
    $url = parse_url($_SERVER['REQUEST_URI']);
    $genre = isset($_GET['genre']) ? $_GET['genre'] : ''; // Check if 'genre' is set, if not, set it to an empty string
    $shade = basename($url['path']);
    include_once 'inc/header.inc';
    include_once 'inc/menu.inc';

    if (isset($_POST["clear_cart"])) {
        unset($_SESSION['cart']);
        // Redirect back to the cart page after clearing the cart
        header("Location: cart.php");
        exit();
    }
?>