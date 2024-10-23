<?php
// db.php
$host = 'localhost';
$user =  $_ENV['USER'];
$password = $_ENV['password'];
$dbname = 'restaurante';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
  die("Falha na conexão: " . $conn->connect_error);
}
