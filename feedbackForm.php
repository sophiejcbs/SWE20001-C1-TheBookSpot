<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="UTF-8" />
    <meta name="description" content="The Book Spot" />
    <meta name="author" content="The Flying Fish" />
    <meta name="keywords" content="The Book Spot Book Management" />
    <title>Feedback Form | The Book Spot</title>

    <link rel="icon" type="image/x-icon" href="images\logo.png" />
    <!-- CSS -->
    <link href = "styles/addBook.css" rel="stylesheet" />
    <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)" />
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    
    <script src="scripts/feedbackForm_validation.js"></script>
</head>

<?php
    $url = parse_url($_SERVER['REQUEST_URI']);
    $genre = isset($_GET['genre']) ? $_GET['genre'] : ''; // Check if 'genre' is set, if not, set it to an empty string
    $shade = basename($url['path']);
    include 'inc/header.inc';
    include 'inc/menu.inc';

    // For database connection
    require_once "settings.php";
    $conn = @mysqli_connect ($host, $user, $pwd, $sql_db);

    $loggedIn = false;
    if(isset($_SESSION["userid"])) {
        $loggedIn = true;
    }
?>

<body>
    <?php
        if(!$loggedIn){
            echo<<<EOD
                <div class="bg-text">
                <form name="feedback_form" method="post" action="feedbackForm_posting.php" onsubmit="return validForm()">
                    <h1_var2>Feedback Form</h1_var2>
                    <fieldset>
                        <legend class = "formGroup">Personal Information</legend>
                            <label for="name">Name of Person Giving Feedback </label><p class="required">*</p><br>
                            <input type="text" name="name" id="name" placeholder="John Doe" class="fields"> <br>
                            <div class="error" id="errName"></div>
                            
                            <label for="email-address">Email Address </label><p class="required">*</p><br>
                            <input type="text" name="email" id="email" placeholder="johndoe@example.com" class="fields"> <br>
                            <div class="error" id="errEmail"></div>
                                    
                            <label for="phone">Phone Number </label><p class="required">*</p><br>
                            <input type="text" name="phone" id="phone" placeholder="Phone Number without -" maxlength="11" class="fields"> <br>
                            <div class="error" id="errPhone"></div>
                    </fieldset>
                    <br>
                    <fieldset class = "fieldset">
                        <legend class = "formGroup">Feedback Details</legend>
                        <label for="dateOfFeedback" >Date of Feedback </label><p class="required">*</p><br>
                            <input type="date" id="dateOfFeedback" name="dateOfFeedback" class="fields"> <br>
                            <div class="error" id="errdate"></div>
        
                        <label for="feedbackType" >Feedback Type (Optional)</label><br>
                        <select id="feedbackType" name="feedbackType" class="fields">
                            <option value="none">Choose a Feedback Type</option>
                            <option value="Suggestion">Suggestion</option>
                            <option value="Question">Question</option>
                            <option value="Comment">Comment</option>
                        </select>
        
                        <br><br><label for="Feedback">Feedback Description </label><p class="required">*</p><br>
                            <div>
                                <textarea class = "textField" id="msg" name="feedbackDesc" rows="10" cols="40"
                                placeholder="Dear The Book Spot Customer Service, I am submitting this form to suggest that..."></textarea>
                                <div class="error" id="errFeedDesc"></div>
                            </div>
                    </fieldset>
                    <i><p class="required" style = "margin-top: 10px;">*</p> indicates required</i><br>
        
                    <button type="submit" id="submitButton" class="submitButton">Submit your Feedback</button>
                </form>
                </div>
            EOD;
        }
        else if($loggedIn){
            $query = "SELECT * FROM users WHERE userID LIKE '$_SESSION[userid]'";
            $result = mysqli_query($conn, $query);

            if($result) {
                if($row = mysqli_fetch_assoc($result)) {
                    $fname = $row['firstName']; 
                    $lname = $row['lastName']; 
                    $email = $row['email'];
                    $phone = $row['phone']; 

                    echo<<<EOD
                        <div class="bg-text">
                        <form name="feedback_form" method="post" action="feedbackForm_posting.php" onsubmit="return validForm()">
                            <h1_var2>Feedback Form</h1_var2>
                            <fieldset>
                                <legend class = "formGroup">Personal Information</legend>
                                    <label for="name">Name of Person Giving Feedback </label><p class="required">*</p><br>
                                    <input type="text" name="name" id="name" placeholder="John Doe" class="fields" value="$fname $lname" readonly> <br>
                                    <div class="error" id="errName"></div>
                                    
                                    <label for="email-address">Email Address </label><p class="required">*</p><br>
                                    <input type="text" name="email" id="email" placeholder="johndoe@example.com" class="fields" value="$email" readonly> <br>
                                    <div class="error" id="errEmail"></div>
                                            
                                    <label for="phone">Phone Number </label><p class="required">*</p><br>
                                    <input type="text" name="phone" id="phone" placeholder="Phone Number without -" maxlength="11" class="fields" value="$phone" readonly> <br>
                                    <div class="error" id="errPhone"></div>
                            </fieldset>
                            <br>
                            <fieldset class = "fieldset">
                                <legend class = "formGroup">Feedback Details</legend>
                                <label for="dateOfFeedback" >Date of Feedback </label><p class="required">*</p><br>
                                    <input type="date" id="dateOfFeedback" name="dateOfFeedback" class="fields"> <br>
                                    <div class="error" id="errdate"></div>
                
                                <label for="feedbackType" >Feedback Type (Optional)</label><br>
                                <select id="feedbackType" name="feedbackType" class="fields">
                                    <option value="none">Choose a Feedback Type</option>
                                    <option value="Suggestion">Suggestion</option>
                                    <option value="Question">Question</option>
                                    <option value="Comment">Comment</option>
                                </select>
                
                                <br><br><label for="Feedback">Feedback Description </label><p class="required">*</p><br>
                                    <div>
                                        <textarea class = "textField" id="msg" name="feedbackDesc" rows="10" cols="40"
                                        placeholder="Dear The Book Spot Customer Service, I am submitting this form to suggest that..."></textarea>
                                        <div class="error" id="errFeedDesc"></div>
                                    </div>
                            </fieldset>
                            <i><p class="required" style = "margin-top: 10px;">*</p> indicates required</i><br>
                
                            <button type="submit" id="submitButton" class="submitButton">Submit your Feedback</button>
                        </form>
                        </div>
                    EOD; 
                }
            }
        }
    ?>
</body>

<?php
    include 'inc/footer.inc';
?>

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
