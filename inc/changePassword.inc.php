<?php
session_start();
require_once '../settings.php';
require_once 'functions.php';

if(isset($_POST["changepwd"])){
    if (isset($_POST["adminid"]) && !empty($_POST["adminid"])) {
    $adminid = $_POST["adminid"];
    } else {
    $userid = $_POST["userid"];
    }

    $pwdold = $_POST["pwdold"];
    $pwd = $_POST["pwd"];
    $repeatpwd = sanitizeInput($_POST["repeatpwd"]);

    if(emptyInput($pwdold, $pwd, $repeatpwd)!==false){
        if (isset($_POST["adminid"]) && !empty($_POST["adminid"])) {
            header("location: ../admin_profile.php?error=emptyinput");
            exit();
        }
        else{
            header("location: ../user_profile.php?error=pwdemptyinput");
            exit();
        }
    }

    //Change Admin Password
    if (isset($_POST["adminid"]) && !empty($_POST["adminid"])) {
        changePasswordAdmin($conn, $adminid, $pwdold, $pwd, $repeatpwd);
    }

    //Change User Password
    if(isset($_POST["userid"])){
    changePasswordUser($conn, $userid , $pwdold, $pwd, $repeatpwd);
    }
}
else {
    header("location: ../index.php");
    exit();
}
