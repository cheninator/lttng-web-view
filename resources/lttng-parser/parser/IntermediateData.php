<?php
	
	require_once("IntermediateEntry.php");

	class IntermediateData 
	{
		private $intermediateEntries;

		function __construct()
		{
			$this->intermediateEntries = array();
		}

		public function addEntry(IntermediateEntry $intermediateEntry) 
		{
			array_push($this->intermediateEntries, $intermediateEntry);
		}

		public function getEntry($tableclass) 
		{
			$result = null;

			foreach($this->intermediateEntries as $intermediateEntry)
			{
				if($intermediateEntry->tableclass == $tableclass)
				{
					$result = $intermediateEntry;
					break;
				}
			}

			return $result;
		}

		public function getEntries()
		{
			return $this->intermediateEntries;
		}

		public function toJSON() 
		{
			return json_encode($this->intermediateEntries);
		}
	}
