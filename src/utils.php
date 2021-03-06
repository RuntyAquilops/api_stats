<?php

// проверка валидности даты
function isValidDate($date) {
    //преобразует в нужный формат
    $d = DateTime::createFromFormat('Y-m-d', $date);
    // сравнивает результат с введенной датой
    return $d && $d->format('Y-m-d') === $date;
}

function getPost($connect, $var)
{
	if (isset($_POST[$var]))
		return $connect->real_escape_string($_POST[$var]);
	else
		return 0;
}

function responseCode($message, $code = 200)
{
	http_response_code($code);
	$text = array(
		"status" =>
		array (
			"code" => $code,
			"message" => $message
		)
	);
	echo json_encode($text, JSON_PRETTY_PRINT);
}
?>
