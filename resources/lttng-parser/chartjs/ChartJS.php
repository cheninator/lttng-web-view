<?php
	
	require_once("ChartJSDataSet.php");
	
	class ChartJS implements JsonSerializable
	{
        public $firstColumnName;
        public $secondColumnName;
		public $threadId;

		public $labels;
		public $datasets;

		public function __construct()
		{	
			$this->labels = array();
			$this->datasets = array();
		}

		public function addLabel($label)
		{
			array_push($this->labels, $label);
		}

		public function addDataset(ChartJSDataSet $dataset)
		{
			array_push($this->datasets, $dataset);
		}

		public function jsonSerialize() 
        {
            return [
				"labels" => $this->labels,
				"datasets" => $this->datasets,
			];
        }
	}
