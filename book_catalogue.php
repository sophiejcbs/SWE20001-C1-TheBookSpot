<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="utf‐8" /> 
    <meta name="description" content="SWE20001 The Book Spot"/>
    <meta name="keywords" content="book, store"/> 
    <meta name="author"   content="The Flying Fish" />
    <title>The Book Spot</title>
    
    <link rel="icon" type="image/x-icon" href="images\logo.png">
    <!-- CSS -->
    <link href = "styles/style.css" rel="stylesheet">
    <link href = "styles/bookCat.css" rel="stylesheet">
    <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)"/>
    <link href = "styles/bookCat_resp.css" rel="stylesheet" media ="screen and (max-width:1024px)"/>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    
    <!-- Header & Navigation Menu-->
    <?php
        $url = parse_url($_SERVER['REQUEST_URI']);
        $genre = isset($_GET['genre']) ? $_GET['genre'] : ''; // Check if 'genre' is set, if not, set it to an empty string
        $shade = basename($url['path']);
        include_once 'inc/header.inc';
        include_once 'inc/menu.inc';
        include_once 'inc/functions.php';

        // Get the genre parameter from the URL
        if (isset($_GET['genre'])) {
            $genre = urldecode($_GET['genre']);
        }

        // For database connection
        require_once "settings.php";
    ?>

    <h1 class="heading"><?php echo $genre;?></h1>

    <div class="bookCatalogue">
        <!-- PHP dynamically display -->
        <?php
            $sql_table="books";
            $query = "SELECT * FROM $sql_table WHERE genre LIKE '$genre'";
            bookCatDisplay ($conn, $query);
            // close the database connection
            mysqli_close ($conn) ;
        ?>
    </div>
    <?php
        // Footer
        include_once 'inc/footer.inc';
    ?>
</body>
</html>
