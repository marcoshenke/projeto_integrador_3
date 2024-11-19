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
    <div class="head-list">
      <h1>Itens Cadastrados</h1>
      <a href="index.php" class="all-itens button_head_list">Cadastrar</a>
    </div>
    <table>
      <thead>
        <tr>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Preço</th>
          <th>
            Categoria
          </th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $result = $connect->query("SELECT items.*, categories.name AS category_name 
                                  FROM items 
                                  JOIN categories ON items.category_id = categories.id");
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
          <td>$row[name]</td>
          <td>$row[description]</td>
          <td>$row[price]</td>
          <td>$row[category_name]</td>
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