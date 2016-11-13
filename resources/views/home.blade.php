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
                <div id="top_apache" class="chart-small"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> PHP - Top request duration</h3>
            </div>
            <div class="panel-body">
                <div id="top_php" class="chart-small"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> MySQL - Top table duration</h3>
            </div>
            <div class="panel-body">
                <div id="top_mysql" class="chart-large"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> CPU - Usage per core</h3>
            </div>
            <div class="panel-body">
                <div id="top_cpu" class="chart-large"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart', 'table', 'bar']});
      
    var options = {
        chartArea: {
            width: '80%',
            height: '80%'
        },
        legend: {
            position: 'none'
        },
        bars: 'horizontal',
        axes: {
            x: {
                0: { 
                    side: 'top', label: ''
                }
            }
        },
        bar: { 
            groupWidth: "90%" 
        }
    };

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(() => {

        var clone = JSON.parse(JSON.stringify(options));
        drawBarChart("lamptop:Request_ID-Duration", "top_apache", true, clone);
    });

    google.charts.setOnLoadCallback(() => {

        var clone = JSON.parse(JSON.stringify(options));
        drawBarChart("lamptop:Request_ID-PHP_Execution_Duration", "top_php", true, clone);        
    });

    google.charts.setOnLoadCallback(() => {

        var clone = JSON.parse(JSON.stringify(options));
        drawBarChart("mysql:Table-Duration", "top_mysql", true, clone);       
    });

    google.charts.setOnLoadCallback(() => {

        var clone = JSON.parse(JSON.stringify(options));
        drawBarChart("cpuusage:CPU-CPU_usage", "top_cpu", false, clone);       
    });

    function drawBarChart(file, htmlElement, descending, options) {

        var jsonData = $.ajax({
            url: "api/charts/" + file,
            dataType: "json",
            async: false
        }).responseText;

        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable(jsonData);
        
        if(descending) {
            data.sort({column: 1, desc: true});
        }

        // Setting x axe label
        options.axes.x[0].label = data.getColumnLabel(1);

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.charts.Bar(document.getElementById(htmlElement));
        chart.draw(data, options);
    }

</script>
@stop