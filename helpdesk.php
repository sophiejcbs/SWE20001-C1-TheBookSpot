<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="UTF-8" />
    <meta name="description" content="The Book Spot" />
    <meta name="author" content="The Flying Fish" />
    <meta name="keywords" content="The Book Spot Customer Helpdesk" />
    <title>Customer Helpdesk | The Book Spot</title>

    <link rel="icon" type="image/x-icon" href="images\logo.png" />
    <!-- CSS -->
    <link href = "styles/helpdesk.css" rel="stylesheet" />
    <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)" />
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<?php
    $url = parse_url($_SERVER['REQUEST_URI']);
    $genre = isset($_GET['genre']) ? $_GET['genre'] : ''; // Check if 'genre' is set, if not, set it to an empty string
    $shade = basename($url['path']);
    include 'inc/header.inc';
    include 'inc/menu.inc';
?>

<body>
    <h1 class = "cta">Facing issues, or have a suggestion? We're here to help.</h1>
    <div class="formContainer">
        <div class = "complaint">
            <p class = "label">Submit Complaint</p><br>
            <img src = "Images/Complaint.png" style = "width: 30%;margin-top:5px;">
            <div class = "descContainer">
                <p>Help us fix problems and improve your experience as a customer by submitting complaints here.</p>
            </div>
            <a class="btn btn-primary complaintFormButton" href="complaintForm.php" role="button">File Complaint</a>
        </div>
    
        <div class = "feedback">
            <p class = "label">Provide Feedback</p><br>
            <img src = "Images/Feedback.png" style = "width: 25%;margin-top:25px;">
            <div class = "descContainer">
                <p style = "margin-top:10px;margin-bottom:30px;">Have a suggestion or comment for The Book Spot that you want to voice out? Submit them here.</p>
            </div>
            <a class="btn btn-primary feedbackFormButton" href="feedbackForm.php" role="button">Provide Feedback</a>
        </div>
    </div>
</body>

<?php
    include 'inc/footer.inc';
?>