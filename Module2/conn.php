<?php
// authentication credentials
$host = "localhost";
$port = "5432";
$dbname = 'Bookstore_Database'; // Ensure this matches your actual database name
$username = "postgres";
$password = "Gabela2002!";

// Connection String
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

try {
    // Session
    $instance = new PDO($dsn, $username, $password);

    // Set an error alert
    $instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare response data
    $response = [
        'status' => 'success',
        'message' => 'Successfully connected to the database',
    ];
    

} catch (PDOException $e) {
    // Prepare error response
    $response = [
        'status' => 'error',
        'message' => "Connection failed: " . $e->getMessage(),
    ];
}

// Set the content type to application/json
header('Content-Type: application/json');
// Return the JSON response
echo json_encode($response);
?>
