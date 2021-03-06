<?php

include_once 'error.php';
include_once 'connection.php';
include_once 'get.php';
include_once 'delete.php';
include_once 'post.php';

header('Content-Type: application/json; charset:UTF-8');

$error = new Errors();
$params = explode('/', $_GET["q"]);
$operation = $_GET['q'];
// получение метода (POST GET)
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
	case 'GET':
		if ($operation == 'stats' && isset($_GET['from']) && isset($_GET['to']))
			getSortStats($connect, $_GET);
		else
			$error->err("Uncorrest request. Check params.", 422);
		break;

	case 'POST':
		if ($operation == 'stats' && isset($_POST['date']))
			postStats($connect, $_POST);
		else
			$error->err("Uncorrest request. Check params.", 422);
		break;

	case 'DELETE':
		if ($operation == 'stats')
			delStats($connect);
		break;
	default:
		header('HTTP/1.1 405 Method Not Allowed');
		header('Allow: GET, POST, DELETE');
		$error->err("Allowed method: GET, POST and DELETE.",422);
		break;
}

?>
