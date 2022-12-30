<?php 
try {
    $pdo = new PDO ('mysql:dbname=sozialesnetzwerk;host=localhost; charset=utf8','starkoch', 'WasserZuWein');
} catch (PDOException $e) {
  die ($e->getMessage());
} 
?>