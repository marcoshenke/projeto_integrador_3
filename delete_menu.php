<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db/helpers/dbConnection.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM items WHERE id = ?";
  $stmt = $connect->prepare($sql);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    header("Location: index.php");
  } else {
    echo "Erro ao excluir item: " . $connect->error;
  }

  $stmt->close();
  $connect->close();
}
