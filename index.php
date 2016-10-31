<html>
  <head>
    <meta charset="utf-8">
    <title>LTTng Web View</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  </head>

  <body>
    <div id="wrapper">
      <!-- Navigation -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">LTTng Web View</a>
          </div>
          <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
          <div class="collapse navbar-collapse navbar-ex1-collapse">
              <ul class="nav navbar-nav side-nav">
                  <li class="active">
                      <a href="#"><i class="fa fa-fw fa-dashboard"></i> Main dashboard</a>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> Apache</a>
                  </li>
                  <li>
                      <a href="#"><i class="fa fa-fw fa-table"></i> MySQL</a>
                  </li>
                  <li>
                      <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> PHP</a>
                  </li>
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </nav>
      <div id="page-wrapper">

          <div class="container-fluid">

              <!-- Page Heading -->
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">
                          Main Dashboard
                      </h1>
                  </div>
              </div>
              <!-- /.row -->

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
              <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
      </div>
      <!-- /#page-wrapper -->
    </div>
  </body>

  <script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart', 'table']});
        
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawApacheChart);
    google.charts.setOnLoadCallback(drawPHPChart);
    google.charts.setOnLoadCallback(drawMySqlChart);

    function drawApacheChart() {
      
        var jsonData = $.ajax({
          url: "dataGetFromFiles.php?n=Apache_top_requests_-_Duration",
          dataType: "json",
          async: false
        }).responseText;
                  
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable(jsonData);

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div_apache'));
        chart.draw(data, {width: 500, height: 540});
    }

    function drawPHPChart() {

        var jsonData = $.ajax({
          url: "dataGetFromFiles.php?n=Php_top_requests_-_Duration",
          dataType: "json",
          async: false
        }).responseText;
                  
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable(jsonData);

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div_php'));
        chart.draw(data, {width: 500, height: 540});
    }

    function drawMySqlChart() {
      
        var jsonData = $.ajax({
          url: "dataGetFromFiles.php?n=Mysql_Query_statistics_-_Duration",
          dataType: "json",
          async: false
        }).responseText;
                  
        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable(jsonData);
        data.sort({column: 1, desc: true});

        var options = {
          width: 1500,
          height: 540,
          legend: 'none'
        }

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div_bar'));
        chart.draw(data, options);
    }

  </script>
</html>
