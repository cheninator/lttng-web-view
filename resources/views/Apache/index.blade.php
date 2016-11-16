@extends('layout.master')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Apache Dashboard</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Apache - Top request duration</h3>
            </div>
            <div class="panel-body">
                <div id="top_apache" class="big_height"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart', 'timeline']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(() => {

        var clone = {};
        drawTimeline("lttng-iolatencytop:Process-start", "top_apache", clone);
    });

    function drawTimeline(file, htmlElement, options) {

        var jsonData = $.ajax({
            url: "api/charts/" + file,
            dataType: "json",
            async: false
        }).responseText;

        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable(jsonData);

        var options = {
            timeline: { groupByRowLabel: true }
        };


        // Setting x axe label
        //options.axes.x[0].label = data.getColumnLabel(1);
        console.log(data.toJSON());
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.Timeline(document.getElementById(htmlElement));
        chart.draw(data, options);
    }

</script>
@stop