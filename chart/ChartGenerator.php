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

							foreach($row->values as $value)
							{
								$googleChartValue = new GoogleChartValue();
								$googleChartValue->v = $value;
								$googleChartRow->addValue($googleChartValue);
							}

							$googleChart->addRow($googleChartRow);
						}

						array_push($this->charts, $googleChart);
					}
				}
			}
		}
	}

	$inputfilename = "../data/iousagetop";
	$chartGenerator = new ChartGenerator();
	$chartGenerator->generateCharts($inputfilename);
?>