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

    $book_id = $_POST['book_id'];

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        require_once ("settings.php"); //Connection Info
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
        
        if(!$conn) //Connection Failed
        {
            //Displays an error message
            $message = "Database Connection Failure!";
        }
        else //Connection Successful
        {
            $sql_table="books";
            
            $query = "UPDATE $sql_table SET image = '$image', title = '$title', author = '$author', genre = '$genre', format = '$type', publisher = '$publisher', 
            publication_date = '$pubDate', description = '$bookDesc', book_ISBN = '$isbn', language = '$bookLang', price = '$price', stock = '$stock', amt_sold = '$amount'
            WHERE book_id = $book_id";

            if(mysqli_query($conn, $query)) 
            {
                $message = "Book Record updated successfully!";
                mysqli_close($conn);
            }
            else 
            {
                $message = "Error updating Book Record.";
                mysqli_close($conn);                
            } 
        }
        header("Location: bookRecord.php?message=".urlencode($message));
        exit;
    }
?>
