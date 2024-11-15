<?php

$connect = mysqli_connect(
  'db',
  'restaurant_user_db',
  'password',
  'restaurant_db'
);

$query = 'SELECT * FROM dishes';
$result = mysqli_query($connect, $query);

echo '<h1>Todos os pratos do restaurante!</h1>';

while ($record = mysqli_fetch_assoc($result)) {
  echo '<h2>' . $record['name'] . '</h2>';
  echo '<p>' . $record['category_id'] . '</p>';
  echo '<p>' . $record['price'] . '</p>';
}
