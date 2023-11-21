<?php
    require_once ("settings.php"); //Connection Info
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

    function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_POST["sales_id"])) $sales_id = $_POST["sales_id"];
    if(isset($_POST["status"])) $status = $_POST["status"];

    $sales_id = sanitise_input($sales_id);
    $status = sanitise_input($status);
    
    if(!$conn) //Connection Failed
    {
        //Displays an error message
        $message = "Database Connection Failure!";
    }
    else if($status != "PENDING") {
        $message = "Invalid action! You cannot delete a non-pending order.";
    }
    else //Connection Successful and Valid Order Status
    {
        $sql_table = "sales";
        $query = "DELETE FROM $sql_table WHERE sales_id = '$sales_id'";

        if(mysqli_query($conn, $query)) 
        {
            $sql_table = "orders";
            $query = "DELETE FROM $sql_table WHERE sales_id = '$sales_id'";

            if(mysqli_query($conn, $query)) 
            {
                $message = "Order Record deleted successfully.";
                mysqli_close($conn);
            }
            else 
            {
                $message = "Error deleting Order Record.";
                mysqli_close($conn);
            }
        }
        else 
        {
            $message = "Error deleting Order Record.";
            mysqli_close($conn);
        }
    }

    header("Location: orderRecord.php?message=".urlencode($message));
    exit;
?>
