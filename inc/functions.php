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
                $_SESSION["userid"] = $userid;
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

        //fname and lname length
        if(strlen($firstname)>50 || strlen($lastname)>50){
            header("location: ../signupUser.php?error=namelength");
            exit();
        }

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

        //check if phone is taken
        $userQuery = "SELECT * FROM users WHERE phone = '$phone'";
        $phoneExists = mysqli_query($conn, $userQuery);

        if(mysqli_num_rows($phoneExists)>0){
            //phone taken
            header("location: ../signupUser.php?error=phoneexists");
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
            header("location: ../addAdmin.php?error=userexists");
            exit();
        }

        //check password match
        if(strcmp($pwd, $repeatpwd) !== 0){
            //password does not match
            header("location: ../addAdmin.php?error=pwdnomatch");
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
        header("location: ../addAdmin.php?error=success");
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
            mysqli_stmt_bind_param($stmt,"si",$hashedpwd,$userid);
            mysqli_stmt_execute($stmt);
            if(mysqli_stmt_affected_rows($stmt) > 0){
                header("location: ../user_profile.php?error=pwdsuccess");
                exit();
            }
        }
        else{
            //incorrect old password
            header("location: ../user_profile.php?error=wrongoldpwd");
            exit();
        }
    }

//Edit User Information
    function editAccountInformation($conn, $userid, $fname, $lname){
        $sql = "UPDATE users SET firstName = ?, lastName = ? WHERE userid = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $fname, $lname, $userid);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            userSessionRefresh($conn, $userid);
            header("location: ../user_profile.php?error=namesuccess");
            exit();
        } else {
            mysqli_stmt_close($stmt);
            header("location: ../user_profile.php?error=nameerror");
            exit();
        }
    }

//Valid Postcodes based on state
    function validatePostcode($state, $postcode) {
        $validPostcodes = [
            "Johor" => [80000, 81760],
            "Kedah" => [5000, 9990],
            "Kelantan" => [15000, 19650],
            "Malacca" => [75000, 78200],
            "Negeri Sembilan" => [70000, 73990],
            "Pahang" => [25000, 28700],
            "Penang" => [10000, 14490],
            "Perlis" => [1000, 2800],
            "Sabah" => [88000, 91309],
            "Sarawak" => [93000, 98859],
            "Selangor" => [40000, 48300],
            "Terengganu" => [20000, 24300]
        ];
        
        if (isset($validPostcodes[$state])) {
            $validRange = $validPostcodes[$state];
            return ($postcode >= $validRange[0] && $postcode <= $validRange[1]);
        }
        return false;
    }

//Shipping Information
    function updateShippingAddress($conn, $userid, $address, $city, $state, $postcode){     
        $sql = "UPDATE users SET address = ?, city = ?, state = ?, postcode = ? WHERE userid = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssi", $address, $city, $state, $postcode, $userid);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            userSessionRefresh($conn, $userid);
            header("location: ../user_profile.php?error=addresssuccess");
            exit();
        } else{
            mysqli_stmt_close($stmt);
            header("location: ../user_profile.php?error=addresserror");
            exit();
        }
    }

//Payment Information
    function updatePaymentInformation($conn, $userid, $ccName, $cardNo, $expiry, $cvv, $ccType){
        $sql = "UPDATE users SET ccName = ?, cardNo = ?, expiry = ?, cvv = ?, ccType = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sisis", $ccName, $cardNo, $expiry, $cvv, $ccType);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            userSessionRefresh($conn, $userid);
            header("location: ../user_profile.php?error=paymentsuccess");
            exit();
        } else{
            mysqli_stmt_close($stmt);
            header("location: ../user_profile.php?error=paymenterror");
            exit();
            }
    }


    //Refresh all session variables for users
    function userSessionRefresh($conn, $userid){
        $sql = "SELECT * FROM users WHERE userid = $userid";
        $user = mysqli_fetch_assoc(mysqli_query($conn, $sql));

        //refresh user info in session storage
        $_SESSION["fname"] = $user['firstName'];
        $_SESSION["lname"] = $user['lastName'];
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

    // GET DATA FOR CHART
    // For earning overiew chart
    function earningsData($conn){
        $earningSql = "
            SELECT 
                YEAR(all_months.month_date) AS sales_year,
                MONTH(all_months.month_date) AS sales_month,
                IFNULL(SUM(total_price), 0) AS total_earning
            FROM 
                (
                    SELECT 
                        DATE_ADD(DATE(NOW()), INTERVAL - (a.a + (10 * b.a) + (100 * c.a)) MONTH) AS month_date
                    FROM 
                        (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
                        CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
                ) AS all_months
            LEFT JOIN sales ON MONTH(all_months.month_date) = MONTH(sales.create_at) AND YEAR(all_months.month_date) = YEAR(sales.create_at)
            WHERE 
                all_months.month_date >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
            GROUP BY 
                sales_year, sales_month
            ORDER BY 
                sales_year ASC, sales_month ASC;
        ";

        $result = mysqli_query($conn, $earningSql);
        // Initialize the array with column headers
        $earnings = [['Months', 'Total Earning', ['type' => 'string', 'role' => 'tooltip']]];

        // Fetch data from the result set
        while ($row = mysqli_fetch_assoc($result)) {
            $month = date('M Y', strtotime("{$row['sales_year']}-{$row['sales_month']}-01"));
            $totalearnings=number_format((float)$row['total_earning'], 2);
            $earnings[] = [$month, (float)$row['total_earning'], $month."\nRM".$totalearnings];
        }

        // Convert the PHP array to JSON for use in JavaScript
        $earnings_json = json_encode($earnings);
        return $earnings_json;
    }

    // For best sellers chart
    function getBestSellersData($conn){
        $query="SELECT title, amt_sold FROM books ORDER BY amt_sold DESC LIMIT 6";

        $result = mysqli_query($conn, $query);
        // Initialize the array with column headers
        $data = [['Book Name', 'Amount Sold',['role' => 'style'], ['type' => 'string', 'role' => 'tooltip']]];

        // Color for the bar
        $colors=['#006bcf','#FFA500','#FFD700', '#3eb55a','#2850a6','#f7346b'];
        $count=0;
        // Fetch data from the result set
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = [$row['title'], (int)$row['amt_sold'],$colors[$count], $row['title']."\n".(int)$row['amt_sold']];
            $count++;
        }

        // Convert the PHP array to JSON for use in JavaScript
        $data_json = json_encode($data);
        return $data_json;
    }

    // For genre sales chart
    function getGenreSalesData($conn){
        $query="
        SELECT b.genre, SUM(o.quantity) AS total_amount_sold
        FROM orders o
        JOIN books b ON o.book_id = b.book_id
        GROUP BY b.genre;
        ";

        $result = mysqli_query($conn, $query);
        // Initialize the array with column headers
        $data = [['Genre', 'Amount Sold']];

        // Fetch data from the result set
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = [$row['genre'], (int)$row['total_amount_sold']];
        }

        // Convert the PHP array to JSON for use in JavaScript
        $data_json = json_encode($data);
        return $data_json;
    }
?>
