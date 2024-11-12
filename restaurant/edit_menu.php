<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db/db.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = $conn->query("SELECT * FROM menu WHERE id = $id");
  $item = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $descricao = $_POST['descricao'];
  $preco = $_POST['preco'];
  $categoria = $_POST['categoria'];

  $sql = "UPDATE menu SET nome = ?, descricao = ?, preco = ?, categoria = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssdsi", $nome, $descricao, $preco, $categoria, $id);

  if ($stmt->execute()) {
    header("Location: index.php");
  } else {
    echo "Erro ao atualizar item: " . $conn->error;
  }

  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Item - Menu Restaurante</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="container">
    <h1>Editar Item</h1>
    <form action="edit_menu.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
      <label for="nome">Nome do Prato:</label>
      <input type="text" id="nome" name="nome" value="<?php echo $item['nome']; ?>" required>

      <label for="descricao">Descrição:</label>
      <textarea id="descricao" name="descricao" required><?php echo $item['descricao']; ?></textarea>

      <label for="preco">Preço:</label>
      <input type="number" id="preco" name="preco" value="<?php echo $item['preco']; ?>" step="0.01" required>

      <label for="categoria">Categoria:</label>
      <input type="text" id="categoria" name="categoria" value="<?php echo $item['categoria']; ?>" required>

      <button type="submit">Atualizar Item</button>
    </form>
  </div>
</body>

</html>