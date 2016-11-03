<?php

	class DataRow
	{
		public $values;

		function __construct()
		{
			$this->values= array();
		}

		public function addValue($value)
		{
			array_push($this->values, $value);
		}
	}

?>