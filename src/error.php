<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header('Content-Type: application/json; charset:UTF-8');

class Errors {
	public function err($message, $code = 500)
	{
		http_response_code($code);
		$text = array(
			"error" =>
			array (
				"code" => $code,
				"message" => $message
			)
		);
		die(json_encode($text, JSON_PRETTY_PRINT));
	}
}

?>
