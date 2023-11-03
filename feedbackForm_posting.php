<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="UTF-8" />
    <meta name="description" content="The Book Spot" />
    <meta name="author" content="The Flying Fish" />
    <meta name="keywords" content="The Book Spot Customer Helpdesk" />
    <title>Form Submission Status | Customer Helpdesk</title>

    <link rel="icon" type="name/x-icon" href="names\logo.png" />
    <!-- CSS -->
    <link href = "styles/addBook.css" rel="stylesheet" />
    <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)" />
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
    
<?php
    include 'includes/header.inc';
    include 'includes/menu.inc';

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
    if(isset($_POST["dateOfFeedback"])) $dateOfFeedback = $_POST["dateOfFeedback"];
    if(isset($_POST["feedbackType"])) $feedbackType = $_POST["feedbackType"];
    if(isset($_POST["feedbackDesc"])) $feedbackDesc = $_POST["feedbackDesc"];

    $name = sanitise_input($name);
    $email = sanitise_input($email);
    $phone = sanitise_input($phone);
    $dateOfFeedback = sanitise_input($dateOfFeedback);
    $feedbackType = sanitise_input($feedbackType);
    $feedbackDesc = sanitise_input($feedbackDesc);

    require_once ("settings.php"); //Connection Info
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(!$conn) //Connection Failed
        {
            //Displays an error message
            $message = "Database Connection Failure!";
        }
        else //Connection Successful
        {
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
                        VALUES ('', 'feedback', '$name', '$email', '$phone', '$feedbackType', '$dateOfFeedback')";

                    if(mysqli_query($conn, $query)) 
                    {
                        $message = "Feedback Record stored successfully.";
                        mysqli_close($conn);
                    }
                    else 
                    {
                        $message = "Error storing Feedback Record.";
                        mysqli_close($conn);
                    }
                } // if successful query operation
            }
            else
            {
                $query = "INSERT INTO $sql_table (customer_id, type, name, email, phone, reason, description, report_date) 
                    VALUES ('', 'feedback', '$name', '$email', '$phone', '$feedbackType', '$feedbackDesc', '$dateOfFeedback')";

                if(mysqli_query($conn, $query)) 
                {
                    $message = "Feedback Record stored successfully.";
                    mysqli_close($conn);
                }
                else 
                {
                    $message = "Error storing Feedback Record.";
                    mysqli_close($conn);
                }
            }
        }
        header("Location: feedbackForm.php?message=".urlencode($message));
        exit;
    }
    include 'includes/footer.inc';
?>