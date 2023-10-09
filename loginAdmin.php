<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="description" content="The Book Spot">
  <meta name="keywords" content="login, HTML5, CSS, PHP">
  <meta name="author" content="Flying Fish">
  <title>Administrator Login - The Book Spot</title>

  <link rel="icon" href="images/logo.png" type="image/x-icon">
  <link href = "styles/login.css" rel="stylesheet">
  <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)"/>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>    
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
  <div class="center">
    <header>
      <a href="loginadmin.php">
        <h1 class="logoLogin"> <i class="fas fa-book text-primary"></i> The Book Spot</h1>
      </a>
    </header>
    <h1 class="loginTitle">Administrator Login</h1>
    <form method="post" action="inc/loginAdmin.inc.php" novalidate>
      <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "emptyinput"){
                echo "<p class = \"errormessage\">Fill in all fields!</p>";
            }
            else if($_GET["error"] == "nouser"){
                echo "<p class = \"errormessage\">Wrong username or password!</p>";
            }
            else if($_GET["error"] == "wrongpwd"){
                echo "<p class = \"errormessage\">Wrong username or password!</p>";
            }
            else if($_GET["error"] == "userexists"){
                echo "<p class = \"errormessage\">User already exists!</p>";
            }
        }
      ?>
        <div class="txt_field">
            <input type="text" name="username" required value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : '' ;?>">
            <span></span>
            <label>Username</label>
        </div>
        <div class="txt_field">
            <input type="password" name="pwd" required>
            <span></span>
            <label>Password</label>
        </div>
            <input class="login" type="submit" name="loginAdmin" value="Login">
            <br><br>
    </form>
  </div>
  </body>
  </html>
</body>