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

    // Sorting logic
        $sortColumn = isset($_GET['sort']) ? $_GET['sort']:'bookname'; // Default order by 'id'
        $sortOrder = isset($_GET['order']) && $_GET['order'] == 'desc' ? 'desc' : 'asc'; // Default order is 'asc'

    //Sort the data based on colun and order
    usort($data, function($a, $b) use ($sortColumn, $sortOrder) {
        if ($sortOrder == 'asc') {
            return strcmp($a[$sortColumn], $b[$sortColumn]);
        } else {
            return strcmp($b[$sortColumn], $a[$sortColumn]);
        }
    });

    //Calculate the starting index of the current page
    $startIndex = ($curretnPage - 1) * $limit;


   // Get the subset of data for the current page.
    $pageData = array_slice($data, $startIndex, $limit);

    //Function to toggle sort order
    function toggleOrder($currentOrder) {
        return $currentOrder == 'asc' ? 'desc' : 'asc';
    }

    //Display data in a Gridview (HTML Table)

    // Build out the table
    echo "<table border='1' cellpadding='10'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th><a href'?page=$currentPage&sort=bookname&order=" .toggleOrder($sortOrder) . "'>bookname</a></th>";
    echo "<th><a href'?page=$currentPage&sort=authorname&order=" .toggleOrder($sortOrder) . "'>authorname</a></th>";
    echo "<th><a href'?page=$currentPage&sort=isbn&order=" .toggleOrder($sortOrder) . "'>isbn</a></th>";
    echo "<th><a href'?page=$currentPage&sort=booktype&order=" .toggleOrder($sortOrder) . "'>booktype</a></th>";
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

    //Pagination Links
    echo "<div style= 'margin-top: 20px; '>";

    //Display "Previous" link if not on the first page
    if ($currentPage > 1) {
        echo 'a href="?page=' . ($currentPage - 1) . '&sort=' . $sortColumn . '&order' . $sortOrder . '">Previous</a> ';
    }

    //Display page numbers
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            echo "<strong>$i</strong> ";
        } else {
            echo '<a href="?page='. $i . '&sort=' .$sortColumn . '">' . $i . '</a> ';
        }
    }

    // Dsiplay the "Next" Link
    if ($currentPage < $totalPages) {
        echo '<a href="?page=' . ($curretnPage + 1) .'&sort=' . $sortOrder . '">' . $i . '</a>' ;
    }

    echo "</div";

//Display total number of records at the bottom
echo "<div style='margin-top: 20px:'>";
echo "<strong>Total Records: $totalRecords</strong>";
echo "</div>";

} else {
    echo "Sorry, no data is available.";
}


?>
