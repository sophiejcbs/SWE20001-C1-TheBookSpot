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
    <title>Order Records | Administrator</title>

    <link rel="icon" type="image/x-icon" href="images\logo.png" />
    <!-- CSS -->
    <link href = "styles/bookRecord.css" rel="stylesheet" />
    <link href = "styles/orderRecord.css" rel="stylesheet" />
    <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)" />
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<?php
    $url = parse_url($_SERVER['REQUEST_URI']);
    $path = $url['path'];
    $shade = basename($path);
    include 'inc/adminHeader.inc';
    include 'inc/adminMenu.inc';
?>

<body>
    <h2 class="heading">Order Records</h2>

    <?php
        require_once('settings.php');
                
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

        // Checks if connection is successful
        if (!$conn) 
        {
            // Displays an error message
            echo "<p>Database connection failure</p>";
        } 
        else 
        {
            // Upon successful connection
            $sql_table="sales";
            $int = 1;

            $query = "SELECT * FROM $sql_table;";
            $result = mysqli_query($conn, $query);

            //Checks if the execution was successful
            if(!$result) 
            {
                echo "<p>Something is wrong with ", $query, "</p>";
            } 
            else 
            {
                if(mysqli_num_rows($result) > 0) 
                {
                    // Display the retrieved records
                    echo "<div class=\"table-responsive\">";
                    echo "<table id=\"orderTable\" class=\"table table-bordered table-hover\">";
                    echo "<thead class=\"table-dark\">";
                    echo "<tr>\n"
                        ."<th><div class=\"column-width\">#</div></th>\n"
                        ."<th><div class=\"column-width\">Total Price (RM)</div></th>\n"
                        ."<th><div class=\"column-width\">Status</div></th>\n"
                        ."<th><div class=\"column-width\">Date/Time</div></th>\n"
                        ."<th><div class=\"column-width\">User ID</div></th>\n"
                        ."<th><div class=\"column-width\">Guest ID</div></th>\n"
                        ."<th><div class=\"column-width-xl\">Address</div></th>\n"
                        ."<th><div class=\"column-width\">City</div></th>\n"
                        ."<th><div class=\"column-width\">State</div></th>\n"
                        ."<th><div class=\"column-width\">Country</div></th>\n"
                        ."<th><div class=\"column-width\">Postcode</div></th>\n"
                        ."<th><div class=\"column-width\">Name on Credit Card</div></th>\n"
                        ."<th><div class=\"column-width\">Card Type</div></th>\n"
                        ."<th><div class=\"column-width\">Card Number</div></th>\n"
                        ."<th><div class=\"column-width\">Expiry Date</div></th>\n"
                        ."<th><div class=\"column-width\">CVV</div></th>\n"
                        ."<th><div class=\"column-width-l\">Action</div></th>\n"
                        ."</tr>\n";
                    echo "</thead>";
                    // retrieve current record pointed by the result pointer
                    
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $salesID = $row["sales_id"];
                        $currentStatus = $row["status"];

                        echo "<tbody class=\"table-group-divider\">";
                        echo "<tr>";
                        echo "<td>", $row["sales_id"],"</td>";  
                        echo "<td>", $row["total_price"], "</td>";  
                        
                        echo "<td>";
                                echo "<select id = 'statusSelect_$salesID' onchange = 'update($salesID)' name='status' class = 'stateSelect'>";
                                $statusValues = array("PENDING", "FULFILLED", "ARCHIVED");

                                foreach ($statusValues as $status) {
                                    $selected = ($row["status"] == $status) ? 'selected' : '';
                                    echo '<option value="' . $status . '"' . $selected . '>' . $status . '</option>';
                                }

                                echo '</select>';
                        echo "</td>";

                        $formattedDateTime = date('Y-m-d H:i', strtotime($row["create_at"]));
                        echo "<td>", $formattedDateTime, "</td>";
                        echo "<td>", ($row["user_id"] == -1 ? "-" : $row["user_id"]), "</td>";
                        echo "<td>", ($row["guest_id"] == -1 ? "-" : $row["guest_id"]), "</td>";
                        echo "<td>", $row["address"], "</td>";
                        echo "<td>", $row["city"], "</td>";
                        echo "<td>", $row["state"],"</td>";  
                        echo "<td>", $row["country"], "</td>";
                        echo "<td>", $row["postcode"], "</td>";
                        echo "<td>", $row["ccName"], "</td>";
                        echo "<td>", $row["ccType"], "</td>";
                        echo "<td>", $row["cardNo"], "</td>";
                        echo "<td>", $row["expiry"], "</td>";
                        echo "<td>", $row["cvv"], "</td>";

                        echo <<<EOD
                        <td>
                            <form method = "post" action = "updateOrder_posting.php">
                            <input type='hidden' name='sales_id' value=$salesID>

                            <input type='hidden' id = 'newStatus_$salesID' name='status' value=$currentStatus>
                            <input type = 'submit' value = 'Save' class="btn btn-success"/>
                            <a class="btn btn-danger" href="deleteOrder_posting.php?sales_id={$salesID}&status={$currentStatus}" role="button">Delete</a><br>
                            <a class="btn btn-primary" href="orderDetails_admin.php?sales_id={$salesID}" role="button" style = "margin-top: 4%;">More Details</a></td>
                        </td>
                        </form>
EOD;
                        echo "</tr>";
                        echo "</tbody>";
                    }

                    echo "</table>";
                    echo "</div>";

                    // Frees up the memory, after using the result pointer
                    mysqli_free_result($result);
                } // if successful query operation
            } // end if no rows
            mysqli_close($conn);  // close the database connection
        }  
        include 'inc/footer.inc';
    ?>
</body>

<script  type="text/javascript">
    function update(salesID) {
        const statusSelect = document.getElementById("statusSelect_" + salesID);
        const newStatus = document.getElementById("newStatus_" + salesID);
        newStatus.value = statusSelect.value;
    }

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
