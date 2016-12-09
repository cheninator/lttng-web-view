<?php
	
	require_once("parser/MetadataName.php");
	require_once("parser/LTTngParser.php");
	require_once("parser/DataColumn.php");
	require_once("parser/Data.php");

    require_once("chartjs/ChartJS.php");
    require_once("chartjs/ChartJSDataSet.php");
    
	class ChartJSGenerator
	{
		public $charts;
		private $file;

		public function __construct()
		{
			$this->charts = array();
		}

		public function generateCharts($fileName)
		{
			$this->file = $fileName;
			$parser = new LTTngParser($fileName);
			$parser->parse();

			$intermediateData = $parser->getIntermediateData();

			foreach($intermediateData->getEntries() as $entry)
			{
				for($i = 0; $i < count($entry->data); ++$i)
				{
					$first = $entry->data[$i];
					$type = LTTngParser::getClassType($first->column->class);

					if(!empty($first->values) && !strcmp($type, "string"))
					{						
						for($j = 0; $j < count($entry->data); ++$j)
						{	
							if($i == $j)
							{
								continue;
							}

							$second = $entry->data[$j];
							$type = LTTngParser::getClassType($second->column->class);

							if(!empty($second->values))
							{
								$chartJs = new ChartJS();
                                $chartJs->firstColumnName = $first->column->title;
                                $chartJs->secondColumnName = $second->column->title;

								if(isset($entry->threadId))
								{
									$chartJs->threadId = $entry->threadId;
								}

                                $this->buildChart($first, $second, $chartJs);
							}
						}
					}
				}
			}

			$this->generateFiles();
		}

        private function buildChart(Data $first, Data $second, ChartJS &$chartJs)
		{
            $dataSet = new ChartJSDataSet();
            $dataSet->label = $second->column->title;

            for($k = 0; $k < count($first->values); ++$k)
			{
				/* Adding the first value */
				$firstValue = $this->getClassValue($first->values[$k]);

				if(is_null($firstValue))
				{
					// Ignore all null values
					continue;
				}

                $secondValue = $this->getClassValue($second->values[$k]);

                $chartJs->addLabel($firstValue);
                $dataSet->addData($secondValue);
			}

            $chartJs->addDataset($dataSet);
			array_push($this->charts, $chartJs);
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
			else if(isset($datum[MetadataName::ClassName]) && !isset($datum[MetadataName::Value]))
			{
				$className = $datum[MetadataName::ClassName];

				switch($className)
				{
					case "process":
						$val = "{$datum[MetadataName::Name]} (tid : {$datum[MetadataName::TID]})";
						break;
					case "cpu":
						$val = "CPU-{$datum[MetadataName::ID]}";
						break;
				}
			}
			else if(isset($datum[MetadataName::Value]))
			{
				$val = $datum[MetadataName::Value];
			}
			else 
			{
				$val = $datum;
			}

			return $val;
		}

		private function generateFiles()
		{
			$folder = explode("/", $this->file)[1];

	     	if(!file_exists('resultjs'))
	     	{
   				mkdir('resultjs');
	     	}

			if(!file_exists("resultjs/{$folder}"))
			{
				mkdir("resultjs/{$folder}");
			}

			for($i = 0; $i < count($this->charts); ++$i)
			{	
				$chart = $this->charts[$i];
				$content = json_encode($chart);

				$fileName = "{$chart->firstColumnName}-{$chart->secondColumnName}";
				$fileName = str_replace(' ', '_', $fileName);
				$fileName = str_replace('/', '_', $fileName);

				if(isset($chart->threadId))
				{
					if(!file_exists("resultjs/{$folder}/{$chart->threadId}"))
					{
						mkdir("resultjs/{$folder}/{$chart->threadId}");
					}

					$fileName = "{$chart->threadId}/{$fileName}";
				}

				file_put_contents("resultjs/{$folder}/{$fileName}", $content);				
			}
		}
	}

	$log_directory = "data";
	$files = array();

	$chartGenerator = new ChartJSGenerator();
	$chartGenerator->generateCharts("data/phptop");
/*
	foreach(glob($log_directory.'/*.*') as $file) 
	{
		$inputfilename = explode(".", $file);

		if(!in_array($inputfilename[0], $files))
		{
			array_push($files, $inputfilename[0]);
		}
	}

	foreach($files as $name)
	{
		$chartGenerator = new ChartJSGenerator();
		$chartGenerator->generateCharts($name);
	}
	*/