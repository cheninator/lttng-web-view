<?php

	require_once("GoogleChartValue.php");

	class GoogleChartRow 
	{
		public $c;

		public function __construct()
		{
			$this->c = array();
		}

		public function addValue(GoogleChartValue $value)
		{
			array_push($this->c, $value);
		}
	}
	
?>