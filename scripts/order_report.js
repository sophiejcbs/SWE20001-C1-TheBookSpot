// Draw Line Chart
function drawLineChart(id, dataTable) {
    var data = google.visualization.arrayToDataTable(dataTable);

    var chart = new google.visualization.LineChart(document.getElementById(id));

    var options = {
        colors: ['#1B99D4'],
        pointSize: 10,
        legend: {position: 'none'},
        vAxis: { format:'RM #,###.##'},
        chartArea: {'width': '80%', 'height': '85%'}
    };

    chart.draw(data, options);
}

// Draw Bar Chart
function drawBarChart(id, dataTable){
    var data = google.visualization.arrayToDataTable(dataTable);
    var chart = new google.visualization.BarChart(document.getElementById(id));
    var options = {
        legend: {position: 'none'},
        chartArea: {'right':'3%', 'height': '85%'}
    };
    chart.draw(data, options);
}

// Draw Pie Chart
function drawPieChart(id, dataTable){
    var data = google.visualization.arrayToDataTable(dataTable);
    var chart = new google.visualization.PieChart(document.getElementById(id));
    var options = {
        legend: {position: 'bottom'},
        chartArea: {'left':'5%','right':'5%'},
        pieSliceText: 'value'
    };
    chart.draw(data, options);
}