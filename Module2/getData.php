<?php

$apiURL = "http://localhost:8080/Module2/conn.php"; 

// Fetch the data
$response = file_get_contents($apiURL);
// Decode JSON
$data = json_decode($response, true);


// Validate if the data exists
if ($data && is_array($data)) {
    //pagination
    $limit = 10;
    $totalRecords =count($data);
    $totalPages = ceil($totalRecords / $limit);

    //Capture the current page or set a default page
    $currentpage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    //Calculate the starting index of the current page
    if ($currentpage < 1) {
        $currentpage = 1;
     } elseif ($currentpage > $totalpage) {
            $currentpage = $totalPages;
        }


    $startIndex = ($currentpage - 1) * $limit;
    $pageData = array_slice($data, $startIndex, $limit);

    // Build out the table
    echo "<table border='1' cellpadding='10'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Book Name</th>";
    echo "<th>Author Name</th>";
    echo "<th>ISBN Number</th>";
    echo "<th>Book Genre</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Loop through the data
    foreach ($pageData as $post) { 
        echo "<tr>";
        echo "<td>" . htmlspecialchars($post['bookname']) . "</td>";
        echo "<td>" . htmlspecialchars($post['authorname']) . "</td>";
        echo "<td>" . htmlspecialchars($post['isbn']) . "</td>";
        echo "<td>" . htmlspecialchars($post['booktype']) . "</td>";
        echo "</tr>"; 
    }
    echo "</tbody>";
    echo "</table>";

} else {
    echo "Sorry, no data is available.";
}


?>
