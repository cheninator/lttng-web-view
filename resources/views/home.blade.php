@extends('layout.master')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Main Dashboard</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Apache - Top request duration</h3>
            </div>
            <div class="panel-body">
                <div id="chart_div_apache" class="piechart"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> PHP - Top request duration</h3>
            </div>
            <div class="panel-body">
                <div id="chart_div_php" class="piechart"></div>
            </div>
        </div>
    </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> MySQL - Top requests</h3>
                </div>
            <div class="panel-body">
                <div id="chart_div_mysql" class="barchart"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart', 'table']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawApacheChart);
    google.charts.setOnLoadCallback(drawPHPChart);
    google.charts.setOnLoadCallback(drawMySqlChart);

    var piechartOptions = {
        chartArea: {
            width: '100%',
            height: '100%'
        },
        legend: {
            alignment: 'center',
            position: 'right',
            textStyle: {
                fontSize: 15
            }
        }
    }

    function drawApacheChart() {

        var jsonData = $.ajax({
            url: "api/charts/Apache_top_requests_-_Duration",
            dataType: "json",
            async: false
        }).responseText;

        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable(jsonData);

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div_apache'));
        chart.draw(data, piechartOptions);
    }

    function drawPHPChart() {

        var jsonData = $.ajax({
            url: "api/charts/Php_top_requests_-_Duration",
            dataType: "json",
            async: false
        }).responseText;
                
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable(jsonData);

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div_php'));
        chart.draw(data, piechartOptions);
    }

    function drawMySqlChart() {

        var jsonData = $.ajax({
            url: "api/charts/Mysql_Query_statistics_-_Duration",
            dataType: "json",
            async: false
        }).responseText;
                
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable(jsonData);
        data.sort({column: 1, desc: true});

        var options = {
            chartArea: {
                width: '80%',
                height: '80%'
            },
            legend: {
                position: 'none'
            }
        }

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div_mysql'));
        chart.draw(data, options);
    }

</script>
@stop