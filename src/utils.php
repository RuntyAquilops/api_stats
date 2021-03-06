<?php

// проверка валидности даты
function isValidDate($date) {
    //преобразует в нужный формат
    $d = DateTime::createFromFormat('Y-m-d', $date);
    // сравнивает результат с введенной датой
    return $d && $d->format('Y-m-d') === $date;
}

?>
