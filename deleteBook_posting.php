<?php
//start session on every page of admin to check authenthcation
session_start(); 

if (isset($_SESSION['adminid']) && !empty($_SESSION['adminid'])) {
    //in session
}
else {
    //no session id
    header("location: index.php");
    exit();
}
?>
<?php
    $book_id = $_GET['book_id'];

    require_once ("settings.php"); //Connection Info
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
    
    if(!$conn) //Connection Failed
    {
        //Displays an error message
        $message = "Database Connection Failure!";
    }
    else //Connection Successful
    {
        $sql_table = "books";
        $query = "DELETE FROM $sql_table WHERE book_id = '$book_id'";

        if(mysqli_query($conn, $query)) 
        {
            $message = "Book Record deleted successfully.";
            mysqli_close($conn);
        }
        else 
        {
            $message = "Error deleting Book Record.";
            mysqli_close($conn);
        }
    }
    header("Location: bookRecord.php?message=".urlencode($message));
    exit;
?>
