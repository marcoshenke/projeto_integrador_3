<?php include 'includes/db.php'; ?>
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

    <!-- Formulário para adicionar itens ao menu -->
    <form action="add_menu.php" method="POST">
      <label for="nome">Nome do Prato:</label>
      <input type="text" id="nome" name="nome" required>

      <label for="descricao">Descrição:</label>
      <textarea id="descricao" name="descricao" required></textarea>

      <label for="preco">Preço:</label>
      <input type="number" id="preco" name="preco" step="0.01" required>

      <label for="categoria">Categoria:</label>
      <input type="text" id="categoria" name="categoria" required>

      <button type="submit">Adicionar ao Menu</button>
    </form>

    <!-- Listagem dos itens no menu -->
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
        $result = $conn->query("SELECT * FROM menu");
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row['nome'] . "</td>";
          echo "<td>" . $row['descricao'] . "</td>";
          echo "<td>R$" . $row['preco'] . "</td>";
          echo "<td>" . $row['categoria'] . "</td>";
          echo "<td>
                            <a href='edit_menu.php?id=" . $row['id'] . "'>Editar</a> | 
                            <a href='delete_menu.php?id=" . $row['id'] . "'>Excluir</a>
                          </td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>