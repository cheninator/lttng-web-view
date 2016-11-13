<?php
	
	require_once("Data.php");

	class IntermediateEntry 
	{
		public $tableclass;
		public $title;
		public $data;

		function __construct()
		{
			$this->data = array();
		}

		public function addData(Data $data) 
		{
			array_push($this->data, $data);
		}
	}

