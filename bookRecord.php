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
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="UTF-8" />
    <meta name="description" content="The Book Spot" />
    <meta name="author" content="The Flying Fish" />
    <meta name="keywords" content="The Book Spot Book Management" />
    <title>Book Record | Administrator</title>

    <link rel="icon" type="image/x-icon" href="images\logo.png" />
    <!-- CSS -->
    <link href = "styles/bookRecord.css" rel="stylesheet" />
    <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)" />
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    
    <script src="scripts/tableSortable.js"></script>
</head>

<?php
    $url = parse_url($_SERVER['REQUEST_URI']);
    $path = $url['path'];
    $shade = basename($path);
    include 'inc/adminHeader.inc';
    include 'inc/adminMenu.inc';
?>

<body>
    <h2 class="heading">Book Record</h2>
    <div class="title"><a class="btn btn-primary" href="addBook.php" role="button">Create New Book</a></div>

    <?php
        require_once('settings.php');
                
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

        // Checks if connection is successful
        if (!$conn) 
        {
            // Displays an error message
            echo "<p>Database connection failure</p>";
        } 
        else 
        {
            // Upon successful connection
            $sql_table="books";
            $int = 1;

            $query = "SELECT book_id, title, image, author, genre, format, publisher, publication_date, description, book_ISBN, language, price, stock, amt_sold FROM $sql_table;";
            $result = mysqli_query($conn, $query);

            //Checks if the execution was successful
            if(!$result) 
            {
                echo "<p>Something is wrong with ", $query, "</p>";
            } 
            else 
            {
                if(mysqli_num_rows($result) > 0) 
                {
                    // Display the retrieved records
                    echo "<div class=\"table-responsive\">";
                    echo "<table id=\"bookTable\" class=\"table table-bordered table-hover\">";
                    echo "<thead class=\"table-dark\">";
                    echo "<tr>\n"
                        ."<th><div class=\"column-width\">#<i class=\"fas fa-sort\" onclick=sortTable(0)></i></div></th>\n"
                        ."<th><div class=\"column-width\">Title<i class=\"fas fa-sort\" onclick=sortTable(1)></i></div></th>\n"
                        ."<th>Cover</div></th>\n"
                        ."<th><div class=\"column-width\">Author<i class=\"fas fa-sort\" onclick=sortTable(3)></i></div></th>\n"
                        ."<th><div class=\"column-width\">Genre<i class=\"fas fa-sort\" onclick=sortTable(4)></i></div></th>\n"
                        ."<th><div class=\"column-width\">Type<i class=\"fas fa-sort\" onclick=sortTable(5)></i></div></th>\n"
                        ."<th><div class=\"column-width\">Publisher<i class=\"fas fa-sort\" onclick=sortTable(6)></i></div></th>\n"
                        ."<th><div class=\"column-width\">Publication Date<i class=\"fas fa-sort\" onclick=sortTable(7)></i></div></th>\n"
                        ."<th><div class=\"column-width-xl\">Description<i class=\"fas fa-sort\" onclick=sortTable(8)></i></div></th>\n"
                        ."<th><div class=\"column-width\">ISBN Number<i class=\"fas fa-sort\" onclick=sortTable(9)></i></div></th>\n"
                        ."<th><div class=\"column-width\">Language<i class=\"fas fa-sort\" onclick=sortTable(10)></i></div></th>\n"
                        ."<th><div class=\"column-width\">Price(RM)<i class=\"fas fa-sort\" onclick=sortTable(11)></i></div></th>\n"
                        ."<th><div class=\"column-width\">Stock<i class=\"fas fa-sort\" onclick=sortTable(12)></i></div></th>\n"
                        ."<th><div class=\"column-width\">Sold<i class=\"fas fa-sort\" onclick=sortTable(13)></i></div></th>\n"
                        ."<th><div class=\"column-width-l\">Action</div></th>\n"
                        ."</tr>\n";
                    echo "</thead>";
                    // retrieve current record pointed by the result pointer
                    
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        echo "<tbody class=\"table-group-divider\">";
                        echo "<tr>";
                        echo "<td>", $row["book_id"],"</td>";  
                        echo "<td>", $row["title"], "</td>";  
                        echo "<td><img src='", $row["image"], "'alt='Book Cover' width=100></td>";
                        echo "<td>", $row["author"], "</td>";
                        echo "<td>", $row["genre"], "</td>";
                        echo "<td>", $row["format"], "</td>";
                        echo "<td>", $row["publisher"], "</td>";
                        echo "<td>", $row["publication_date"], "</td>";
                        echo "<td><div class=\"description-row\">", $row["description"], "</div></td>";
                        echo "<td>", $row["book_ISBN"], "</td>";
                        echo "<td>", $row["language"], "</td>";
                        echo "<td>", $row["price"], "</td>";
                        echo "<td>", $row["stock"], "</td>";
                        echo "<td>", $row["amt_sold"], "</td>";
                        echo "<td><a class=\"btn btn-success\" href=\"editBook.php?book_id={$row["book_id"]}\" role=\"button\">Edit</a>
                            <a class=\"btn btn-danger\" href=\"deleteBook_posting.php?book_id={$row["book_id"]}\" role=\"button\">Delete</a></td>";
                        echo "</tr>";
                        echo "</tbody>";
                    }
                    echo "</table>";
                    echo "</div>";

                    // Frees up the memory, after using the result pointer
                    mysqli_free_result($result);
                } // if successful query operation
            } // end if no rows
            mysqli_close($conn);  // close the database connection
        }  
        include 'inc/footer.inc';
    ?>
</body>

<script>
    <?php
        // Check if a response message should be displayed
        if (isset($_GET['message'])) 
        {
            $message = $_GET['message'];
            // Display the response message using JavaScript alert
            echo "alert('$message');";
        }
    ?>
</script>
