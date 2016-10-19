<?php

	class DataRow
	{
		public $value;

		function __construct()
		{
			$this->value= array();
		}

		public function addValue($value)
		{
			array_push($this->value, $value);
		}
	}

?>