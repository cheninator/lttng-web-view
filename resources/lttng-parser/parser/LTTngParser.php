<?php
	
	require_once("IntermediateData.php");
	require_once("IntermediateEntry.php");
	require_once("DataColumn.php");
	require_once("Data.php");
	require_once("MetadataName.php");

	class LTTngParser 
	{
		private $fileName;
		private $intermediateData;

		function __construct($fileName)
		{
			$this->fileName = $fileName;
			$this->intermediateData = new IntermediateData();
		}

		private function readMetadata() 
		{	
 			$fileContent = file_get_contents("{$this->fileName}.meta");
			$jsonContent = json_decode($fileContent, true);
			$tableClasses =  $jsonContent[MetadataName::TableClasses];

			foreach ($tableClasses as $key => $tc) 
			{	
				$intermediateEntry = new IntermediateEntry();
				$intermediateEntry->tableclass = $key;
				$intermediateEntry->title = $tc[MetadataName::Title];

				$columnDescriptions = $tc[MetadataName::ColumnDescription];

				foreach ($columnDescriptions as $cd)
				{
					$data = new Data();

					$dataColumn = new DataColumn();
					$dataColumn->title = $cd[MetadataName::Title];
					$dataColumn->class = $cd[MetadataName::ClassName];
					$dataColumn->unit = isset($cd[MetadataName::Unit]) ? $cd[MetadataName::Unit] : null;

					if($dataColumn->title == "Request ID")
						$dataColumn->class = "string";
					
					$data->column = $dataColumn;

					$intermediateEntry->addData($data);
				}

				$this->intermediateData->addEntry($intermediateEntry);
			}
		}

		private function readData()
		{
			$fileContent = file_get_contents("{$this->fileName}.data");
			$data = json_decode($fileContent, true);

			$results = $data[MetadataName::Results];
			$isCloned = false;

			foreach($results as $result)
			{
				$isCloned = false;

				$class = $result[MetadataName::ClassName];

				// If we have an inherit class data
				$metadata = isset($class[MetadataName::Inherit]) ? $class[MetadataName::Inherit] : $class;

				// Check title after
				$title = isset($class[MetadataName::Title]) ? $class[MetadataName::Title] : null;

				// Get the intermediate entry object
				$intermediateEntry = $this->intermediateData->getEntry($metadata);

				// We have an inherit data, possibly a thread
				if(!is_null($title) && $intermediateEntry->title != $title) 
				{
					$originalTitle = $intermediateEntry->title;
					$diff = strlen($title) - strlen($originalTitle);

					$intermediateEntry = clone $intermediateEntry;
					$isCloned = true;

					$intermediateEntry->title = $title;
					$intermediateEntry->threadId = substr($title, strlen($originalTitle) + 1, $diff);
				}

				// If we have a time-range property
				$timeRange = isset($class[MetadataName::TimeRange]) ? $class[MetadataName::TimeRange] : null;

				if(!is_null($timeRange))
				{
					$intermediateEntry->startingTime = $timeRange[MetadataName::Begin][MetadataName::Value];
					$intermediateEntry->endingTime = $timeRange[MetadataName::End][MetadataName::Value];
				}

				// Treat data
				foreach ($result[MetadataName::Data] as $data) 
				{
					for($i = 0; $i < count($data); ++$i) 
					{
						$intermediateEntry->data[$i]->addValue($data[$i]);
					}
				}

				if($isCloned) 
				{
					$this->intermediateData->addEntry($intermediateEntry);
				}
			}
		}

		public function parse() 
		{
			$this->readMetadata();
			$this->readData();
			// echo $this->intermediateData->toJSON();	
		}

		public static function getClassType($class)
		{
			$val = $class;

			switch($class)
			{
				case "process":
				case "disk":
				case "cpu":
				case "path":
				case "mysql":
				case "mysqlthreads":
				case "syscall":
				case "fd":
					$val = "string";
					break;

				case "ratio":
				case "duration":
				case "int":
				case "size":
					$val = "number";
					break;
			}

			return $val;
		}

		public function getIntermediateData()
		{
			return $this->intermediateData;
		}
	}
	