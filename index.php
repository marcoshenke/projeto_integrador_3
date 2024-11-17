<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db/helpers/dbConnection.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Menu - Restaurante</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="container">
    <h1>Menu do Restaurante</h1>

    <form action="add_menu.php" method="post">
      <label for="name">Nome do Prato:</label>
      <input type="text" id="name" name="name" required>

      <label for="description">Descrição:</label>
      <textarea id="description" name="description" required></textarea>

      <label for="price">Preço:</label>
      <input type="number" id="price" name="price" step="0.01" required>

      <label for="category_id">Categoria:</label>
      <input type="text" id="category_id" name="category_id" required>

      <button type="submit" id="submit" name="submit">Adicionar ao Menu</button>
    </form>

    <h2>Itens Cadastrados</h2>
    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Preço</th>
          <th>Categoria</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $result = $connect->query("SELECT * FROM items");
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
          <td>$row[name]</td>
          <td>$row[description]</td>
          <td>$row[price]</td>
          <td>$row[category_id]</td>
          <td>
            <a href='edit_menu.php?id=$row[id]'>Editar</a>  
            <a href='delete_menu.php?id=$row[id]'>Excluir</a>
          </td>
          </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>