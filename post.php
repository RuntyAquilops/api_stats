<?php

include_once 'utils.php';
include_once 'error.php';
include_once 'connection.php';

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
		http_response_code(200);
	else
		$error->err("Can`t insert data.");
}

function getPost($connect, $var)
{
	if (isset($_POST[$var]))
		return $connect->real_escape_string($_POST[$var]);
	else
		return 0;
}

?>
