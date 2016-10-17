<?php
	
	class MetadataName 
	{
		const Title = "title";
		const Columns = "columns";
		const ColumnDescription = "column-descriptions";
		const TableClasses = "table-classes";
		const Rows = "rows";
		const Value = "value";
		const ClassName = "class";
	}

	class DataColumn 
	{
		public $title;
		public $class;
	}

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

	class DataChart 
	{
		public $title;
		private $columns;
		private $rows;

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

	class TracingEntry
	{
		private $dataCharts;

		function __construct() 
		{
			$this->dataCharts = array();
		}

		public function addDataChart(DataChart $dataChart) 
		{
			array_push($this->dataCharts, $dataChart);
		}
	}

	class TracingData 
	{
		private $entries;

		function __construct() 
		{
			$this->entries = array();
		}

		public function addTracingEntry(TracingEntry $TracingEntry) 
		{
			array_push($this->entries, $TracingEntry);
		}
	}

	class DataParser 
	{
		private $fileName_;
		private $tracingData;

		function __construct($fileName)
		{
			$this->fileName_ = $fileName;
			$this->tracingData = new TracingData();
		}

		private function readMetadata() 
		{	
 			$fileContent = file_get_contents("{$this->fileName_}.meta");
			$jsonContent = json_decode($fileContent, true);
			$tableClasses =  $jsonContent[MetadataName::TableClasses];

			foreach ($tableClasses as $tc) 
			{	
				$columnDescriptions = $tc[MetadataName::ColumnDescription];
				$TracingEntry = new TracingEntry();
				$columnCount = 0;
				$dataChart = null;
				$baseColumn = null;

				foreach ($columnDescriptions as $cd)
				{
					if ($cd[MetadataName::ClassName] == 'time-range')
						continue;

					if($columnCount == 0)
					{
						// Create a DataChart
						$dataChart = new DataChart();
						$dataChart->title = $tc[MetadataName::Title];

						// Create the first column and set properties
						$dataColumn = new DataColumn();
						$dataColumn->title = $cd[MetadataName::Title];
						$dataColumn->class = $cd[MetadataName::ClassName];
						
						// Save as base column if there is multiple DataCharts 
						$baseColumn = clone $dataColumn;

						// Add Column to DataChart
						$dataChart->addColumn($dataColumn);

						// Add DataChart to TracingEntry
						$TracingEntry->addDataChart($dataChart);

						$columnCount++;
					}
					else if($columnCount == 1) 
					{
						// Change title
						$dataChart->title = "{$tc[MetadataName::Title]}{$cd[MetadataName::Title]}";

						// Create the second column and set properties
						$dataColumn = new DataColumn();
						$dataColumn->title = $cd[MetadataName::Title];
						$dataColumn->class = $cd[MetadataName::ClassName];

						// Add Column to DataChart
						$dataChart->addColumn($dataColumn);

						$columnCount++;
					}
					else if($columnCount > 1)
					{
						// Instanciate other DataCharts
						$dataChart = new DataChart();
						$dataChart->title = "{$tc[MetadataName::Title]}{$cd[MetadataName::Title]}";

						// Add BaseColumn to DataChart
						$dataChart->addColumn($baseColumn);

						// Create the second column and set properties
						$dataColumn = new DataColumn();
						$dataColumn->title = $cd[MetadataName::Title];
						$dataColumn->class = $cd[MetadataName::ClassName];

						// Add 2nd Column to DataChart
						$dataChart->addColumn($dataColumn);

						// Add DataChart to TracingEntry
						$TracingEntry->addDataChart($dataChart);

						$columnCount++;
					}
				}

				$this->tracingData->addTracingEntry($TracingEntry);
			}
		}

		private function readData()
		{
			$fileContent = file_get_contents("{$this->fileName_}.data");
			$data = json_decode($fileContent, true);
		}

		private getClassValue($class, $arr) 
		{
			if ($class == 'process')
			{
				$val = "{$arr['name']} ({$arr['tid']})";
			}
			else if ($class == 'cpu')
			{
				$val = "cpu-{$arr['id']}";
			}
			else
			{
				$val = $arr[MetadataName::Value];
			}

			return $val;
		}

		private getClassType($class)
		{
			$type = null;

			switch($class) 
			{
				case "process" :
				case "cpu" :
					$type = "string";
					break;

				case "ratio" :
				case "int" :
					$type = "number";
					break;

				default: 
					$type = $class;
			}

			return $type;
		}

		public function parse() 
		{
			$this->readMetadata();
			$this->readData();
			//echo print_r($this->tracingData);
			//echo $this->tracingData->toJSON();
		}
	}

	$inputfilename = "data/iolatencyfreq";
	$parser = new DataParser($inputfilename);
	$parser->parse();
?>
