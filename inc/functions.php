<?php
    //php file for function declaration

    //Sanitize input data
    //htmlspecialchars => Converts special chars to HTML entity
    //stripslashes => Removes backslashes
    //trim => Removes leading and trailing whitespaces
    function sanitizeInput($input){
        $input = htmlspecialchars(stripslashes(trim($input)));
        return $input;
    }

    //Log In validate input
    function emptyInput($username,$pwd){
        if(empty($username)||trim($pwd) === ''){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    //Sign up validate input
    function emptySignupInput($firstname, $lastname, $username, $email, $phone, $pwd, $repeatpwd) {
        if (empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($phone) || empty($pwd) || empty($repeatpwd)) {
            return true;
        }
        return false;
    }

    //Log In Users
    function loginUser($conn, $username, $pwd){
        $userQuery = "SELECT * FROM users WHERE username = '$username' OR email = '$username'";
        $userExists = mysqli_query($conn, $userQuery);

        //user does not exist
        if(mysqli_num_rows($userExists)==0){
            header("location: ../loginUser.php?error=nouser");
            exit();
        }

        //user exists
        //validate password
        else{
            $user = mysqli_fetch_assoc($userExists);
            $userid = $user['userID'];
            $username = $user['username'];
            $hashedPwd = $user['pwd'];
            
            if(password_verify($pwd,$hashedPwd)){
                //start session when password is verified
                session_start();
                $_SESSION["userid"] = mysqli_insert_id($conn); //session with user's id
                $_SESSION["username"] = $username;
                //store user info into session storage
                $_SESSION["fname"] = $user['firstName'];
                $_SESSION["lname"] = $user['lastName'];
                $_SESSION["email"] = $user['email'];
                $_SESSION["phone"] = $user['phone'];
                $_SESSION["address"] = $user['address'];
                $_SESSION["country"] = $user['country'];
                $_SESSION["city"] = $user['city'];
                $_SESSION["state"] = $user['state'];
                $_SESSION["postcode"] = $user['postcode'];
                $_SESSION["ccName"] = $user['ccName'];
                $_SESSION["cardno"] = $user['cardNo'];
                $_SESSION["expiry"] = $user['expiry'];
                $_SESSION["cvv"] = $user['cvv'];
                $_SESSION["ccType"] = $user['ccType'];
                
                header("location: ../index.php");
                exit();
            }
            else{
                //password incorrect
                header("location: ../loginUser.php?error=wrongpwd");
                exit();
            }
        }
    }

    //Sign Up Users
    function signupUser($conn, $firstname, $lastname, $username, $email, $phone, $pwd, $repeatpwd){

        //check if username is taken
        $userQuery = "SELECT * FROM users WHERE username = '$username'";
        $userExists = mysqli_query($conn, $userQuery);

        if(mysqli_num_rows($userExists)>0){
            //username taken
            header("location: ../signupUser.php?error=userexists");
            exit();
        }

        //check if email is taken
        $userQuery = "SELECT * FROM users WHERE email = '$email'";
        $emailExists = mysqli_query($conn, $userQuery);

        if(mysqli_num_rows($emailExists)>0){
            //email taken
            header("location: ../signupUser.php?error=emailexists");
            exit();
        }

        //check email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //email format error
            header("location: ../signupUser.php?error=emailformat");
            exit();
        }

        //check if phone is numeric only
        if(preg_match('/^[0-9]+$/', $phone) == false ){
            //phone is not numeric only
            header("location: ../signupUser.php?error=phone");
            exit();
        }

        //check password match
        if(strcmp($pwd, $repeatpwd) !== 0){
            //passwprd does not match
            header("location: ../signupUser.php?error=pwdnomatch");
            exit();
        }
        //all validation passed
        //hash password to store into database
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        //add user to users table
        $addUserQuery = "INSERT INTO users (firstname, lastname, username, email, phone, pwd) VALUES ('$firstname','$lastname','$username','$email','$phone','$hashedPwd')";
        mysqli_query($conn, $addUserQuery);

        //start session with userid
        session_start();
        $_SESSION["userid"] = mysqli_insert_id($conn); //most recently inserted primary key while $connection is still open
        $_SESSION["username"] = $username;
        //store user info into session storage
        $_SESSION["fname"] = $firstname;
        $_SESSION["lname"] = $lastname;
        $_SESSION["email"] = $email;
        $_SESSIOM["phone"] = $phone;

        //fetch user information and prepare session storage
        $userQuery = "SELECT * FROM users WHERE username = '$username'";
        $userExists = mysqli_query($conn, $userQuery);
        $user = mysqli_fetch_assoc($userExists);
        $_SESSION["address"] = $user['address'];
        $_SESSION["country"] = $user['country'];
        $_SESSION["city"] = $user['city'];
        $_SESSION["state"] = $user['state'];
        $_SESSION["postcode"] = $user['postcode'];
        $_SESSION["ccName"] = $user['ccName'];
        $_SESSION["cardno"] = $user['cardNo'];
        $_SESSION["expiry"] = $user['expiry'];
        $_SESSION["cvv"] = $user['cvv'];
        $_SESSION["ccType"] = $user['ccType'];
        
        header("location: ../index.php");
        exit();
        }

    //Log In Administrators
    function loginAdmin($conn, $username, $pwd){
        //check if user admin exists
        $userQuery = "SELECT * FROM admins WHERE username = '$username'";
        $userExists = mysqli_query($conn,$userQuery);
        if(mysqli_num_rows($userExists) == 0){
            //admin does not exist
            header("location: ../loginAdmin.php?error=nouser");
            exit();
        }
        else{
            //admin exists
            //validate password
            $admin = mysqli_fetch_assoc($userExists);
            $adminid = $admin['adminID'];
            $username = $admin['username'];
            $hashedPwd = $admin['pwd'];
            if(password_verify($pwd,$hashedPwd)){
                //start session with userid
                session_start();
                $_SESSION["adminid"] = $adminid;
                $_SESSION["username"] = $username;
                header("location: ../bookRecord.php");
                exit();
            }
            else{
                //incorrect password
                header("location: ../loginAdmin.php?error=wrongpwd");
                exit();
            }
        }
    }

    //Sign Up Administrators
    function signupAdmin($conn, $username, $pwd, $repeatpwd){
        $userQuery = "SELECT * FROM admins WHERE username = '$username'";
        $userExists = mysqli_query($conn,$userQuery);

        //check if username is taken
        if(mysqli_num_rows($userExists)>0){
            //username taken
            header("location: ../add_admin.php?error=userexists");
            exit();
        }

        //check password match
        if(strcmp($pwd, $repeatpwd) !== 0){
            //password does not match
            header("location: ../add_admin.php?error=pwdnomatch");
            exit();
        }

        //valid account
        //hash password to store into database
        $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);
        //add user to admins table
        $addUserQuery = "INSERT INTO admins (username, pwd) VALUES ('$username','$hashedPwd')";
        mysqli_query($conn, $addUserQuery);
        //start session with userid
        session_start();
        $_SESSION["userid"] = mysqli_insert_id($conn);
        $_SESSION["username"] = $username;
        header("location: ../add_admin.php?error=success");
        exit();
    }

    //Change Admin Account Password
    function changePasswordAdmin($conn, $adminid, $pwdold, $pwd, $repeatpwd){
        $adminQuery = "SELECT * FROM admins WHERE adminID = '$adminid'";
        $adminExists = mysqli_query($conn,$adminQuery);
        $admin = mysqli_fetch_assoc($adminExists);
        $oldpwd_hashed = $admin['pwd'];

        //validate old password match
        if(password_verify($pwdold,$oldpwd_hashed)){
            //old and new password cannot be same
            if(strcmp($pwdold,$pwd) == 0){
                header("location: ../admin_profile.php?error=oldnewsame");
                exit();
            }

            //check password match
            if(strcmp($pwd, $repeatpwd) !== 0){
                //password does not match
                header("location: ../admin_profile.php?error=pwdnomatch");
                exit();
            }

            //hash password to replace old hash
            $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);
            $sql = "UPDATE admins SET pwd = ? WHERE adminid = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt,"si",$hashedPwd,$adminid);
            mysqli_stmt_execute($stmt);
            if(mysqli_stmt_affected_rows($stmt) > 0){
                header("location: ../admin_profile.php?error=success");
                exit();
            }
        }
        else{
            //incorrect old password
            header("location: ../admin_profile.php?error=wrongoldpwd");
            exit();
        }
    }

    //Change User Account Password
    function changePasswordUser($conn, $userid, $pwdold, $pwd, $repeatpwd){
        $userQuery = "SELECT * FROM users WHERE userid = '$userid'";
        $userExists = mysqli_query($conn, $userQuery);
        $user = mysqli_fetch_assoc($userExists);
        $oldpwd_hashed = $user['pwd'];

        //validate old password match
        if(password_verify($pwdold, $oldpwd_hashed)){
            //old and new password cannot be same
            if(strcmp($pwdold, $pwd) == 0){
                header("location: ../user_profile.php?error=oldnewsame");
                exit();
            }

            //check password match
            if(strcmp($pwd, $repeatpwd) !== 0){
                //password does not match
                header("location: ../user_profile.php?error=pwdnomatch");
                exit();
            }

            //hash password to replace old hash
            $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET pwd = ? WHERE userid = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt,"si",$hashedPwd,$userid);
            mysqli_stmt_execute($stmt);
            if(mysqli_stmt_affected_rows($stmt) > 0){
                header("location: ../user_profile.php?error=success");
                exit();
            }
        }
        else{
            //incorrect old password
            header("location: ../user_profile.php?error=wrongoldpwd");
            exit();
        }
    }

//Display Book Catalogue
    function bookCatDisplay($conn,$query){
        $result = mysqli_query($conn, $query);

            if ($conn){
                if($result) {
                    if (mysqli_num_rows($result) == 0) {
                        // No matching records found
                        echo "<h3>No book found...<h3>";
                    } 
                    else{
                        while ($row = mysqli_fetch_assoc($result)) {

                            // Extract data for each book
                            $id=$row['book_id'];
                            $imgSrc = $row['image']; 
                            $bookTitle = $row['title']; 
                            $price = $row['price']; 
    
                            //Stock status
                            if ($row['stock']>0){
                                $stockIndicator = "instock";
                                $stockTxt="In Stock";
                            }
                            else{
                                $stockIndicator = "outstock";
                                $stockTxt="Out of Stock";
                            }
    
                            // Display book
                            echo <<<EOD
                            <div class="bookCard">
                                <a href="book_details.php?book_id=$id">
                                    <img src="$imgSrc">
                                    <p class = "bookTitle">$bookTitle</p>
                                </a>
                                
                                <p class="price">RM$price</p>
                                <p class="$stockIndicator" ><i class="bi bi-circle-fill"></i> <span class="stockTxt">$stockTxt</span></p>
                            </div>
    EOD;
                        }
                    }                    
                }
            }
    }

?>
