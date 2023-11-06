<?php 
    include_once 'inc/header.inc';

    function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_POST["name"])) $name = $_POST["name"];
    if(isset($_POST["email"])) $email = $_POST["email"];
    if(isset($_POST["phone"])) $phone = $_POST["phone"];
    if(isset($_POST["dateOfComplaint"])) $dateOfComplaint = $_POST["dateOfComplaint"];
    if(isset($_POST["complaintReason"])) $complaintReason = $_POST["complaintReason"];
    if(isset($_POST["complaintDesc"])) $complaintDesc = $_POST["complaintDesc"];

    $name = sanitise_input($name);
    $email = sanitise_input($email);
    $phone = sanitise_input($phone);
    $dateOfComplaint = sanitise_input($dateOfComplaint);
    $complaintReason = sanitise_input($complaintReason);
    $complaintDesc = sanitise_input($complaintDesc);

    require_once ("settings.php"); //Connection Info
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
    
    $loggedIn = false;
    if(isset($_SESSION["userid"])) {
        $loggedIn = true;
    }

    if(!$conn) //Connection Failed
    {
        //Displays an error message
        $message = "Database Connection Failure!";
    }
    else //Connection Successful
    {
        if(!$loggedIn){
            $sql_table="support";
            $fieldDefinition="`form_id` int(11) NOT NULL, `customer_id` int(11) DEFAULT NULL, `type` varchar(255) DEFAULT NULL, `name` varchar(255) DEFAULT NULL, `email` varchar(255) DEFAULT NULL, 
                `phone` varchar (255) DEFAULT NULL, `reason` varchar(255) DEFAULT NULL, `description` varchar(255) DEFAULT NULL, `report_date` date DEFAULT NULL";

            //Check if table does not exist, create it
            $query1 = "show tables like '$sql_table'";
            $result1 = @mysqli_query($conn, $query1);

            //Check if any tables of this name exist
            if(mysqli_num_rows($result1) == 0) 
            {
                echo "<p class=\"wrong\">Table does not exist - creating table $sql_table ...</p>";
                $query2 = "create table " . $sql_table . "(" . $fieldDefinition . ")";; 
                $result2 = @mysqli_query($conn, $query2);
                // checks if the table was created
                if($result2 === false) 
                {
                    $message = "Unable to create Table $sql_table.". mysqli_error($conn) . ":". mysqli_error($conn) ."";
                } 
                else 
                {                
                    $query = "INSERT INTO $sql_table (customer_id, type, name, email, phone, reason, description, report_date) 
                        VALUES ('-1', 'complaint', '$name', '$email', '$phone', '$complaintReason', '$complaintDesc', '$dateOfComplaint')";

                    if(mysqli_query($conn, $query)) 
                    {
                        $message = "Complaint Record stored successfully.";
                        mysqli_close($conn);
                    }
                    else 
                    {
                        $message = "Error storing Complaint Record.";
                        mysqli_close($conn);
                    }
                } // if successful query operation
            }
            else
            {
                $query = "INSERT INTO $sql_table (customer_id, type, name, email, phone, reason, description, report_date) 
                    VALUES ('-1', 'complaint', '$name', '$email', '$phone', '$complaintReason', '$complaintDesc', '$dateOfComplaint')";

                if(mysqli_query($conn, $query)) 
                {
                    $message = "Complaint Record stored successfully.";
                    mysqli_close($conn);
                }
                else 
                {
                    $message = "Error storing Complaint Record.";
                    mysqli_close($conn);
                }
            }
        }
        else if($loggedIn){
            $userID = $_SESSION["userid"];

            $sql_table="support";
            $fieldDefinition="`form_id` int(11) NOT NULL, `customer_id` int(11) DEFAULT NULL, `type` varchar(255) DEFAULT NULL, `name` varchar(255) DEFAULT NULL, `email` varchar(255) DEFAULT NULL, 
                `phone` varchar (255) DEFAULT NULL, `reason` varchar(255) DEFAULT NULL, `description` varchar(255) DEFAULT NULL, `report_date` date DEFAULT NULL";

            //Check if table does not exist, create it
            $query3 = "show tables like '$sql_table'";
            $result3 = @mysqli_query($conn, $query3);

            //Check if any tables of this name exist
            if(mysqli_num_rows($result3) == 0) 
            {
                echo "<p class=\"wrong\">Table does not exist - creating table $sql_table ...</p>";
                $query4 = "create table " . $sql_table . "(" . $fieldDefinition . ")";; 
                $result4 = @mysqli_query($conn, $query4);
                // checks if the table was created
                if($result4 === false) 
                {
                    $message = "Unable to create Table $sql_table.". mysqli_error($conn) . ":". mysqli_error($conn) ."";
                } 
                else 
                {                
                    $query = "INSERT INTO $sql_table (customer_id, type, name, email, phone, reason, description, report_date) 
                        VALUES ('$userID', 'complaint', '$name', '$email', '$phone', '$complaintReason', '$complaintDesc', '$dateOfComplaint')";

                    if(mysqli_query($conn, $query)) 
                    {
                        $message = "Complaint Record stored successfully.";
                        mysqli_close($conn);
                    }
                    else 
                    {
                        $message = "Error storing Complaint Record.";
                        mysqli_close($conn);
                    }
                } // if successful query operation
            }
            else
            {
                $query = "INSERT INTO $sql_table (customer_id, type, name, email, phone, reason, description, report_date) 
                    VALUES ('$userID', 'complaint', '$name', '$email', '$phone', '$complaintReason', '$complaintDesc', '$dateOfComplaint')";

                if(mysqli_query($conn, $query)) 
                {
                    $message = "Complaint Record stored successfully.";
                    mysqli_close($conn);
                }
                else 
                {
                    $message = "Error storing Complaint Record.";
                    mysqli_close($conn);
                }
            }
        }
    }
    header("Location: complaintForm.php?message=".urlencode($message));
    exit;
?>