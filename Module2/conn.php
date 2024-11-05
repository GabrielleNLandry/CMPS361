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

    // Query to fetch data
    $query = "SELECT * FROM bookstoreinventory"; // Replace with your actual table name
    $stmt = $instance->query($query);

    // Fetch all results as an associative array
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($data);

} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
?>

