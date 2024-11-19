<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db/helpers/dbConnection.php';

$sql_categories = "SELECT * FROM categories";
$result_categories = $connect->query($sql_categories);

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
    header("Location: list_menu.php");
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
</head>
<style>
  <?php include "css/style.css" ?>
</style>

<body>
  <div class="container">
    <h1>Editar Item</h1>
    <form action="edit_menu.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
      <label for="name">Nome do Item:</label>
      <input type="text" id="name" name="name" value="<?php echo $item['name']; ?>" required>

      <label for="description">Descrição:</label>
      <textarea id="description" name="description" required><?php echo $item['description']; ?></textarea>

      <label for="price">Preço:</label>
      <input type="number" id="price" name="price" value="<?php echo $item['price']; ?>" step="0.01" required>

      <label for="category_id">Categoria:</label>
      <select name="category_id" id="category_id">
        <?php while ($row = $result_categories->fetch_assoc()): ?>
          <?php
          $defaultCategory = $item['category_id'];
          $selected = ($defaultCategory === $row['id']) ? 'selected' : '';
          ?>
          <option value="<?= $row['id']; ?>" <?= $selected; ?>>
            <?= $row['name']; ?>
          </option>
        <?php endwhile; ?>
      </select>

      <button type="submit">Atualizar Item</button>
    </form>
  </div>
</body>

</html>