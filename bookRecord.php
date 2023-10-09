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
</head>

<?php
    include 'inc/adminHeader.inc';
    include 'inc/adminMenu.inc';
?>

<body>
    <h2_var2>Book Record</h2_var2>
</body>

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
            echo "<p class=\"wrong_bryan\">Something is wrong with ", $query, "</p>";
        } 
        else 
        {
            if(mysqli_num_rows($result) > 0) 
            {
                // Display the retrieved records
                echo "<div class=\"table-responsive\">";
                echo "<table class=\"table table-bordered table-hover\">";
                echo "<thead class=\"table-dark\">";
                echo "<tr>\n"
                    ."<th><div class=\"column-width-s\">#</div></th>\n"
                    ."<th><div class=\"column-width-l\">Title</div></th>\n"
                    ."<th>Cover</div></th>\n"
                    ."<th><div class=\"column-width-l\">Author</div></th>\n"
                    ."<th><div class=\"column-width-l\">Genre</div></th>\n"
                    ."<th><div class=\"column-width-m\">Type</div></th>\n"
                    ."<th><div class=\"column-width-m\">Publisher</div></th>\n"
                    ."<th><div class=\"column-width-l\">Publication Date</div></th>\n"
                    ."<th><div class=\"column-width-xl\">Description</div></th>\n"
                    ."<th><div class=\"column-width-l\">ISBN Number</div></th>\n"
                    ."<th><div class=\"column-width-m\">Language</div></th>\n"
                    ."<th><div class=\"column-width-m\">Price(RM)</div></th>\n"
                    ."<th><div class=\"column-width-m\">Stock</div></th>\n"
                    ."<th><div class=\"column-width-m\">Sold</div></th>\n"
                    ."<th><div class=\"column-width-l\">Action</div></th>\n"
                    ."</tr>\n";
                echo "</thead>";
                // retrieve current record pointed by the result pointer
                
                while ($row = mysqli_fetch_assoc($result))
                {
                    echo "<tbody class=\"table-group-divider\">";
                    echo "<tr>";
                    echo "<td>", $int++,"</td>";  
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
