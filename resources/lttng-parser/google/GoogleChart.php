<?php
	
	require_once("GoogleChartColumn.php");
	require_once("GoogleChartRow.php");
	
	class GoogleChart 
	{
		private $title;
		public $cols;
		public $rows;

		public function __construct()
		{	
			$this->cols = array();
			$this->rows = array();
		}

		public function setTitle($title)
		{
			$this->title = $title;
		}

		public function getTitle()
		{
			return $this->title;
		}

		public function addColumn(GoogleChartColumn $column)
		{
			array_push($this->cols, $column);
		}

		public function addRow(GoogleChartRow $row)
		{
			array_push($this->rows, $row);
		}
	}


