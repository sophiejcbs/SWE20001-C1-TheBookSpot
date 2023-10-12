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
    <title>Profile | Administrator</title>

    <link rel="icon" type="image/x-icon" href="images\logo.png" />
    <!-- CSS -->
    <link href = "styles/admin.css" rel="stylesheet" />
    <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)" />
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
    <?php
        $url = parse_url($_SERVER['REQUEST_URI']);
        $path = $url['path'];
        $shade = basename($path);
        include 'inc/adminHeader.inc';
        include 'inc/adminMenu.inc';
    ?>

<div class="profile-box">
    <div class="profile-blue-box">
        <div class="user-profile">
            <i class="bi bi-person-circle icon-large"></i>
            <p>Welcome, <?php echo $_SESSION["username"]; ?>.</p>
        </div>
    </div>
</div>

<div class="bg-text">
    <form method="post" action="inc/changePassword.inc.php">
    <fieldset>
        <legend class="formGroup">Change password for <?php echo $_SESSION["username"];?></legend>
        <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "emptyinput"){
                echo "<p class = \"errormessage\">Fill in all fields!*</p>";
            }
            else if($_GET["error"] == "wrongoldpwd"){
                echo "<p class = \"errormessage\">Current Password does not match!*</p>";
            }
            else if($_GET["error"] == "oldnewsame"){
                echo "<p class = \"errormessage\">New Passwords cannot be same as the Old Password!*</p>";
            }
            else if($_GET["error"] == "pwdnomatch"){
                echo "<p class = \"errormessage\">New Passwords does not match!*</p>";
            }
            else if($_GET["error"] == "success"){
                echo "<p class = \"success\">Password successfully changed!</p>";
            }
        }
      ?>
        <label for="current_pwd">Current Password</label><p class="required">*</p><br>
        <input type="password" name="pwdold" id="pwdold" placeholder="Admin Password" class="fields"><br>
        <br>

        <label for="password">New Password</label><p class="required">*</p><br>
        <input type="password" name="pwd" id="password" placeholder="New Admin Password" class="fields"><br>
        <br>

        <label for="repeatPassword">Repeat Password</label><p class="required">*</p><br>
        <input type="password" name="repeatpwd" id="repeatPassword" placeholder="Repeat Password" class="fields"><br>
        <br>

        <input type="hidden" name="adminid" value="<?php echo $_SESSION['adminid']; ?>">
    </fieldset>

    <i><p class="required" style = "margin-top: 10px;">*</p> indicate REQUIRED field</i><br>
    <input class="submitButton" type="submit" name="changepwd" value="Submit" id="submitButton">
    </form>
</div>

</body>
<?php
    include 'inc/footer.inc';
?>
