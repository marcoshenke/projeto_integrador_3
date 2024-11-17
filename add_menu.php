<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db/helpers/dbConnection.php';


if (isset($_POST['submit'])) {


  if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['category_id'])) {


    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $description = mysqli_real_escape_string($connect, $_POST['description']);
    $price = mysqli_real_escape_string($connect, $_POST['price']);
    $category_id = mysqli_real_escape_string($connect, $_POST['category_id']);


    $sql = "INSERT INTO items (name, description, price, category_id) VALUES (?, ?, ?, ?)";


    if ($stmt = mysqli_prepare($connect, $sql)) {

      mysqli_stmt_bind_param($stmt, "ssdi", $name, $description, $price, $category_id);


      if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit;
      } else {
        echo "Erro ao inserir dados. Tente novamente mais tarde.";
      }

      mysqli_stmt_close($stmt);
    } else {
      echo "Erro ao preparar a query. Tente novamente mais tarde.";
    }
  } else {
    echo "Todos os campos do item devem ser preenchidos.";
  }
} else {
  echo "Algo deu errado.";
}
