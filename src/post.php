<?php

include_once 'utils.php';
include_once 'error.php';
include_once 'connection.php';

header('Content-Type: application/json; charset:UTF-8');

function postStats($connect, $data)
{
	$error = new Errors();
	$date = getPost($connect, 'date');
	$views = getPost($connect, 'views');
	$clicks = getPost($connect, 'clicks');
	$cost = getPost($connect, 'cost');
	if (!isValidDate($date))
		$error->err("Invalid date. Format of date must be YYYY-MM-DD.", 422);
	$query = $connect->query("INSERT INTO stats (`id_event`, `date`, `views`, `clicks`, `cost`)
							  VALUES (NULL, '$date', '$views', '$clicks', '$cost')");
	if ($query && isValidDate($date))
		responseCode("Data added successfully.");
	else
		$error->err("Can`t insert data.");
}

?>
