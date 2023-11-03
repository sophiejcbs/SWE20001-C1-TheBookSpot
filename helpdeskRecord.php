<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="UTF-8" />
    <meta name="description" content="The Book Spot" />
    <meta name="author" content="The Flying Fish" />
    <meta name="keywords" content="The Book Spot Helpdesk Management" />
    <title>Helpdesk Record | Administrator</title>

    <link rel="icon" type="image/x-icon" href="images\logo.png" />
    <!-- CSS -->
    <link href = "styles/helpdeskRecord.css" rel="stylesheet" />
    <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)" />
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<?php
    include 'includes/header.inc';
    include 'includes/menu.inc';
?>

<body>
    <h2 class="heading">Helpdesk Record</h2>
</body>

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
        $sql_table="support";
        $int1 = 1;
        $int2 = 1;

        //Pagination Variable
        $page_size = 5;
        $current_page1 = isset($_GET['page1']) ? $_GET['page1'] : 1;
        $offset1 = ($current_page1 - 1) * $page_size;
        
        $current_page2 = isset($_GET['page2']) ? $_GET['page2'] : 1;
        $offset2 = ($current_page2 - 1) * $page_size;

        $query1 = "SELECT * FROM $sql_table where type = 'complaint' ORDER BY report_date ASC LIMIT $offset1, $page_size;";
        $result1 = mysqli_query($conn, $query1);

        $query2 = "SELECT * FROM $sql_table where type = 'feedback' ORDER BY report_date ASC LIMIT $offset2, $page_size;";
        $result2 = mysqli_query($conn, $query2);

        //Checks if the execution was successful
        if(!$result1 || !$result2) 
        {
            if(!$result1) echo "<p>No Complaint Record(s) found.</p>";
            if(!$result2) echo "<p>No Feedback Record(s) found.</p>";
        } 
        else 
        {
            if(mysqli_num_rows($result1) > 0) 
            {
                echo "<h2 class=\"tableheading\">Complaint Record</h2>\n";
                // Display the retrieved records
                echo "<div class=\"table-responsive\">";
                echo "<table id=\"bookTable\" class=\"table table-bordered table-hover\">";
                echo "<thead class=\"table-dark\">";
                
                echo "<tr>\n"
                    ."<th><div class=\"column-width\">#</div></th>\n"
                    ."<th><div class=\"column-width\">Customer ID</div></th>\n"
                    ."<th><div class=\"column-width\">Customer Name</div></th>\n"
                    ."<th><div class=\"column-width\">Customer Email</div></th>\n"
                    ."<th><div class=\"column-width\">Customer Phone Number</div></th>\n"
                    ."<th><div class=\"column-width\">Complaint Reason</div></th>\n"
                    ."<th><div class=\"column-width-xl\">Complaint Description</div></th>\n"
                    ."<th><div class=\"column-width\">Complaint Date</div></th>\n"
                    ."</tr>\n";
                echo "</thead>";
                // retrieve current record pointed by the result pointer
                
                while ($row = mysqli_fetch_assoc($result1))
                {
                    echo "<tbody class=\"table-group-divider\">";
                    echo "<tr>";
                    echo "<td>", ($int1++) + $offset1,"</td>";  
                    echo "<td>", $row["customer_id"], "</td>";  
                    echo "<td>", $row["name"], "</td>";
                    echo "<td>", $row["email"], "</td>";
                    echo "<td>", $row["phone"], "</td>";
                    echo "<td>", $row["reason"], "</td>";
                    echo "<td><div class=\"description-row\">", $row["description"], "</div></td>";
                    echo "<td>", $row["report_date"], "</td>";
                    echo "</tr>";
                    echo "</tbody>";
                }
                echo "</table>";
                echo "</div>";

                //Pagination Footer
                $countQuery1 = "SELECT COUNT(*) as records FROM $sql_table where type = 'complaint'";
                $record1 = mysqli_query($conn, $countQuery1);
                $row1 = mysqli_fetch_assoc($record1);
                $recordCount1 = $row1['records'];
                $total_pages1 = ceil($recordCount1 / $page_size);

                echo '<div class="pagination">';
                if ($current_page1 > 1) {
                    echo '<a class="btn" href="?page1=' . ($current_page1 - 1) . '"><i class="fas fa-angle-left"></i></a>';
                }
                for ($i = 1; $i <= $total_pages1; $i++) {
                    echo '<a class="btn" href="?page1=' . $i . '">' . $i . '</a>';
                }
                if ($current_page1 < $total_pages1) {
                    echo '<a class="btn" href="?page1=' . ($current_page1 + 1) . '"><i class="fas fa-angle-right"></i></a>';
                }
                echo '</div>';

                // Frees up the memory, after using the result pointer
                mysqli_free_result($result1);
            } // if successful query operation

            echo "<br>"; 

            if(mysqli_num_rows($result2) > 0) 
            {
                echo "<h2 class=\"tableheading\">Feedback Record</h2>\n";
                // Display the retrieved records
                echo "<div class=\"table-responsive\">";
                echo "<table id=\"bookTable\" class=\"table table-bordered table-hover\">";
                echo "<thead class=\"table-dark\">";
                echo "<tr>\n"
                    ."<th><div class=\"column-width\">#</div></th>\n"
                    ."<th><div class=\"column-width\">Customer ID</div></th>\n"
                    ."<th><div class=\"column-width\">Customer Name</div></th>\n"
                    ."<th><div class=\"column-width\">Customer Email</div></th>\n"
                    ."<th><div class=\"column-width\">Customer Phone Number</div></th>\n"
                    ."<th><div class=\"column-width\">Feedback Type</div></th>\n"
                    ."<th><div class=\"column-width-xl\">Feedback Description</div></th>\n"
                    ."<th><div class=\"column-width\">Feedback Date</div></th>\n"
                    ."</tr>\n";
                echo "</thead>";
                // retrieve current record pointed by the result pointer
                
                while ($row = mysqli_fetch_assoc($result2))
                {
                    echo "<tbody class=\"table-group-divider\">";
                    echo "<tr>";
                    echo "<td>", ($int2++) + $offset2 ,"</td>";  
                    echo "<td>", $row["customer_id"], "</td>";  
                    echo "<td>", $row["name"], "</td>";
                    echo "<td>", $row["email"], "</td>";
                    echo "<td>", $row["phone"], "</td>";
                    echo "<td>", $row["reason"], "</td>";
                    echo "<td><div class=\"description-row\">", $row["description"], "</div></td>";
                    echo "<td>", $row["report_date"], "</td>";
                    echo "</tr>";
                    echo "</tbody>";
                }
                echo "</table>";
                echo "</div>";

                //Pagination Footer
                $countQuery2 = "SELECT COUNT(*) as records FROM $sql_table where type = 'feedback'";
                $record2 = mysqli_query($conn, $countQuery2);
                $row2 = mysqli_fetch_assoc($record2);
                $recordCount2 = $row2['records'];
                $total_pages2 = ceil($recordCount2 / $page_size);

                echo '<div class="pagination">';
                if ($current_page2 > 1) {
                    echo '<a class="btn" href="?page2=' . ($current_page2 - 1) . '"><i class="fas fa-angle-left"></i></a>';
                }
                for ($i = 1; $i <= $total_pages2; $i++) {
                    echo '<a class="btn" href="?page2=' . $i . '">' . $i . '</a>';
                }
                if ($current_page2 < $total_pages2) {
                    echo '<a class="btn" href="?page2=' . ($current_page2 + 1) . '"><i class="fas fa-angle-right"></i></a>';
                }
                echo '</div>';

                // Frees up the memory, after using the result pointer
                mysqli_free_result($result2);
            } // if successful query operation
        } // end if no rows
        mysqli_close($conn);  // close the database connection
    }  
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