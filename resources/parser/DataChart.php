<?php
	
	require_once("DataRow.php");
	require_once("DataColumn.php");

	class DataChart 
	{
		public $title;
		public $columns;
		public $rows;

		function __construct() 
		{
			$this->columns = array();
			$this->rows = array();
		}

		public function addColumn(DataColumn $dataColumn) 
		{
			array_push($this->columns, $dataColumn);
		}

		public function addRow(DataRow $row) 
		{
			array_push($this->rows, $row);
		}
	}
