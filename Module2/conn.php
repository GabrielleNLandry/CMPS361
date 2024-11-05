<?php
// authentication credentials
$host = "localhost";
$port = "5432";
$dbname = 'Bookstore_Database';
$username = "postgres";
$password = "Gabela2002!";

// Connection String
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

try {
    // Session
    $instance = new PDO($dsn, $username, $password);

    // Set an error alert
    $instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Echo message
    echo "Successfully connected to the database";

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
