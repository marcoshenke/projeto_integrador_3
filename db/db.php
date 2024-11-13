<?php
require '/opt/lampp/htdocs/projeto-integrador-3/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('/opt/lampp/htdocs/projeto-integrador-3/');
$dotenv->load();

$host = 'localhost';
$user =  $_ENV['USER'];
$password = $_ENV['PASSWORD'];
$dbname = 'restaurant';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
  die("Falha na conexão: " . $conn->connect_error);
}
