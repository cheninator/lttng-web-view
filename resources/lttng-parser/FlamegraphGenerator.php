<?php
	
	require_once("parser/MetadataName.php");
	require_once("parser/LTTngParser.php");
	require_once("parser/DataColumn.php");
	require_once("parser/Data.php");

    require_once("flamegraph/Flamegraph.php");
    
	class FlamegraphGenerator
	{
		public $charts;
		private $file;
        
        private $functionNameData;
        private $functionDurationData;
        private $startingTimestampData;
        private $indentData;

		const nanosecondsInYear = 3.1536e+16;

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
/*
			foreach($intermediateData->getEntries() as $entry)
			{
                // Ignore other tableclasses
                if($entry->tableclass != "per function log") {
                    continue;
                }

                // All these data should have the same size
                $this->functionNameData = $entry->findDataByColumnTitle("Function Name");
                $this->functionDurationData = $entry->findDataByColumnTitle("Function duration");
                $this->startingTimestampData = $entry->findDataByColumnTitle("Starting timestamp");
                $this->indentData = $entry->findDataByColumnTitle("Indent");

                if(!is_null($this->functionNameData) && !is_null($this->functionDurationData) && !is_null($this->startingTimestampData) && !is_null($this->indentData)) 
                {   
            		$count = count($this->functionNameData->values);
					
					$indexes = array_fill(0, $count, 0);
					$depth = array_fill(0, $count, 0);

					for($i = 0; $i < $count; ++$i) 
					{
						$indexes[$i] = $i;
						$depth[$i] = $this->indentData->values[$i][MetadataName::Value];
					}

					array_multisort($depth, $indexes);
					
					$root = new Flamegraph();
					$root->name = "root";
                    $root->value = 27439557120;

					$years = (1479945956012668814 / self::nanosecondsInYear);
					$start = 1479945956012668814 - ($years * self::nanosecondsInYear);
					$root->setStartingTimestamp($start);
					$root->setEndingTimestamp($start + $root->value);

					$parents = array();
					array_push($parents, $root);
					$lastParent = 0;
					$childCount = 0;

					$fastIndex = 0;
					$lastDepth = 1;

					while($fastIndex < $count)
					{	
						while($depth[$fastIndex] == $lastDepth)
						{
							$currentDataIndex = $indexes[$fastIndex];
							$child = new Flamegraph();
							$child->name = $this->functionNameData->values[$currentDataIndex][MetadataName::Name];
							$child->value = $this->functionDurationData->values[$currentDataIndex][MetadataName::Value];

							$years = ($this->startingTimestampData->values[$currentDataIndex][MetadataName::Value] / self::nanosecondsInYear);
							$start = $this->startingTimestampData->values[$currentDataIndex][MetadataName::Value] - ($years * self::nanosecondsInYear);

							$child->setStartingTimestamp($start);
							$child->setEndingTimestamp($start + $child->value);

							$counting = count($parents) - $childCount;
							for($j = $lastParent; $j < $counting; ++$j)
							{
								$currentNode = $parents[$j];
								if($currentNode->getEndingTimestamp() >= $child->getStartingTimestamp()) 
								{
									$currentNode->addChildren($child);
									++$childCount;

									array_push($parents, $child);
									break;
								}
							}

							++$fastIndex;

							if($fastIndex == $count)
								break;
						}

						if($fastIndex == $count)
							break;

						$lastParent+= $childCount;
						$childCount = 0;

						++$lastDepth;
					}
					file_put_contents("test.json", json_encode($root));
                }
			}
			// $this->generateFiles();*/
		}

        private function buildTree(Flamegraph &$flamegraph, $level, $parentEndingTimestamp, &$visited)
        {
            $count = count($this->functionNameData->values);
            for($i = 0; $i < $count; ++$i) 
            {	
                $currentLevel = $this->indentData->values[$i][MetadataName::Value];
                $currentStartingTimestamp = $this->startingTimestampData->values[$i][MetadataName::Value];
				
                if($currentLevel == $level && ($currentStartingTimestamp <= $parentEndingTimestamp || $level == 1) && !$visited[$i])
				{
                    $flamegraph->name = $this->functionNameData->values[$i][MetadataName::Name];
                    $flamegraph->value = $this->functionDurationData->values[$i][MetadataName::Value];
                    $flamegraph->setStartingTimestamp($this->startingTimestampData->values[$i][MetadataName::Value]);
                    
					$currentEndingTimestamp = $currentStartingTimestamp + $flamegraph->value;
					$flamegraph->setEndingTimestamp($currentEndingTimestamp);

					$visited[$i] = true;

					echo "Calling recursive from level ".$level." and i is ".$i."\n";
                    $child = new Flamegraph();
                    $this->buildTree($child, $level + 1, $currentEndingTimestamp, $visited);
					echo "Recursive call from level ".$level." is finished \n";
					$flamegraph->addChildren($child);
                }
            }
        }

		private function generateFiles()
		{
			$folder = explode("/", $this->file)[1];

	     	if(!file_exists('resultjs'))
	     	{
   				mkdir('resultjs');
	     	}

			if(!file_exists("resultjs/{$folder}"))
			{
				mkdir("resultjs/{$folder}");
			}

			for($i = 0; $i < count($this->charts); ++$i)
			{	
				$chart = $this->charts[$i];
				$content = json_encode($chart);

				$firstColName = $chart->getFirstColumnName();
				$secondColName = $chart->getSecondColumnName();

				$fileName = "{$firstColName}-{$secondColName}";
			
				$fileName = str_replace(' ', '_', $fileName);
				$fileName = str_replace('/', '_', $fileName);

				file_put_contents("resultjs/{$folder}/{$fileName}", $content);
			}
		}
	}

	$chartGenerator = new FlamegraphGenerator();
	$chartGenerator->generateCharts("data/lamptop");	