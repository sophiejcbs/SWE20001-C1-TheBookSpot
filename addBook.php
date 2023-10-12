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
    <title>Create New Book | Administrator</title>

    <link rel="icon" type="image/x-icon" href="images\logo.png" />
    <!-- CSS -->
    <link href = "styles/addBook.css" rel="stylesheet" />
    <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)" />
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- JavaScript -->
    <script src="scripts/bookInfo_validation.js"></script>
</head>
    
<body>
    <?php
        include 'inc/adminHeader.inc';
        include 'inc/adminMenu.inc';
    ?>
    
    <!-- New Book Information -->
    <div class="bg-text">
        <form name="bookInformation" method="post" action="addBook_posting.php" onsubmit="return infoValidation()">
            <h1_var2>Book Information Form</h1_var2>
            <br><br>
            <fieldset>
                <legend class="formGroup">Book Information</legend>
                
                <label for="image">Book Image</label><p class="required">*</p><br>
                <input type="text" name="image" id="image" placeholder="https://......" class="fields"> <br>
                <div class="error" id="errImage"></div>
                    
                <label for="title">Book Title</label><p class="required">*</p><br>
                <input type="text" name="title" id="title" placeholder="Eg: Peter and Jane" class="fields"><br>
                <div class="error" id="errTitle"></div>
                            
                <label for="author">Book Author</label><p class="required">*</p><br>
                <input type="text" name="author" id="author" placeholder="Eg: John Doe" class="fields"> <br>
                <div class="error" id="errAuthor"></div>

                <label for="genre">Book Genre</label><p class="required">*</p><br>
                <select name="genre" id="genre" class="fields">
                    <option value="NA" selected disabled hidden>Choose a Genre</option>
                    <option value="Young Adult Fantasy">Young Adult Fantasy</option>
                    <option value="Romance">Romance</option>
                    <option value="Science Fiction">Science Fiction</option>
                    <option value="Crime & Thriller">Crime & Thriller</option>
                    <option value="Children">Children</option>
                </select>
                <div class="error" id="errGenre"></div>

                <label for="type">Book Type</label><p class="required">*</p><br>
                <select name="type" id="type" class="fields">
                    <option value="NA" selected disabled hidden>Choose a Book Type</option>
                    <option value="Paperback">Paperback</option>
                    <option value="Hardcover">Hardcover</option>
                </select>
                <div class="error" id="errType"></div>

                <label for="publisher">Book Publisher</label><p class="required">*</p><br>
                <input type="text" name="publisher" id="publisher" placeholder="Eg: Scholastic" class="fields"> <br>
                <div class="error" id="errPublisher"></div>

                <label for="pubDate">Publication Date</label><p class="required">*</p><br>
                <input type="date" name="pubDate" id="pubDate" class="fields"> <br>
                <div class="error" id="errPubDate"></div>

                <label for="bookDesc">Book Description</label><p class="required">*</p><br>
                <div>
                    <textarea class = "textField" name="bookDesc" id="msg" rows="10" cols="40" placeholder="Book Description or Book Summary"></textarea>
                    <div class="error" id="errBookDesc"></div>
                </div>

                <label for="isbn">Book ISBN Number</label><p class="required">*</p><br>
                <input type="text" name="isbn" id="isbn" placeholder="ISBN Number without - (13 characters)" maxlength="13" class="fields"><br>
                <div class="error" id="errISBN"></div>
                            
                <label for="bookLang">Book Language</label><p class="required">*</p><br>
                <input type="text" name="bookLang" id="bookLang" placeholder="Eg: English" class="fields"> <br>
                <div class="error" id="errBookLang"></div>

            </fieldset>
            <br>

            <fieldset>
                <legend class="formGroup">Book Stock Information</legend>
                
                <label for="price">Book Price (RM)</label><p class="required">*</p><br>
                <input type="text" name="price" id="price" placeholder="Eg: 40.50" class="fields"> <br>
                <div class="error" id="errPrice"></div>
                    
                <label for="stock">Stock Available</label><p class="required">*</p><br>
                <input type="text" name="stock" id="stock" placeholder="Enter whole number only" class="fields"><br>
                <div class="error" id="errStock"></div>
                            
                <label for="amount">Amount Sold</label><p class="required">*</p><br>
                <input type="text" name="amount" id="amount" placeholder="Enter whole number only" class="fields"> <br>
                <div class="error" id="errAmount"></div>
            </fieldset>
            <i><p class="required" style = "margin-top: 10px;">*</p> indicates REQUIRED</i><br>

            <button type="submit" id="submitButton" class="submitButton">Create New Book</button>
        </form>
    </div>
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
</body>

<?php
    include 'inc/footer.inc';
?>
