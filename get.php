<?php

include_once 'error.php';
include_once 'connection.php';
include_once 'utils.php';

header('Content-Type: application/json; charset:UTF-8');

// function getStats($connect, $data)
// {
// 	$error = new Errors();
// 	if (isValidDate($data['from']) && isValidDate($data['to'])) {
// 		$from = $data['from'];
// 		$to = $data['to'];
// 	} else
// 		$error->err("Invalid param. Format of params 'from' and 'to' must be YYYY-MM-DD.", 422);
//
// 	$query = $connect->query("SELECT *, cost/clicks AS cpc, cost/views*1000 AS cpm
// 							  FROM stats
// 							  WHERE date BETWEEN '$from' AND '$to'
// 							  ORDER BY date");
// 	if ($query)	{
// 		$stats_list = [];
// 		while ($stats = $query->fetch_assoc())
// 			$stats_list[] = $stats;
// 		echo json_encode($stats_list);
// 	} else
// 		$error->err("Some problems with query. Check params.");
// }

function getSortStats($connect, $data)
{
	$error = new Errors();

	if (isValidDate($data['from']) && isValidDate($data['to'])) {
		$from = $data['from'];
		$to = $data['to'];
	} else
		$error->err("Invalid param. Format of params 'from' and 'to' must be YYYY-MM-DD.", 422);

    $order = isset($_GET['sort']) ? $_GET['sort'] : '';
    $allowed = array("date", "-date",
					 "views", "-views",
				 	 "clicks", "-clicks",
				 	 "cost", "-cost",
				 	 "cpc", "-cpc",
				 	 "cpm", "-cpm");
    $exist = in_array($order, $allowed);
    if ($exist) {
		$key = array_search($order, $allowed);
		$orderby = $allowed[$key];
		echo $orderby;
		$query = $connect->query("SELECT *, cost/clicks AS cpc, cost/views*1000 AS cpm
								  FROM stats
								  WHERE date BETWEEN '$from' AND '$to'
								  ORDER BY $orderby;");
	  	if ($query)	{
			$stats_list = [];
			while ($stats = $query->fetch_assoc())
				$stats_list[] = $stats;
			echo json_encode($stats_list);
	    } else
	        $er->err("Sorry, some problems with database.", 500);
    } elseif (!$exist) {
		$query = $connect->query("SELECT *, cost/clicks AS cpc, cost/views*1000 AS cpm
								  FROM stats
								  WHERE date BETWEEN '$from' AND '$to'
								  ORDER BY date");
		if ($query)	{
			$stats_list = [];
			while ($stats = $query->fetch_assoc())
				$stats_list[] = $stats;
			echo json_encode($stats_list);
		}
	} else
        $error->err("Check parameter.", 422);
}

// $exist = in_array($order, $allowed);
// if ($exist) {
// 	$key = array_search($order, $allowed);
// 	$orderby = $allowed[$key];
// 	$query = $connection->query("SELECT * FROM `adverts` ORDER BY $orderby");
// 	if ($query) {
// 		$ads_list = [];
// 		while($advert = $query->fetch_assoc()) {
// 			$ads_list[] = $advert;
// 		}
// 		echo json_encode($ads_list, JSON_PRETTY_PRINT);
// 	} else {
// 		$er->err(500, $mysqli->error);
// 	}
// } else {
// 	$query = $connection->query("SELECT * FROM `adverts`");
// 	if ($query) {
// 		$ads_list = [];
// 		while($advert = $query->fetch_assoc()) {
// 			$ads_list[] = $advert;
// 		}
// 		echo json_encode($ads_list, JSON_PRETTY_PRINT);
// 	} else {
// 		$er->err(500, $mysqli->error);
// 	}
// }

?>
