<?php
  $host = 'localhost';  // Update this if necessary
  $dbname = 'Bookstore_Database';
  $user = 'postgres';   // PostgreSQL username
  $pass = 'Gabela2002!'; // PostgreSQL password
  $port = '5432'; // Default PostgreSQL port

  try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  } catch (PDOException $e){
    echo 'Connection failed: ' . $e->getMessage();
  }
  
?>