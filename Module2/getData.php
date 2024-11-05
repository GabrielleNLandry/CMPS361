<?php

$apiURL = "http://localhost:8000/Module2/conn.php";

//Fetch the data
$response = file_get_contents($apiURL);
//Decode the JSON
$data =json_decode($response, true);

//Validate if the data exist
if ($data && is_array($data)){
    //Build out the table
    echo"<table border = '1' cellpadding = '10'>";
    echo "<thread>";
    echo "<tr>";
    echo "<th>bookname</th>";
    echo "<th>authorname</th>";
    echo "<th>isbn</th>";
    echo "<th>booktype</th>";
    echo "</tr>";
    echo "</thread>";
    echo "<tbody>";

    //Loop through the data
    foreach($data as $_POST) {
        echo"<tr>";
        echo"<td>" . htmlspecialchars($post['bookname']) . "</td>";
        echo"<td>" . htmlspecialchars($post['authorname']) . "</td>";
        echo"<td>" . htmlspecialchars($post['isbn']) . "</td>";
        echo"<td>" . htmlspecialchars($post['booktype']) . "</td>";
    }
    echo "<tbody>";
    echo "</table>";

} else {
    echo "Sorry no data is available.";
}

?>