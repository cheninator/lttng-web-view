<?php
	
	require_once("Data.php");

	class IntermediateEntry 
	{
		public $threadId;
		public $tableclass;
		public $title;
		public $data;
		public $startingTime;
		public $endingTime;		

		function __construct()
		{
			$this->data = array();
		}

		public function addData(Data $data) 
		{
			array_push($this->data, $data);
		}

		public function findDataByColumnTitle($titleName) 
		{
			foreach($this->data as $datum) 
			{
				if($datum->column->title == $titleName)
					return $datum;
			}

			return null;
		}
	}
