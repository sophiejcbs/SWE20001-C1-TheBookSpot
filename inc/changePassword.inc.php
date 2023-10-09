<?php
session_start();
require_once '../settings.php';
require_once 'functions.php';

if(isset($_POST["changepwd"])){
    $adminid = sanitizeInput($_POST["adminid"]);
    $pwdold = sanitizeInput($_POST["pwdold"]);
    $pwd = sanitizeInput($_POST["pwd"]);
    $repeatpwd = sanitizeInput($_POST["repeatpwd"]);

    if(emptyInput($pwdold, $pwd, $repeatpwd)!==false){
        if(isset($_POST["adminid"])){
            header("location: ../admin_profile.php?error=emptyinput");
            exit();
        }
        else if(isset($_POST["userid"])){
            header("location: ../user_profile.php?error=emptyinput");
            exit();
        }
    }

    //Change Admin Password
    changePasswordAdmin($conn, $adminid, $pwdold, $pwd, $repeatpwd);

    //Change User Password
    changePasswordUser();

}