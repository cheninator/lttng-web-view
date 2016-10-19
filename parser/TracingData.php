<?php

	class TracingData 
	{
		private $tracingEntries;

		function __construct() 
		{
			$this->tracingEntries = array();
		}

		public function addTracingEntry(TracingEntry $tracingEntry) 
		{
			array_push($this->tracingEntries, $tracingEntry);
		}

		public function getTracingEntry($name)
		{
			$result = null;

			foreach($this->tracingEntries as $tracingEntry)
			{
				if($tracingEntry->metadata == $name)
				{
					$result = $tracingEntry;
					break;
				}
			}

			return $result;
		}

		public function toJSON()
		{
			return json_encode($this->tracingEntries);
		}
	}

?>