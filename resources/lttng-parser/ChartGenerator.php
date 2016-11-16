<?php
	
	require_once("parser/MetadataName.php");
	require_once("parser/LTTngParser.php");
	require_once("parser/DataColumn.php");
	require_once("parser/Data.php");

	require_once("google/GoogleChartColumn.php");
	require_once("google/GoogleChartRow.php");
	require_once("google/GoogleChartValue.php");
	require_once("google/GoogleChart.php");

	class ChartGenerator
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
					$type = GoogleChart::getClassType($first->column->class);

					if(!empty($first->values) && !strcmp($type, "string"))
					{						
						for($j = 0; $j < count($entry->data); ++$j)
						{	
							if($i == $j)
							{
								continue;
							}

							$second = $entry->data[$j];
							$type = GoogleChart::getClassType($second->column->class);

							if(!empty($second->values))
							{
								$googleChart = new GoogleChart();

								if(strcmp($type, "time-range")) 
								{
									$this->buildChart($first, $second, $googleChart);
								}
								else if(!strcmp($type, "time-range")) 
								{
									$this->buildTimeline($first, $second, $googleChart);
								}
							}
						}
					}
				}
			}

			$this->generateFiles();
		}
		
		private function buildChart(Data $first, Data $second, GoogleChart &$googleChart)
		{
			$this->addChartColumn($first->column, $googleChart);
			$this->addChartColumn($second->column, $googleChart);
			$this->addChartRow($first, $second, $googleChart);

			array_push($this->charts, $googleChart);
		}

		private function addChartColumn(DataColumn $dataColumn, GoogleChart &$googleChart) 
		{
			$chartColumn = new GoogleChartColumn();
			$chartColumn->id = "";
			$chartColumn->label = $dataColumn->title;
			$chartColumn->type = GoogleChart::getClassType($dataColumn->class);
			$chartColumn->role = "";
			$chartColumn->pattern = "";
			$googleChart->addColumn($chartColumn);
		}

		private function addChartRow(Data $first, Data $second, GoogleChart &$googleChart)
		{
			for($k = 0; $k < count($first->values); ++$k)
			{
				$chartRow = new GoogleChartRow();

				/* Adding the first value */
				$firstValue = $this->getClassValue($first->values[$k]);

				if(is_null($firstValue))
				{
					// Ignore all null values
					continue;
				}

				$cv = new GoogleChartValue();
				$cv->v = $firstValue;

				if(isset($first->column->unit))
				{
					$cv->f = "{$firstValue} ({$first->column->unit})";
				}

				$chartRow->addValue($cv);


				/* Adding the second value */
				$chartValue = new GoogleChartValue();
				$secondValue = $this->getClassValue($second->values[$k]);
				$chartValue->v = $secondValue;

				if(isset($second->column->unit))
				{
					$chartValue->f = "{$secondValue} ({$second->column->unit})";
				}

				$chartRow->addValue($chartValue);

				/* Add row to google chart object */
				$googleChart->addRow($chartRow);
			}
		}

		private function buildTimeline(Data $first, Data $second, GoogleChart &$googleChart)
		{
			$this->addChartColumn($first->column, $googleChart);
			//$this->addChartColumn($first->column, $googleChart);

			$start = new DataColumn();
			$start->title = "start";
			$start->class = "int";

			$end = new DataColumn();
			$end->title = "end";
			$end->class = "int";

			$this->addChartColumn($start, $googleChart);
			$this->addChartColumn($end, $googleChart);

			$this->addTimelineChartRow($first, $second, $googleChart);
			array_push($this->charts, $googleChart);
		}

		private function addTimelineChartRow(Data $first, Data $second, GoogleChart &$googleChart)
		{
			for($k = 0; $k < count($first->values); ++$k)
			{
				$chartRow = new GoogleChartRow();

				/* Adding the first value */
				$firstValue = $this->getClassValue($first->values[$k]);

				if(is_null($firstValue))
				{
					// Ignore all null values
					continue;
				}

				$cv = new GoogleChartValue();
				$cv->v = $firstValue;
				$chartRow->addValue($cv);

				/* Adding the second and third column */
				//$chartRow->addValue(clone $cv);

				$chartValue = new GoogleChartValue();
				$secondValue = $second->values[$k]["begin"]["value"];
				$secondValue = round($secondValue / 1000000);
				$chartValue->v = $secondValue;
				$chartRow->addValue($chartValue);

				$chartValue = new GoogleChartValue();
				$secondValue = $second->values[$k]["end"]["value"];
				$secondValue = round($secondValue / 1000000);
				$secondValue += 250;
				$chartValue->v = $secondValue;
				$chartRow->addValue($chartValue);

				/* Add row to google chart object */
				$googleChart->addRow($chartRow);
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

	     	if(!file_exists('result'))
	     	{
   				mkdir('result');
	     	}

			if(!file_exists("result/{$folder}"))
			{
				mkdir("result/{$folder}");
			}

			for($i = 0; $i < count($this->charts); ++$i)
			{	
				$chart = $this->charts[$i];
				$content = json_encode($chart);

				$firstColName = $chart->cols[0]->label;
				$secondColName = $chart->cols[1]->label;

				$fileName = "{$firstColName}-{$secondColName}";
			
				$fileName = str_replace(' ', '_', $fileName);
				$fileName = str_replace('/', '_', $fileName);

				file_put_contents("result/{$folder}/{$fileName}", $content);
			}
		}
	}

	if(count($argv) > 1)
	{
		$inputfilename = "data/{$argv[1]}";
		$chartGenerator = new ChartGenerator();
		$chartGenerator->generateCharts($inputfilename);
	}
