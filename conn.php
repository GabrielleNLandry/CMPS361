<?php
// authentication credentials
$host = "localhost";
$port = "5432";
$dbname = "inventory";
$username = "postgres";
$password = "Gabela2002!";

//Connection String
$dsn = "pgsql:host=$host;dbname=$dbname";

try {
    //Session
    $instance = new PDO($dsn,$user,$password);

    // Set an error alert
    $instance->setAttribute(PDO::ATTR_ERRMODE, PDO ::ERRMODE_EXCEPTION);

    //Echo messages
    echo "Successfully Connects to the Database";

} catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}
?>