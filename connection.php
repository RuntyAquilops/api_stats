<?php

  $db_host = 'localhost';
  $db_user = 'root';
  $db_password = 'root';
  $db_db = 'stats';

  $connect = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
  );

  if ($connect->connect_error) die("Some troubles with connection. Please check your settings.<br/>" . mysqli_connect_error());

?>
