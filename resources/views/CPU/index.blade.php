@extends('layout.master')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">CPU Dashboard</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> CPU Usage</h3>
            </div>
            <div class="panel-body">
                <div id="chart_div_cpu_usage" class="piechart"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> CPU Usage per process</h3>
            </div>
            <div class="panel-body">
                <div id="chart_div_cpu_process" class="piechart"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart', 'table', 'bar']});
        
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawCPUUsageChart);
    google.charts.setOnLoadCallback(drawCPUProcessChart);

    function drawCPUUsageChart() {
        var jsonData = $.ajax({
          url: "api/charts/Per-CPU_top_CPU_usage_-_CPU_usage",
          dataType: "json",
          async: false
        }).responseText;
                  
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable(jsonData);

        var opts = {
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
                    0: { side: 'top', label: data.getColumnLabel(1)} // Top x-axis.
                }
            },
            bar: { groupWidth: "90%" }
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.charts.Bar(document.getElementById('chart_div_cpu_usage'));
        chart.draw(data, opts);
    }

    function drawCPUProcessChart() {
        var jsonData = $.ajax({
          url: "api/charts/Per-TID_top_CPU_usage_-_CPU_usage",
          dataType: "json",
          async: false
        }).responseText;
        
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable(jsonData);

        var opts = {
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
                    0: { side: 'top', label: data.getColumnLabel(1)} // Top x-axis.
                }
            },
            bar: { groupWidth: "90%" }
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.charts.Bar(document.getElementById('chart_div_cpu_process'));
        chart.draw(data, opts);
    }

</script>
@stop