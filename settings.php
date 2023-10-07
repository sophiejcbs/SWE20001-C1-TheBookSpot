<?php
    $host = "localhost";
    $user = "root";
    $pwd  = "";
    $sql_db  = "thebookspotdb";

    $conn = mysqli_connect($host, $user, $pwd ,$sql_db);

    //error handler if connection to database is unestablished and to display the specific error
    if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}