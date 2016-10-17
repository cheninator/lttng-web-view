<?php
	
	namespace Charts;

	interface IChart 
	{
		public function getJson();
		public function write();
	}
	
	class MetadataName 
	{
		const Title = "title";
		const Columns = "columns";
		const ColumnDescription = "column-descriptions";
		const TableClasses = "table-classes";
		const TableClassesNumber = "table-classes-no";
		const Rows = "rows";
		const Value = "value";
		const ClassName = "class";
	}

	class BaseChart 
	{
		protected $fileName_;
		protected $metadata_;

		protected function readMetadata() 
		{	
 			$fileContent = file_get_contents($this->fileName_.".meta");
			$jsonContent = json_decode($fileContent, true);

			$title = $jsonContent[MetadataName::Title];
			$tableclasses =  $jsonContent[MetadataName::TableClasses];

			$this->metadata_ = array();
			$columns = array();
			$chart_cnt = 0;
			$tblclassescounter = 0;

			foreach ($tableclasses as $tc) 
			{
				$this->metadata_[$tblclassescounter][$chart_cnt][MetadataName::Title] = $tc[MetadataName::Title];

				$column_cnt = 0;
				$base_column = array();

				foreach ($tc[MetadataName::ColumnDescription] as $tccd) 
				{
					if ($tccd[MetadataName::ClassName] == 'time-range')
						continue;

					if ($column_cnt == 0) 
					{
						$this->metadata_[$tblclassescounter][$chart_cnt][MetadataName::Columns][$column_cnt][MetadataName::Title] = $tccd[MetadataName::Title];

				   		$this->metadata_[$tblclassescounter][$chart_cnt][MetadataName::Columns][$column_cnt][MetadataName::ClassName] = $tccd[MetadataName::ClassName];

				   		$base_column = $this->metadata_[$tblclassescounter][$chart_cnt][MetadataName::Columns][$column_cnt];

				   		$column_cnt++;
				 	}
				 	else if ($column_cnt == 1) 
				 	{
						$this->metadata_[$tblclassescounter][$chart_cnt][MetadataName::Title] = $tc[MetadataName::Title].' - '.$tccd[MetadataName::Title];

						$this->metadata_[$tblclassescounter][$chart_cnt][MetadataName::Columns][$column_cnt][MetadataName::Title] = $tccd[MetadataName::Title];

						$this->metadata_[$tblclassescounter][$chart_cnt][MetadataName::Columns][$column_cnt][MetadataName::ClassName] = $tccd[MetadataName::ClassName];

						$column_cnt++;
				 	}
				 	else if ($column_cnt > 1)
				 	{
						$chart_cnt++;
						$this->metadata_[$tblclassescounter][$chart_cnt][MetadataName::Title] = $tc[MetadataName::Title].' - '.$tccd[MetadataName::Title];

						$this->metadata_[$tblclassescounter][$chart_cnt][MetadataName::Columns][0][MetadataName::Title]  = $base_column[MetadataName::Title];

						$this->metadata_[$tblclassescounter][$chart_cnt][MetadataName::Columns][0][MetadataName::ClassName]  = $base_column[MetadataName::ClassName];

						$this->metadata_[$tblclassescounter][$chart_cnt][MetadataName::Columns][1][MetadataName::Title] = $tccd[MetadataName::Title];

						$this->metadata_[$tblclassescounter][$chart_cnt][MetadataName::Columns][1][MetadataName::ClassName] = $tccd[MetadataName::ClassName];
					}
				}
				$chart_cnt = 0;
				$tblclassescounter ++;
			}
		}

		protected function readData()
		{
			$fileContent = file_get_contents($this->fileName_.".data");
			$data = json_decode($fileContent, true);

			$chart_cnt = 0;
			$row_cnt = 0;
			$col_cnt = 0;
			$tblclassescounter = 0;
			$results = $data['results'];
			$base_row = null;

			foreach ($results as $tcs)
			{
				foreach ($tcs['data'] as $tc) 
				{
					$col_cnt = 0;
					$chart_cnt = 0;

					foreach ($tc as $tcr) 
					{
						if ($col_cnt == 0)
						{
							$rowval = get_class_value($tcr[MetadataName::ClassName], $tcr);
							$this->metadata_[$tblclassescounter][$chart_cnt][MetadataName::Rows][$row_cnt][MetadataName::Value][$col_cnt] = $rowval;
							$base_row = $this->metadata_[$tblclassescounter][$chart_cnt][MetadataName::Rows][$row_cnt][MetadataName::Value];
							$col_cnt ++;
						}
						else if ($col_cnt == 1)
						{
							$rowval = get_class_value($tcr[MetadataName::ClassName], $tcr);
							$this->metadata_[$tblclassescounter][$chart_cnt][MetadataName::Rows][$row_cnt][MetadataName::Value][$col_cnt] = $rowval;
							$col_cnt ++;
						}
						else if ($col_cnt > 1)
						{
							$chart_cnt ++;
							$rowval = get_class_value($tcr[MetadataName::ClassName], $tcr);
							$this->metadata_[$tblclassescounter][$chart_cnt][MetadataName::Rows][$row_cnt][MetadataName::Value][0] = $base_row[0];
							$this->metadata_[$tblclassescounter][$chart_cnt][MetadataName::Rows][$row_cnt][MetadataName::Value][1] = $rowval;
							$col_cnt ++;
						}
					}
					
					$row_cnt++;
				}

				$chart_cnt = 0;
				$row_cnt = 0;
				$tblclassescounter ++;
			}
		}
	}

	class GoogleChart extends BaseChart implements IChart
	{
		function __construct($fileName)
		{
			$this->fileName_ = $fileName;
		}

		public function getJson() 
		{
			$json = "";
			$colsstr = '"cols":[';

			foreach($this->metadata_ as $allcharts)
			{
				foreach($allcharts as $achart)
				{ 
					$chartcolstr = '';
					$ii = 0;

					if (isset($achart[MetadataName::Columns]) && is_array($achart[MetadataName::Columns])) 
					{
						foreach($achart[MetadataName::Columns] as $chartcol)
						{
							$ii++;
							if ($chartcolstr == '')
								$chartcolstr = '{"id":"'.$ii.'","label":"'.$chartcol[MetadataName::Title].'","pattern":"","type":"'.get_class_type($chartcol[MetadataName::ClassName]).'"}';
							else
							{
								$classvar = get_class_type($chartcol[MetadataName::ClassName]);
								if ($classvar != 'number') 
								{
									$chartcolstr = '';
									break;
								}
								$chartcolstr .= ',{"id":"'.$ii.'","label":"'.$chartcol[MetadataName::Title].'","pattern":"","type":"'.get_class_type($chartcol[MetadataName::ClassName]).'"}';
							}
						}
					}

					if ($chartcolstr == '')
						continue;

					$colsstr = '"cols":['.$chartcolstr.']';
					$chartrowstr = '';

					if (isset($achart[MetadataName::Rows]) && is_array($achart[MetadataName::Rows])) 
					{
						foreach($achart[MetadataName::Rows] as $chartrow)
						{
							if (count($chartrow[MetadataName::Value]) < 2)
								continue;

							if ($chartrowstr == '')
								$chartrowstr = '{"c":[{"v":"'.$chartrow[MetadataName::Value][0].'","f":null},{"v":'.$chartrow[MetadataName::Value][1].',"f":null}]}';
							else
								$chartrowstr .= ',{"c":[{"v":"'.$chartrow[MetadataName::Value][0].'","f":null},{"v":'.$chartrow[MetadataName::Value][1].',"f":null}    ]}';   
						}
					}

					if ($chartrowstr == '')
						continue;

					$rowsstr = '"rows":['.$chartrowstr.']';

					if (!file_exists('charts'))
						mkdir('charts');

					$filename = str_replace('/','', $achart['title']);
					$filename = 'charts/'.str_replace(' ','_',$filename);

					$dattablestr = '{' .$colsstr. ','.$rowsstr. '}';
					$json = $json.$dattablestr;	
					file_put_contents($filename, $dattablestr);
				}
			}
			return $json;
		}

		public function write()
		{
			$this->readMetadata();
			$this->readData();
			//echo json_encode($this->metadata_);
			//echo print_r($this->metadata_);
			$this->getJson();
		}
	}

	function get_class_value($class, $arr)
	{
		if ($class == 'process')
			$val = $arr['name'].' ('.$arr['tid'].')';
		else if ($class == 'cpu')
			$val = 'cpu-' . $arr['id'];
		else
			$val = $arr[MetadataName::Value];

		return $val;
	}

	function get_class_type($class)
	{
		if ($class == 'process')
			$val = 'string';
		else if ($class == 'cpu')
			$val = 'string';
		else if ($class == 'ratio')
			$val = 'number';
		else if ($class == 'int')
			$val = 'number';
		else
			$val = $class;

		return $val;
	}

	if (isset($argv[1]))
	{
		$inputfilename = $argv[1];
		$chart = new GoogleChart($inputfilename);
		$chart->write();
	}
?>