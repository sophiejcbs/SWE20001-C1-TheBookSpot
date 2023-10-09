<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="UTF-8" />
    <meta name="description" content="The Book Spot" />
    <meta name="author" content="The Flying Fish" />
    <meta name="keywords" content="The Book Spot Book Management" />
    <title>Book Information Status | Administrator</title>

    <link rel="icon" type="image/x-icon" href="images\logo.png" />
    <!-- CSS -->
    <link href = "styles/addBook_ps.css" rel="stylesheet" />
    <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)" />
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
    
<?php
    include 'inc/header.inc';
    include 'inc/menu.inc';

    function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_POST["image"])) $image = $_POST["image"];
    if(isset($_POST["title"])) $title = $_POST["title"];
    if(isset($_POST["author"])) $author = $_POST["author"];
    if(isset($_POST["genre"])) $genre = $_POST["genre"];
    if(isset($_POST["type"])) $type = $_POST["type"];
    if(isset($_POST["publisher"])) $publisher = $_POST["publisher"];
    if(isset($_POST["pubDate"])) $pubDate = $_POST["pubDate"];
    if(isset($_POST["bookDesc"])) $bookDesc = $_POST["bookDesc"];
    if(isset($_POST["isbn"])) $isbn = $_POST["isbn"];
    if(isset($_POST["bookLang"])) $bookLang = $_POST["bookLang"];
    if(isset($_POST["price"])) $price = $_POST["price"];
    if(isset($_POST["stock"])) $stock = $_POST["stock"];
    if(isset($_POST["amount"])) $amount = $_POST["amount"];

    $image = sanitise_input($image);
    $title = sanitise_input($title);
    $author = sanitise_input($author);
    $genre = sanitise_input($genre);
    $type = sanitise_input($type);
    $publisher = sanitise_input($publisher);
    $pubDate = sanitise_input($pubDate);
    $bookDesc = sanitise_input($bookDesc);
    $isbn = sanitise_input($isbn);
    $bookLang = sanitise_input($bookLang);
    $price = sanitise_input($price);
    $stock = sanitise_input($stock);
    $amount = sanitise_input($amount);

    require_once ("settings.php"); //Connection Info
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
    
    if(!$conn) //Connection Failed
    {
        //Displays an error message
        echo "<p>Database conn failure</p>"; //Not in production script
    }
    else //Connection Successful
    {
        $sql_table="books";
        $fieldDefinition="`book_id` int(11) NOT NULL, `image` varchar(255) DEFAULT NULL, `title` varchar(255) DEFAULT NULL, `author` varchar(255) DEFAULT NULL, `genre` varchar(255) DEFAULT NULL,
        `format` varchar(255) DEFAULT NULL, `publisher` varchar(255) DEFAULT NULL, `publication_date` date DEFAULT NULL, `description` text DEFAULT NULL, `book_ISBN` varchar(13) DEFAULT NULL,
        `language` varchar(255) DEFAULT NULL, `price` decimal(10,2) DEFAULT NULL, `stock` int(11) DEFAULT NULL, `amt_sold` int(11) DEFAULT NULL, `create_at` datetime DEFAULT NULL";

        //Check if table does not exist, create it
        $query1 = "show tables like '$sql_table'";  
        $result1 = @mysqli_query($conn, $query1);

        //Check if any tables of this name exist
        if(mysqli_num_rows($result1) == 0) 
        {
            echo "<p>Table does not exist - creating table $sql_table ...</p>"; // Might not show in a production script 
            $query2 = "create table " . $sql_table . "(" . $fieldDefinition . ")";; 
            $result2 = @mysqli_query($conn, $query2);
            // checks if the table was created
            if($result2 === false) 
            {
                echo "<p>Unable to create Table $sql_table.". mysqli_error($conn) . ":". mysqli_error($conn) ." </p>"; //Would not show in a production script 
            } 
            else 
            {                
                $query = "INSERT INTO $sql_table (image, title, author, genre, format, publisher, publication_date, description, book_ISBN, language, price, stock, amt_sold) 
                VALUES ('$image', '$title', '$author', '$genre', '$type', '$publisher', '$pubDate', '$bookDesc', '$isbn', '$bookLang', '$price', '$stock', '$amount')";

                if(mysqli_query($conn, $query)) 
                {
                    echo "Book Record stored successfully.";
                    mysqli_close($conn);
                }
                else 
                {
                    echo "Error storing Book Record.";
                    mysqli_close($conn);
                }
            } // if successful query operation
        }
        else
        {
            $query = "INSERT INTO $sql_table (image, title, author, genre, format, publisher, publication_date, description, book_ISBN, language, price, stock, amt_sold) 
            VALUES ('$image', '$title', '$author', '$genre', '$type', '$publisher', '$pubDate', '$bookDesc', '$isbn', '$bookLang', '$price', '$stock', '$amount')";

            if(mysqli_query($conn, $query)) 
            {
                echo "Book Record stored successfully.";
                mysqli_close($conn);
            }
            else 
            {
                echo "Error storing Book Record.";
                mysqli_close($conn);
            }
        }
    }
    include 'inc/footer.inc';
?>
