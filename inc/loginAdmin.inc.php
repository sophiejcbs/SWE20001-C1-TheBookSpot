<?php
session_start();
require_once '../settings.php';
require_once 'functions.php';

if(isset($_POST["username"])){
    $_SESSION["username"] = $_POST["username"];
}
if(isset($_POST["usernameNew"])){
    $_SESSION["usernameNew"] = $_POST["usernameNew"];
}

//===============================================================//
//Administrators
//login
if(isset($_POST["loginAdmin"])){
    $username = sanitizeInput($_POST["username"]);
    $pwd = sanitizeInput($_POST["pwd"]);

    if(emptyInput($username, $pwd)!==false){
       header("location: ../loginAdmin.php?error=emptyinput");
       exit();
    }

    //Login if validation successful
    loginAdmin($conn, $username, $pwd);
}
//sign up
else if(isset($_POST["signupAdmin"])){
    $username =  sanitizeInput($_POST["usernameNew"]);
    $pwd = sanitizeInput($_POST["pwd"]);
    $repeatpwd =sanitizeInput($_POST["repeatpwd"]);

    if(emptyInput($username, $pwd, $repeatpwd)!==false){
        header("location: ../add_admin.php?error=emptyinput");
        exit();
    }
 
    //Sign up if validation successful
    signupAdmin($conn, $username, $pwd, $repeatpwd);
}

else{
    header("location: ../loginAdmin.php?error=");
    exit();
}