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
    $state = ucfirst(sanitizeInput($_POST["state"]));     //capitalize first letter in $state
    $postcode = sanitizeInput($_POST["postcode"]);

    if (empty($address) || empty($city) || empty($postcode) || empty($state)) {
        header("location: ../user_profile.php?error=addressempty");
        exit();
    }

    //Validation for address
    if(strlen($address)<5 || strlen($address)>40){
        header("location: ../user_profile.php?error=invalidaddress");
        exit();
    }

    //Validation for State
    $validStates = array("Johor", "Kedah", "Kelantan", "Malacca", "Negeri Sembilan","Pahang", "Penang", "Perlis", "Sabah", "Sarawak", "Selangor", "Terengganu");
    if (!in_array($state, $validStates)) {
        header("location: ../user_profile.php?error=invalidstate");
        exit();
    }

    //Validation for Postcode
    if (empty($postcode) || !is_numeric($postcode)) {
        header("location: ../user_profile.php?error=invalidpostcode");
        exit();
    }
    if(!validatePostcode($state,$postcode)){
        header("location: ../user_profile.php?error=invalidstatepostcode");
        exit();
    }

    //All validation passed
    updateShippingAddress($conn, $userid, $address, $city, $state, $postcode);
}

else if(isset($_POST["payment"])){
    $userid = $_POST["userid"];
    $ccType = sanitizeInput($_POST["ccType"]);
    $cardNo = sanitizeInput($_POST["cardNo"]);
    $ccName = sanitizeInput($_POST["ccName"]);
    $expiry = sanitizeInput($_POST["expiry"]);
    $cvv = sanitizeInput($_POST["cvv"]);

    $errors = array(); //Array to store validation errors
    // Credit card type validation (check if there is a selection).
    if (empty($ccType)) {
        $errors[] = "Your credit card type cannot be empty.";
    }

    // Credit card name validation.
    if (empty($ccName)) {
        $errors[] = "Your credit card name cannot be empty.";
    } else if (!preg_match('/^[a-zA-Z\s]{2,40}$/', $ccName)) {
        $errors[] = "Your credit card name can only have alphabets/spaces and be 40 characters or less.";
    }

    // Credit card number validation.
    if (!empty($ccType)) {
        if (empty($cardNo)) {
            $errors[] = "Your credit card number cannot be empty.";
        } else {
            if ($ccType == "Visa" && (!preg_match('/^4\d{15}$/', $cardNo))) {
                $errors[] = "Your Visa card number has to have 16 digits and start with a 4.";
            } elseif ($ccType == "Mastercard" && (!preg_match('/^(5[1-5])\d{14}$/', $cardNo))) {
                $errors[] = "Your Mastercard card number has to have 16 digits and start with 51-55.";
            } elseif ($ccType == "American Express" && (!preg_match('/^(34|37)\d{13}$/', $cardNo))) {
                $errors[] = "Your American Express card number has to have 15 digits and start with 34 or 37.";
            }
        }
    }

    // Expiry date validation.
    if (empty($expiry)) {
        $errors[] = "Your credit card expiry date cannot be empty.";
    } else if (!preg_match('/^\d{2}-\d{2}$/', $expiry)) {
        $errors[] = "Your expiry date needs to be digits in the MM-YY format.";
    }

    // CVV validation.
    if (empty($cvv)) {
        $errors[] = "Your CVV cannot be empty.";
    } else if (!preg_match('/^\d{3,4}$/', $cvv)) {
        $errors[] = "Your CVV needs to be 3-4 digits long.";
    }

    if (!empty($errors)) {
        $errorString = implode("<br>", $errors); // Create a string from the error messages.
        header("location: ../user_profile.php?error=paymenterror&details=" . urlencode($errorString));
        exit();
    } else {
        updatePaymentInformation($conn, $userid, $ccName, $cardNo, $expiry, $cvv, $ccType);
    }
}

else {
    header("location: ../index.php");
    exit();
}
