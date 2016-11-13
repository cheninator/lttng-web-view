<?php
	
	require_once("DataColumn.php");

	class Data
	{
		public $column;
		public $values;

		function __construct()
		{
			$this->column = new DataColumn();
			$this->values = array();
		}

		public function addValue($value) 
		{
			array_push($this->values, $value);
		}
	}

