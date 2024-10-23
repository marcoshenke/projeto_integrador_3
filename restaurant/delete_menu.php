<?php
include 'includes/db.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM menu WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    header("Location: index.php");
  } else {
    echo "Erro ao excluir item: " . $conn->error;
  }

  $stmt->close();
  $conn->close();
}
