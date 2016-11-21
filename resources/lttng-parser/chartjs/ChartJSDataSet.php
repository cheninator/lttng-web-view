<?php

	class ChartJSDataSet 
	{
		public $label;
		public $data;
		public $backgroundColor;
		public $borderColor;
		public $borderWidth;

		public function __construct()
		{
			$this->data = array();
		}

		public function addData($data)
		{
			array_push($this->data, $data);
		}
	}
	