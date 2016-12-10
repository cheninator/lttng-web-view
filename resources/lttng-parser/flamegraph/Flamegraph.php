<?php
	
	class Flamegraph implements JsonSerializable
	{
        public $children;
        public $name;
		public $value;

        public $threadId;   
        public $startingTimestamp;
        public $endingTimestamp;

		public function __construct()
		{	
			$this->children = array();
		}

		public function addChildren(Flamegraph $child)
		{
			array_push($this->children, $child);
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
