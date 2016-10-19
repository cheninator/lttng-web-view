<?php

	require_once("DataChart.php");

	class TracingEntry
	{
		public $metadata;
		public $dataCharts;

		function __construct() 
		{
			$this->dataCharts = array();
		}

		public function addDataChart(DataChart $dataChart) 
		{
			array_push($this->dataCharts, $dataChart);
		}

		public function getDataChart($index)
		{
			if($index < 0 || $index > count($this->dataCharts))
				return null;

			return $this->dataCharts[$index];
		}
	}

?>