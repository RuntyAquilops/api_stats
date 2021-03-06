<?php

include_once 'error.php';
include_once 'connection.php';

header('Content-Type: application/json; charset:UTF-8');

function delStats($connect)
{
	$error = new Errors();
	$query = $connect->query("DELETE FROM stats");
	if ($query)
		http_response_code(200);
	else
		$error->err("Some problems with deleting. Please try again.");
}

?>
