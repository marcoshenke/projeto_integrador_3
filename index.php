<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db/helpers/dbConnection.php';

$sql = "SELECT * FROM categories";
$result = $connect->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Menu - Restaurante</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<style>
  <?php 
    include "css/style.css"  
  ?>
</style>

<body>
  <div class="container">
    <h1>Cadastro - Menu Restaurante</h1>

    <form action="add_menu.php" method="post">
      <label for="name">Nome do Item:</label>
      <input type="text" id="name" name="name" required>

      <label for="description">Descrição:</label>
      <textarea id="description" name="description" required></textarea>

      <label for="price">Preço:</label>
      <input type="number" id="price" name="price" step="0.01" required>

      <label for="category_id">Categoria:</label>
      <select name="category_id" id="category_id">
        <?php while ($row = $result->fetch_assoc()): ?>
          <option value="<?= $row['id']; ?>">
            <?= $row['name']; ?>
          </option>
        <?php endwhile; ?>
      </select>

      <button type="submit" id="submit" name="submit">Adicionar ao Menu</button>
      <a class="all-itens" href="list_menu.php">
        <p>Ver todos os itens cadastrados</p>
      </a>
    </form>

    
  </div>
</body>

</html>