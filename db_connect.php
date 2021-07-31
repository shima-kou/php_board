<?php
$dsn = "mysql:host=db;dbname=db_board;";
$user = 'root';
$password = 'root';

try {
  $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
  echo $e->getMessage();
  exit;
}
