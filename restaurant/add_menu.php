<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nome = $_POST['nome'];
  $descricao = $_POST['descricao'];
  $preco = $_POST['preco'];
  $categoria = $_POST['categoria'];

  $sql = "INSERT INTO menu (nome, descricao, preco, categoria) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssds", $nome, $descricao, $preco, $categoria);

  if ($stmt->execute()) {
    header("Location: index.php");
  } else {
    echo "Erro ao adicionar item: " . $conn->error;
  }

  $stmt->close();
  $conn->close();
}
