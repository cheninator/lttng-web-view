@extends('layout.master')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">MySQL Dashboard</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Apache top requests</h3>
            </div>
            <div class="panel-body">
                <div id="chart_div_apache"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> PHP top requests</h3>
            </div>
            <div class="panel-body">
                <div id="chart_div_php"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> MySQL top requests - Duration</h3>
            </div>
            <div class="panel-body">
                <div id="chart_div_mysql_bar"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart', 'table']});
        
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawApacheChart);
    google.charts.setOnLoadCallback(drawMySqlChart);

    function drawApacheChart() {
        var jsonData = $.ajax({
          url: "api/charts/Per-TID_Mysql_Query_statistics_-_Total_Mysql_Query_count",
          dataType: "json",
          async: false
        }).responseText;
                  
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable(jsonData);

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div_apache'));
        chart.draw(data);
    }

</script>
@stop