<?php

include_once 'error.php';
include_once 'connection.php';
include_once 'utils.php';

header('Content-Type: application/json; charset:UTF-8');

function delStats($connect)
{
	$error = new Errors();
	$query = $connect->query("DELETE FROM stats");
	if ($query)
		responseCode("All statistics have been successfully deleted.");
	else
		$error->err("Some problems with deleting. Please try again.");
}

?>
