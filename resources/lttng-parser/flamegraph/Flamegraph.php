<?php
	
	class Flamegraph implements JsonSerializable
	{
        public $children;
        public $name;
		public $value;
        
        private $startingTimestamp;
        private $endingTimestamp;

		public function __construct()
		{	
			$this->children = array();
		}

		public function addChildren(Flamegraph $child)
		{
			array_push($this->children, $child);
		}

        public function getStartingTimestamp()
        {
            return $this->startingTimestamp;
        }

        public function getEndingTimestamp()
        {
            return $this->endingTimestamp;
        }

        public function setStartingTimestamp($timestamp)
        {
            $this->startingTimestamp = $timestamp;
        }

        public function setEndingTimestamp($timestamp)
        {
            $this->endingTimestamp = $timestamp;
        }

        public function jsonSerialize() 
        {
            $result = [];
            
            if(count($this->children) != 0)
            {
                $result = [
                    "children" => $this->children,
                    "name" => $this->name,
                    "value" => $this->value
                ];
            }
            else 
            {
                $result = [
                    "name" => $this->name,
                    "value" => $this->value
                ];
            }

            return $result;
        }
	}
