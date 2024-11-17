<?php

function getDbConnection()
{
  $host = 'db';
  $username = 'restaurant_user_db';
  $password = 'password';
  $dbname = 'restaurant_db';

  $connection = mysqli_connect($host, $username, $password, $dbname);

  if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
  }

  return $connection;
}

$connect = getDbConnection();
