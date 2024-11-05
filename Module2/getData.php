<?php

$apiURL = "http://localhost:8080/Module2/conn.php"; 

// Fetch the data
$response = file_get_contents($apiURL);

// Validate if the response was successful
if ($response === FALSE) {
    die("Error occurred while fetching data from API: " . error_get_last()['message']);
}

// Decode the JSON
$data = json_decode($response, true);

// Validate if the data exists
if ($data && is_array($data)) {
    // Build out the table
    echo "<table border='1' cellpadding='10'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>bookname</th>";
    echo "<th>authorname</th>";
    echo "<th>isbn</th>";
    echo "<th>booktype</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Loop through the data
    foreach ($data as $post) { // Change $_POST to $post
        echo "<tr>";
        echo "<td>" . htmlspecialchars($post['bookname']) . "</td>";
        echo "<td>" . htmlspecialchars($post['authorname']) . "</td>";
        echo "<td>" . htmlspecialchars($post['isbn']) . "</td>";
        echo "<td>" . htmlspecialchars($post['booktype']) . "</td>";
        echo "</tr>"; // Added closing row tag here
    }
    echo "</tbody>";
    echo "</table>";

} else {
    echo "Sorry, no data is available.";
}

?>
