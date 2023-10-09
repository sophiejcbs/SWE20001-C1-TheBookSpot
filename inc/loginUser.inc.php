<?php
session_start();
require_once '../settings.php';
require_once 'functions.php';


//==============Session Storage ====================//
$_SESSION["firstname"] = $_POST["firstname"];
$_SESSION["lastname"] = $_POST["lastname"];
$_SESSION["username"] = $_POST["username"];
$_SESSION["email"] = $_POST["email"];
$_SESSION["phone"] = $_POST["phone"];

//===============================================================//
//Users
//login
if(isset($_POST["loginUser"])){
    $username = sanitizeInput($_POST["username"]);
    $pwd = sanitizeInput($_POST["pwd"]);

    if(emptyInput($username, $pwd)!==false){
       header("location: ../loginUser.php?error=emptyinput");
       exit();
    }

    //Login if validation successful
    loginUser($conn, $username, $pwd);
}
//sign up
else if(isset($_POST["signupUser"])){
    $firstname = sanitizeInput($_POST["firstname"]);
    $lastname = sanitizeInput($_POST["lastname"]);
    $username = sanitizeInput($_POST["username"]);
    $email = sanitizeInput($_POST["email"]);
    $phone = sanitizeInput($_POST["phone"]);
    $pwd = sanitizeInput($_POST["pwd"]);
    $repeatpwd = sanitizeInput($_POST["repeatpwd"]);

    if(emptySignupInput($firstname, $lastname, $username, $email, $phone, $pwd, $repeatpwd)){
        header("location: ../signupUser.php?error=emptyinput");
        exit();
    }
 
    //Sign up if validation successful
    signupUser($conn, $firstname, $lastname, $username, $email, $phone, $pwd, $repeatpwd);
}

else{
    header("location: ../signupUser.php?error=");
    exit();
}