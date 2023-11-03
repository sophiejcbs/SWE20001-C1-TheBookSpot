<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="UTF-8" />
    <meta name="description" content="The Book Spot" />
    <meta name="author" content="The Flying Fish" />
    <meta name="keywords" content="The Book Spot Book Management" />
    <title>Complaint Form | The Book Spot</title>

    <link rel="icon" type="image/x-icon" href="images\logo.png" />
    <!-- CSS -->
    <link href = "styles/addBook.css" rel="stylesheet" />
    <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)" />
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    
    <script src="scripts/complaintForm_validation.js"></script>
</head>

<body>
    <?php
        include 'includes/header.inc';
        include 'includes/menu.inc';
    ?>
    <div class="bg-text">
        <form name="complaint_form" method="post" action="complaintForm_posting.php" onsubmit="return validForm()">
            <h1_var2>Complaint Form</h1_var2>
            <fieldset>
                <legend class = "formGroup">Personal Information</legend>
                
                <label for="name">Name of Person Making Complaint </label><p class = "required">*</p><br>
                <input type="text" name="name" id="name" placeholder="John Doe" class = "fields"> <br>
                <div class="error" id="errName"></div>
                    
                <label for="email">Email Address </label><p class = "required">*</p><br>
                <input type="text" name="email" id="email" placeholder="johndoe@example.com" class = "fields"><br>
                <div class="error" id="errEmail"></div>
                            
                <label for="phone">Phone Number </label><p class = "required">*</p><br>
                <input type="phone" name="phone" id="phone" placeholder="Phone Number without -" maxlength="11" class = "fields"> <br>
                <div class="error" id="errPhone"></div>
            </fieldset>
            <br>
            <fieldset>
                <legend class = "formGroup">Complaint Details</legend>
                <div>
                    <label for="dateOfComplaint" >Date of Complaint </label><p class = "required">*</p><br>
                    <input type="date" id="dateOfComplaint" name="dateOfComplaint" class = "fields"> <br>
                    <div class="error" id="errdate"></div>

                    <label for="complaintReason" >Reason of Complaint </label><p class = "required">*</p><br>
                    <select id="complaintReason" name="complaintReason" class = "fields">
                        <option value="none" selected disabled hidden>Choose a Reason</option>
                        <option value="Delayed/Cancelled Order">Delayed/Cancelled Order</option>
                        <option value="Product Condition">Product Condition</option>
                        <option value="Product Authenticity">Product Authenticity</option>
                        <option value="Lack of Product Stock">Lack of Product Stock</option>
                        <option value="Other">Other</option>
                    </select>
                    <div class="error" id="errReason"></div>
                </div>
                
                <label for="complaintDesc">Complaint Description </label><br>
                    <div>
                        <textarea class = "textField" id="msg" name="complaintDesc" rows="10" cols="40"
                        placeholder="Dear The Book Spot Customer Service, I am submitting this form to complain about..."></textarea>
                        <div class="error" id="errDesc"></div>
                    </div>
            </fieldset>
            <i><p class = "required" style = "margin-top: 10px;">*</p> indicates required</i><br>

            <button type="submit" id="submitButton" class="submitButton">Submit your Complaint</button>
        </form>
    </div>
</body>

<?php
    include 'includes/footer.inc';
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