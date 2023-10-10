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
    <title>Create Administrator Account| Administrator</title>

    <link rel="icon" type="image/x-icon" href="images\logo.png" />
    <!-- CSS -->
    <link href = "styles/style.css" rel="stylesheet" />
    <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)" />
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

</head>

<body>
    <?php
        include 'inc/adminHeader.inc.php';
        include 'inc/adminMenu.inc.php';
    ?>
    
    <!-- New Admin Credentials -->
    <div class="bg-text">
    <form method="post" action="inc/loginAdmin.inc.php">
    <fieldset>
        <legend class="formGroup">Create Administrator Account</legend>
        <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "emptyinput"){
                echo "<p class = \"errormessage\">Fill in all fields!*</p>";
            }
            else if($_GET["error"] == "userexists"){
                echo "<p class = \"errormessage\">Administrator account already exists!*</p>";
            }
            else if($_GET["error"] == "pwdnomatch"){
                echo "<p class = \"errormessage\">Password does not match!*</p>";
            }
            else if($_GET["error"] == "success"){
                echo "<p class = \"success\">Administrator account successfully added!</p>";
            }
        }
      ?>
        <label for="username">Username</label><p class="required">*</p><br>
        <input type="text" name="usernameNew" id="usernameNew" placeholder="Admin Username" class="fields" value="<?php echo isset($_SESSION['usernameNew']) ? $_SESSION['usernameNew'] : '' ;?>">
        <br>
        <br>

        <label for="password">Password</label><p class="required">*</p><br>
        <input type="password" name="pwd" id="password" placeholder="Admin Password" class="fields"><br>
        <br>

        <label for="repeatPassword">Repeat Password</label><p class="required">*</p><br>
        <input type="password" name="repeatpwd" id="repeatPassword" placeholder="Repeat Password" class="fields"><br>
        <br>
    </fieldset>

    <i><p class="required" style = "margin-top: 10px;">*</p> indicate REQUIRED field</i><br>
    <input class="submitButton" type="submit" name="signupAdmin" value="Submit" id="submitButton">
    </form>
    </div>
</body>

<?php
    include 'inc/footer.inc';
?>
