<?php
session_start();
require_once '../settings.php';
require_once 'functions.php';

if(isset($_POST["changeInfo"])){
    $userid = $_POST["userid"];
    $fname = sanitizeInput($_POST["fname"]);
    $lname = sanitizeInput($_POST["lname"]);

    if (empty($fname) || empty($lname)) {
        header("location: ../user_profile.php?error=emptynameinput");
        exit();
    }

    editAccountInformation($conn, $userid, $fname, $lname); 
}

else if(isset($_POST["addressInfo"])){
    $userid = $_POST["userid"];
    $address = sanitizeInput($_POST["address"]);
    $city = sanitizeInput($_POST["city"]);
    $state = sanitizeInput($_POST["state"]);
    $postcode = sanitizeInput($_POST["postcode"]);

    if (empty($address) || empty($city) || empty($postcode) || empty($state)) {
        header("location: ../user_profile.php?error=addressempty");
        exit();
    }

    updateShippingAddress($conn, $userid, $address, $city, $state, $postcode);
}

else if(isset($_POST["payment"])){
    $userid = $_POST["userid"];
    $ccType = sanitizeInput($_POST["ccType"]);
    $cardNo = sanitizeInput($_POST["cardNo"]);
    $ccName = sanitizeInput($_POST["ccName"]);
    $expiry = sanitizeInput($_POST["expiry"]);
    $cvv = sanitizeInput($_POST["cvv"]);

    if(empty($ccType)){
        header("location: ../user_profile.php?error=cardTypeempty");
        exit();
    }
    if (empty($cardNo) || empty($ccName) || empty($expiry) || empty($cvv)) {
        header("location: ../user_profile.php?error=paymentempty");
        exit();
    }

    updatePaymentInformation($conn, $userid, $ccName, $cardNo, $expiry, $cvv, $ccType);
}

else {
    header("location: ../index.php");
    exit();
}