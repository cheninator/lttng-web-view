<?php
	
	class GoogleChartColumn 
	{
		public $id;
		public $label;
		public $type;
		public $role;
		public $pattern;
	}

	class GoogleChartRow 
	{
		// Value of the row (Should match the column data type)
		public $v;

		// String formatted version of $value
		public $f;

		// An object that is a map of custom values applied to the cell
		public $p;
	}
	
	class GoogleChart 
	{
		private $fileName_;
		private $metadata_;

		function __construct($fileName)
		{
			$this->fileName_ = $fileName;
		}
	}
?>
