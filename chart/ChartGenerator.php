<?php
	
	require_once("../parser/DataParser.php");
	require_once("GoogleChartColumn.php");
	require_once("GoogleChartRow.php");
	require_once("GoogleChartValue.php");
	require_once("GoogleChart.php");

	class ChartGenerator
	{
		public $charts;

		public function __construct()
		{
			$this->charts = array();
		}

		public function generateCharts($fileName)
		{
			$dataParser = new DataParser($fileName);
			$dataParser->parse();
			$tracingData = $dataParser->getTracingData();

			foreach($tracingData->tracingEntries as $tracingEntry)
			{
				foreach ($tracingEntry->dataCharts as $dataChart) 
				{
					if(!empty($dataChart->rows))
					{
						$googleChart = new GoogleChart();
						$googleChart->setTitle($dataChart->title);

						// No need to check if columns is empty
						foreach($dataChart->columns as $column)
						{
							$googleChartColumn = new GoogleChartColumn();

							$googleChartColumn->id = "";
							$googleChartColumn->label = $column->title;
							$googleChartColumn->type = $googleChart->getClassType($column->class);
							$googleChartColumn->role = "";
							$googleChartColumn->pattern = "";

							$googleChart->addColumn($googleChartColumn);
						}

						foreach($dataChart->rows as $row)
						{
							$googleChartRow = new GoogleChartRow();

							for($i = 0; $i < count($row->values); ++$i)
							{
								$googleChartValue = new GoogleChartValue();
								$googleChartValue->v = $row->values[$i];

								if(isset($dataChart->columns[$i]->unit))
									$googleChartValue->f = "{$row->values[$i]} (in {$dataChart->columns[$i]->unit})";

								$googleChartRow->addValue($googleChartValue);
							}

							$googleChart->addRow($googleChartRow);
						}

						array_push($this->charts, $googleChart);
					}
				}
			}

			$this->generateFiles();
		}

		private function generateFiles()
		{
	     	if (!file_exists('result'))
   				mkdir('result');

			foreach($this->charts as $chart)
			{
				$filename = $chart->getTitle();
				$content = json_encode($chart);
				$filename = str_replace(' ', '_', $filename);
				$filename = str_replace('/', '\/', $filename); 	
				file_put_contents("result/{$filename}", $content);
			}
		}
	}

	$inputfilename = "../data/phptop";
	$chartGenerator = new ChartGenerator();
	$chartGenerator->generateCharts($inputfilename);
?>
