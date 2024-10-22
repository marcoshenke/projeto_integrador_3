<?php
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = 'localhost';
$user = $_ENV['USER'];
$password = $_ENV['password'];
$dbname = 'restaurant';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
  die("Falha na conexão: " . $conn->connect_error);
}
