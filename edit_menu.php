<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db/helpers/dbConnection.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = $connect->query("SELECT * FROM items WHERE id = $id");
  $item = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $category_id = $_POST['category_id'];

  $sql = "UPDATE items SET name = ?, description = ?, price = ?, category_id = ? WHERE id = ?";
  $stmt = $connect->prepare($sql);
  $stmt->bind_param("ssdsi", $name, $description, $price, $category_id, $id);

  if ($stmt->execute()) {
    header("Location: index.php");
  } else {
    echo "Erro ao atualizar item: " . $connect->error;
  }

  $stmt->close();
  $connect->close();
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
      <label for="name">Nome do Prato:</label>
      <input type="text" id="name" name="name" value="<?php echo $item['name']; ?>" required>

      <label for="description">Descrição:</label>
      <textarea id="description" name="description" required><?php echo $item['description']; ?></textarea>

      <label for="price">Preço:</label>
      <input type="number" id="price" name="price" value="<?php echo $item['price']; ?>" step="0.01" required>

      <label for="category_id">Categoria:</label>
      <input type="text" id="category_id" name="category_id" value="<?php echo $item['category_id']; ?>" required>

      <button type="submit">Atualizar Item</button>
    </form>
  </div>
</body>

</html>