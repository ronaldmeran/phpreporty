<?php

/**
 * PHPReporty Class
 * Main php-report class to create reports based on set templates,
 * generate sql queries and database model objects
 * 
 * @author: Ronald M. Meran
 * @copyright: 2016 November PHPReporty
 */
	
class Charts
{

	public function chartss()
	{
		$episode = 'episode';
		$project = 'project';

		$sql = self::$query
		    ->select('user_account.firstname',
					'user_account.lastname',
					'administrator_log.classname',
					'administrator_log.reference_id',
					'user_account.user_id',
					'count(administrator_log.classname) as count')
		    ->from('administrator_log', 'administrator_log')
		    ->innerJoin('administrator_log', 'user_account', 'user_account', 'administrator_log.reference_id = user_account.user_id')
		    ->orWhere('administrator_log.classname = :episode', 'administrator_log.classname = :project')
		    ->groupBy('user_account.user_id', 'administrator_log.classname')
			->getSQL();

		$data = self::$dbal->prepare($sql);
		$data->bindValue("episode", $episode);
		$data->bindValue("project", $project);
		$data->execute();
		
		$result = $data->fetchAll();

		// Get the xaxis

		print "<pre>";
		print_r($result);
		print "</pre>";
		exit;

		$data = array(
			'dbtables' => self::getTables(),
			'dbfields' => self::getFields()
		);

		return self::render('charts', $data); 
	}

	// Get X-Axis
	public function getXaxis($result = array())
	{
		// Result array
		foreach($result as $key => $value){
			
		}
	}

	public function getQuantity($data=array(), $field='')
	{
		$quantifiable = $d = array();

		foreach($data as $key => $value){
			// $quantifiable = 
			if($value == $field)
				$d = $data[$key][$field];
		}

		return $d;
	}

	public function generateData()
	{
		// Data array
		$data = array(
			array(
				'name' => 'Super Admin',
				'data' => [4, 5]
			),
			array(
				'name' => 'Production Managament',
				'data' => [1, 7]
			),
			array(
				'name' => 'Project Managament 1',
				'data' => [14, 6]
			),
		);

		echo json_encode($data);
		die();
	}

	/**

	* Chua, Nicolo Cedrick Yu (Charts / Graphs)

	* Calling the Functions of the Charts <-------------------------- All the Chart Types 

	* 3D Column Interactive, 3D-Column-Interactive

	* This Section is for calling the List of Charts

	* Formula and Functions to Connect to Database

	* Note: (Js for Charts) Basepath: Public -> JS -> custom (Chart/Graph Designs)

	* Note: (Twig for Charts) Basepath: Templates -> Default -> Html -> Twig (Value Manipulation and Naming Fields)

	* Note: All Charts Directory Includes
	1. Basepath: -> Index.php (calling the php functions here)
	2. Basepath: -> Templates -> Default -> Html
		a. chartlist.twig (Page to Display the List of Charts, Preview then continue to edit_chartlist.twig)
		b. edit_charlist.twig (Page to Update and Change Values of the Chart/Graph)
		c. twig folder (contains all twig value manipulation, where each chart has its unique fields to perfom and update the edit_chartlist.twig)
		d. js folder (contains all twig chart/graph designs, when selected it displays the type of chart in the preview form and in edit_chartlist.twig in order to see the changes made)
	3. This Class (Phpreport.php) will fetch data from the database and populate the data in the charts

	*/

	public function render_chart($result, $quantitative)
	{		
		while ($row = mysqli_fetch_assoc($result)){
			$resultSet['name'] = $row['firstname'];
			$resultSet['data'] = $row[$quantitative];
			$resultSet['dataseries'] = $row['transaction'];
		}
	}

	public function edit_chartlist()
	{	
	// 	$host = 'localhost';
	// 	$username = 'root';
	// 	$password = '';
	// 	$dbname = 'dev_db'; 
	// 	$conn = new mysqli($host,$username,$password,$dbname); 

	// 	$sql = "Select user.firstname, user.lastname, audit_trail.transaction, audit_trail.user_id, count(audit_trail.transaction) as count_transaction From audit_trail Inner Join user ON audit_trail.user_id = user.user_id Where audit_trail.transaction = 'Logged Out' OR audit_trail.transaction = 'Log In' Group By user.user_id, audit_trail.transaction";	

	// 	$result = mysqli_query($conn,$sql); 

	// 	// self::render_chart($result);

	// 	while ($row = mysqli_fetch_assoc($result)){
	// 		$resultSet[] = $row;
	// 		// $resultSet['data'] = $row['count_transaction'];
			
	// }
	// 	print("<pre>");
	// 	print_r($resultSet);
	// 	exit;

		$data = array(
			'chart' => 'twig/'.$_POST['chart'].'.twig',
			'chartType' => $_POST['chart'],
			'title' => 'Chart'
		);		

		return self::render('edit_chartlist', $data);
	}

	public static function hello()
	{
		echo 'hello';
	}

	public function chart_list()
	{
		return PHPReporty::render('chartlist');
	}

	public function barBasic()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function dColumnInteractive()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function dColumnNullValues()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function dColumnStackingGrouping()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function dPie()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function dPieDonut()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function dScatterDraggable()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function areaBasic()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function areaInverted()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function areaMissing()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function areaNegative()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function areaRange()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function areaRangeLine()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function areaSpline()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function areaStacked()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function areaStackedPercent()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function barNegativeStack()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function barStacked()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function boxPlot()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function bubble()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function bubbleD()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function chartUpdate()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function columnBasic()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function columnDrilldown()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function columnNegative()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function columnParsed()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function columnPlacement()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function columnRange()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function columnRotatedLabels()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function columnStacked()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function columnStackedGrouped()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function columnStackedPercent()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function combo()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function comboDualAxes()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function comboHistogram()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function comboMeteogram()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function comboMultiAxes()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function comboRegression()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function comboTimeline()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function dynamicClickToAdd()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function dynamicMasterDetail()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function dynamicUpdate()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function errorBar()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function funnel()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function gaugeActivity()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}


	public function gaugeClock()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function gaugeDual()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function gaugeSolid()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function gaugeSpeedOMeter()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function gaugeVuMeter()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function heatmap()
	{
		$arrayTojson = json_encode($data);
		return $arrayTojson;	
	}

	public function heatmapCanvas()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function lineAjax()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function lineBasic()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function lineLabels()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function lineLogAxis()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function lineTimeSeries()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function pieBasic()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function pieLegend()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function pieMonochrome()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function pieSemiCircle()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function polar()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function polarSpider()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function polarWindRose()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function polygon()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function pyramid()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function renderer()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function responsive()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function scatter()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function sparkline()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function splineInverted()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function splineIrregular()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function splinePlotBands()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function splineSymbols()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function synchronizedCharts()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function treemapColoraxis()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function treemapLargeDataset()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function treemapWithLevels()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}

	public function waterfall()
	{
		$arrayTojson = json_encode($data);

		return $arrayTojson;	
	}
} 
