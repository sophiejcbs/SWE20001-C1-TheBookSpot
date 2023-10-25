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
    <meta charset="utf‐8" /> 
    <meta name="description" content="SWE20001 The Book Spot"/>
    <meta name="keywords" content="book, store"/> 
    <meta name="author"   content="The Flying Fish" />
    <title>The Book Spot</title>
    
    <link rel="icon" type="image/x-icon" href="images\logo.png">
    <!-- CSS -->
    <link href = "styles/style.css" rel="stylesheet">
    <link href = "styles/responsive.css" rel="stylesheet" media ="screen and (max-width:1024px)"/>
    <link href = "styles/orderReport.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- For Chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

</head>
<body>
    <!-- Header & Menu -->
    <?php
        include 'inc/adminHeader.inc';
        include 'inc/adminMenu.inc';

        // For database connection
        require_once "settings.php";

        function getValueCard($query, $conn, $col){
            $result = mysqli_query($conn, $query);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $value = ($row[$col] !== null) ? $row[$col] : 0;
            } 
            else{
                $value ='NA';
            }

            return $value;
        }
    ?>
    <h2 class="heading">Order Report</h2>

    <!-- CARD -->
    <div class="cards_row">
        <!-- Amount of books sold (Daily) -->
        <div class="cards border-left-blue">
            <div class="col">
                <h5 class="title">Amount sold (Daily)</h5>
                <p class="value">
                    <?php
                        $query = "SELECT SUM(orders.quantity) AS total_quantity
                        FROM sales
                        INNER JOIN orders ON sales.sales_id = orders.sales_id
                        WHERE DATE(sales.create_at) = CURDATE()";
                        echo getValueCard($query, $conn, 'total_quantity');
                    ?>
                </p>
            </div>
            <div class="icon">
                <i class="bi bi-arrow-up-right-circle fs-1"></i>
            </div>
        </div>

        <!-- Earnings (Daily) -->
        <div class="cards border-left-green">
            <div class="col">
                <h5 class="title">Earnings (Daily)</h5>
                <p class="value">
                    <?php
                        $query = "SELECT SUM(total_price) AS daily_earn
                        FROM sales
                        WHERE DATE(create_at) = CURDATE()";
                        $daily_earn=getValueCard($query, $conn, 'daily_earn');
                        $daily_earn= number_format($daily_earn, 2);
                        echo 'RM '.$daily_earn;
                    ?>
                </p>
            </div>
            <div class="icon">
                <i class="bi bi-currency-dollar fs-1"></i>
            </div>
        </div>

        <!-- Earnings (Monthly) -->
        <div class="cards border-left-cyan">
            <div class="col">
                <h5 class="title">Earnings (Monthly)</h5>
                <p class="value">
                    <?php
                        $query = "SELECT SUM(total_price) AS monthly_earn
                        FROM sales
                        WHERE MONTH(create_at) = MONTH(CURDATE()) AND YEAR(create_at) = YEAR(CURDATE())";
                        $monthly_earn=getValueCard($query, $conn, 'monthly_earn');
                        $monthly_earn= number_format($monthly_earn, 2);
                        echo 'RM '.$monthly_earn;
                    ?>
                </p>
            </div>
            <div class="icon">
                <i class="bi bi-calendar fs-1"></i>
            </div>
        </div>

        <!-- Earnings (Monthly) -->
        <div class="cards border-left-yellow">
            <div class="col">
                <h5 class="title">Pending Order</h5>
                <p class="value">
                    <?php
                        $query = "SELECT COUNT(sales_id) AS pending_count
                        FROM sales
                        WHERE status='PENDING'";
                        $pending=getValueCard($query, $conn, 'pending_count');
                        echo $pending;
                    ?>
                </p>
            </div>
            <div class="icon">
                <i class="bi bi-card-list fs-1"></i>
            </div>
        </div>
    </div>

    <!-- CHART -->
    <?php
        include_once 'inc/functions.php';
    ?>
    <div class="chartsec">
        <div class="chart linechart">
            <h2 class="charttitle">Earnings Overview</h2>
            <div id="earningsOverview" class="chartsize"></div>
        </div>
        <div class="chart barchart">
            <h2 class="charttitle">Best Sellers</h2>
            <div id="bestSellers" class="chartsize"></div>
        </div>
        <div class="chart piechart">
            <h2 class="charttitle">Book Genre</h2>
            <div id="genresales" class="chartsize"></div>
        </div>
    </div>

    <!-- JS for chart -->
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        // Draw Charts
        google.charts.setOnLoadCallback(earningsOverview);
        google.charts.setOnLoadCallback(bestsellers);
        google.charts.setOnLoadCallback(genresales);

        // Draw Earning Overview
        function earningsOverview() {
            var dataTable=<?php echo earningsData($conn);?>;
            var data = google.visualization.arrayToDataTable(dataTable);

            var chart = new google.visualization.LineChart(document.getElementById('earningsOverview'));

            var options = {
                colors: ['#1B99D4'],
                pointSize: 10,
                legend: {position: 'none'},
                vAxis: { format:'RM #,###.##'},
                chartArea: {'width': '80%', 'height': '85%'}
            };

            chart.draw(data, options);
        }

        // Draw Best Sellers
        function bestsellers(){
            var dataTable=<?php echo getBestSellersData($conn);?>;
            var data = google.visualization.arrayToDataTable(dataTable);
            var chart = new google.visualization.BarChart(document.getElementById('bestSellers'));
            var options = {
                legend: {position: 'none'},
                chartArea: {'right':'3%', 'height': '85%'}
            };
            chart.draw(data, options);
        }

        // Draw Genre Sales
        function genresales(){
            var dataTable=<?php echo getGenreSalesData($conn);?>;
            var data = google.visualization.arrayToDataTable(dataTable);
            var chart = new google.visualization.PieChart(document.getElementById('genresales'));
            var options = {
                legend: {position: 'bottom'},
                chartArea: {'left':'5%','right':'5%'},
                pieSliceText: 'value'
            };
            chart.draw(data, options);
        }
    </script>

    <?php
        include_once 'inc/footer.inc';
    ?>
</body>
</html>
