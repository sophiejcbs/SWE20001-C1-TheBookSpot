<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="description" content="The Book Spot">
  <meta name="keywords" content="login, HTML5, CSS, PHP">
  <meta name="author" content="Flying Fish">
  <title>User Signup - The Book Spot</title>

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
  <div class="centerSignup">
    <header>
      <a href="index.php">
        <h1 class="logoLogin"> <i class="fas fa-book text-primary"></i> The Book Spot</h1>
      </a>
    </header>
    <h1 class="loginTitle">User Sign Up</h1>
    <form method="post" action="inc/loginUser.inc.php" novalidate>
    <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "emptyinput"){
                echo "<p class = \"errormessage\">Fill in all fields!</p>";
            }
            else if($_GET["error"] == "namelength"){
                echo "<p class = \"errormessage\">First and Last name cannot exceed 50 characters!</p>";
            }
            else if($_GET["error"] == "userexists"){
                echo "<p class = \"errormessage\">Username already in use!</p>";
            }
            else if($_GET["error"] == "emailexists"){
                echo "<p class = \"errormessage\">Email already in use!</p>";
            }
            else if($_GET["error"] == "emailformat"){
                echo "<p class = \"errormessage\">Invalid email format!</p>";
            }
            else if($_GET["error"] == "phone"){
                echo "<p class = \"errormessage\">Phone number must be numeric!</p>";
            }
            else if($_GET["error"] == "phoneexists"){
                echo "<p class = \"errormessage\">Phone number already in use!</p>";
            }
            else if($_GET["error"] == "pwdnomatch"){
                echo "<p class = \"errormessage\">Password does not match!</p>";
            }
        }
    ?>
        <div class="row">
            <div class="col-md-6">
                <div class="txt_field">
                    <input type="text" name="firstname" required value="<?php echo isset($_SESSION['firstname']) ? $_SESSION['firstname'] : '' ;?>">
                    <span></span>
                    <label>First Name</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="txt_field">
                    <input type="text" name="lastname" required value="<?php echo isset($_SESSION['lastname']) ? $_SESSION['lastname'] : '' ;?>">
                    <span></span>
                    <label>Last Name</label>
                </div>
            </div>
        </div>
        <div class="txt_field">
            <input type="text" name="username" required value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : '' ;?>">
            <span></span>
            <label>Username</label>
        </div>
        <div class="txt_field">
            <input type="text" name="email" required value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : '' ;?>">
            <span></span>
            <label>Email</label>
        </div>
        <div class="txt_field">
            <input type="text" name="phone" required value="<?php echo isset($_SESSION['phone']) ? $_SESSION['phone'] : '' ;?>">
            <span></span>
            <label>Phone Number</label>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="txt_field">
                    <input type="password" name="pwd" required>
                    <span></span>
                    <label>Password</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="txt_field">
                    <input type="password" name="repeatpwd" required>
                    <span></span>
                    <label>Repeat Password</label>
                </div>
            </div>
        </div>
        <input class="login" type="submit" name="signupUser" value="Signup">
        <a class="signup" href="loginUser.php"><p>Already have an account?</p></a>
    </form>
    <a class="login-switch" href="loginAdmin.php">Admin Login <i class="bi bi-box-arrow-in-right"></i></a>
  </div>
</body>
</html>
