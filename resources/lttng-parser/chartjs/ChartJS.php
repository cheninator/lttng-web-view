<?php
	
	require_once("ChartJSDataSet.php");
	
	class ChartJS 
	{
        private $firstColumnName;
        private $secondColumnName;

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

        public function setFirstColumnName($name)
        {
            $this->firstColumnName = $name;
        }

        public function setSecondColumnName($name)
        {
            $this->secondColumnName = $name;
        }

        public function getFirstColumnName()
        {
            return $this->firstColumnName;
        }

        public function getSecondColumnName()
        {
            return $this->secondColumnName;
        }
	}
