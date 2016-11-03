@extends('layout.master')
@section('content')

<div class="row">
  <div class="col-lg-12">
      <h1 class="page-header">Apache Dashboard</h1>
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
@stop