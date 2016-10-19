<?php

	require_once("DataChart.php");
	require_once("TracingData.php");
	require_once("TracingEntry.php");

	class MetadataName 
	{
		const Title = "title";
		const Columns = "columns";
		const ColumnDescription = "column-descriptions";
		const TableClasses = "table-classes";
		const Rows = "rows";
		const Value = "value";
		const ClassName = "class";
		const Inherit = "inherit";
		const Data = "data";
		const Name = "name";
		const TID = "tid";
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

			foreach ($tableClasses as $key => $tc) 
			{	
				$columnDescriptions = $tc[MetadataName::ColumnDescription];
				$tracingEntry = new TracingEntry();
				$tracingEntry->metadata = $key;

				$columnCount = 0;
				$dataChart = null;
				$baseColumn = null;

				foreach ($columnDescriptions as $cd)
				{
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

						// Add DataChart to tracingEntry
						$tracingEntry->addDataChart($dataChart);

						$columnCount++;
					}
					else if($columnCount == 1) 
					{
						// Change title
						$dataChart->title = "{$tc[MetadataName::Title]} - {$cd[MetadataName::Title]}";

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
						$dataChart->title = "{$tc[MetadataName::Title]} - {$cd[MetadataName::Title]}";

						// Add BaseColumn to DataChart
						$dataChart->addColumn($baseColumn);

						// Create the second column and set properties
						$dataColumn = new DataColumn();
						$dataColumn->title = $cd[MetadataName::Title];
						$dataColumn->class = $cd[MetadataName::ClassName];

						// Add 2nd Column to DataChart
						$dataChart->addColumn($dataColumn);

						// Add DataChart to tracingEntry
						$tracingEntry->addDataChart($dataChart);

						$columnCount++;
					}
				}

				$this->tracingData->addTracingEntry($tracingEntry);
			}
		}

		private function readData()
		{
			$fileContent = file_get_contents("{$this->fileName_}.data");
			$data = json_decode($fileContent, true);

			$results = $data['results'];

			foreach($results as $result)
			{
				$class = $result[MetadataName::ClassName];

				// If we have an inherit class data
				$metadata = isset($class[MetadataName::Inherit]) ? $class[MetadataName::Inherit] : $class;

				// Get the tracing entry object in tracingData
				$tracingEntry = $this->tracingData->getTracingEntry($metadata);

				// Treat data
				foreach ($result[MetadataName::Data] as $data) 
				{
					$baseDatum = $data[0];
					$dataRow = new DataRow();
					$value = $this->getClassValue($baseDatum);
					$dataRow->addValue($value);

					for($i = 1; $i < count($data); ++$i)
					{
						$value = isset($data[$i][MetadataName::Value]) ? $data[$i][MetadataName::Value] : $data[$i];
						$dataChartRow = clone $dataRow;
						$dataChartRow->addValue($value);

						// Element of position i for data will match dataChart[0]
						$dataChart = $tracingEntry->getDataChart($i - 1);

						if(isset($dataChart))
						{
							$dataChart->addRow($dataChartRow);
						}
					}
				}
			}
		}

		private function getClassValue($datum) 
		{
			$val = null;

			if(isset($datum[MetadataName::Name]))
			{
				// Name
				$val = $datum[MetadataName::Name];
			}
			else if(isset($datum["path"]))
			{
				// Path
				$val = $datum["path"];
			}
			else if($datum[MetadataName::ClassName] == "process")
			{
				// Process
				$val = "{$datum[MetadataName::Name]} (tid : {$datum[MetadataName::TID]})";
			}
			
			return $val;
		}

		public function parse() 
		{
			$this->readMetadata();
			$this->readData();
			//echo print_r($this->tracingData);
			echo $this->tracingData->toJSON();
		}
	}

	$inputfilename = "../data/iousagetop";
	$parser = new DataParser($inputfilename);
	$parser->parse();
?>
