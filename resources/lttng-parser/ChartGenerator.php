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

		public function __construct()
		{
			$this->charts = array();
		}

		public function generateCharts($fileName)
		{
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
							if(!empty($second->values))
							{
								$googleChart = new GoogleChart();

								$this->addChartColumn($first->column, $googleChart);
								$this->addChartColumn($second->column, $googleChart);
						
								for($k = 0; $k < count($first->values); ++$k)
								{
									$chartRow = new GoogleChartRow();

									/* Adding the first value */
									$firstValue = $this->getClassValue($first->values[$k]);

									if(is_null($firstValue))
									{
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

								array_push($this->charts, $googleChart);
							}
						}
					}
				}
			}

			$this->generateFiles();
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
			else if($datum[MetadataName::ClassName] == "cpu")
			{
				// Process
				$val = "CPU-{$datum[MetadataName::ID]}";
			}
			else
			{
				$val = $datum[MetadataName::Value];
			}

			return $val;
		}

		private function generateFiles()
		{
	     	if(!file_exists('result'))
	     	{
   				mkdir('result');
	     	}

			for($i = 0; $i < count($this->charts); ++$i)
			{	
				$chart = $this->charts[$i];
				$content = json_encode($chart);

				$firstColName = $chart->cols[0]->label;
				$secondColName = $chart->cols[1]->label;

				$fileName = "{$firstColName}-{$secondColName}";
			
				$fileName = str_replace(' ', '_', $fileName);
				$fileName = str_replace('/', '\/', $fileName);

				file_put_contents("result/{$fileName}", $content);
			}
		}
	}

	$inputfilename = "data/mysql";
	$chartGenerator = new ChartGenerator();
	$chartGenerator->generateCharts($inputfilename);

