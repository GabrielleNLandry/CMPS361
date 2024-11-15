<html>
  <head>
    <title>Products</title>
  </head>
  <body>
    <h1> Products</h1> 
  </body>
</html>


<?php

include 'connection.php';
$query = "SELECT * from bookstoreinventory";
$stmt = $pdo->query($query);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

error_reporting(E_ALL);
ini_set('display_errors',1);



// Validate if the data exists
if ($products && is_array($products)) {
    //pagination
    $limit = 10;
    $totalRecords =count($products);
    $totalpages = ceil($totalRecords / $limit);

    //Capture the current page or set a default page
    $currentpage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    //Calculate the starting index of the current page
    if ($currentpage < 1) {
        $currentpage = 1;
     } elseif ($currentpage > $totalpages) {
            $currentpage = $totalpages;
        }

    // Sorting logic
        $sortColumn = isset($_GET['sort']) ? $_GET['sort']:'bookname'; // Default order by 'id'
        $sortOrder = isset($_GET['order']) && $_GET['order'] == 'desc' ? 'desc' : 'asc'; // Default order is 'asc'

    //Sort the data based on colun and order
    usort($products, function($a, $b) use ($sortColumn, $sortOrder) {
      if ($sortOrder == 'asc') {
          return strcmp($a[$sortColumn], $b[$sortColumn]);
      } else {
          return strcmp($b[$sortColumn], $a[$sortColumn]);
      }
  });


    //Calculate the starting index of the current page
    $startIndex = ($currentpage - 1) * $limit;


   // Get the subset of data for the current page.
    $pageData = array_slice($products, $startIndex, $limit);

    //Function to toggle sort order
    function toggleOrder($currentOrder) {
        return $currentOrder == 'asc' ? 'desc' : 'asc';
    }

    //Display data in a Gridview (HTML Table)
    echo "<table border='1' cellpadding='10'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th><a href='?page=$currentpage&sort=bookname&order=" .toggleOrder($sortOrder) . "'>bookname</a></th>";
    echo "<th><a href='?page=$currentpage&sort=authorname&order=" .toggleOrder($sortOrder) . "'>authorname</a></th>";
    echo "<th><a href='?page=$currentpage&sort=isbn&order=" .toggleOrder($sortOrder) . "'>isbn</a></th>";
    echo "<th><a href='?page=$currentpage&sort=booktype&order=" .toggleOrder($sortOrder) . "'>booktype</a></th>";
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
    if ($currentpage > 1) {
        echo 'a href="?page=' . ($currentpage - 1) . '&sort=' . $sortColumn . '&order' . $sortOrder . '">Previous</a> ';
    }

    //Display page numbers
    for ($i = 1; $i <= $totalpages; $i++) {
        if ($i == $currentpage) {
            echo "<strong>$i</strong> ";
        } else {
            echo '<a href="?page='. $i . '&sort=' .$sortColumn . '&order=' . $sortOrder . '">' . $i . '</a> ';
        }
    }

    // Display the "Next" Link if not on the last page
    if ($currentpage < $totalpages) {
        echo '<a href="?page=' . ($currentpage + 1) . '&sort' . $sortColumn . '&order' . $sortOrder . '">Next </a?';
    }

    echo "</div";

//Display total number of records at the bottom
echo "<div style='margin-top: 20px:'>";
echo "<strong> Total Records: $totalRecords</strong>";
echo "</div>";

} else {
    echo "Sorry, no data is available.";
}


?>

