<?php

include 'connection.php';
$query = "SELECT * from bookstoreinventory";
$stmt = $pdo->query($query);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

error_reporting(E_ALL);
ini_set('display_errors',1);

?>

<html>
  <head>
    <title>Products</title>
  </head>
  <body>
    <h1>Products</h1>
    <table>
        <thread>
          <tr>
            <th>Book Name</th>
            <th>Author Name</th>
            <th>isbn</th>
            <th>Book Type</th>
          </tr>
        </thread>
        <tbody>
            <?php foreach($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['bookname']) ?></td>
                    <td><?= htmlspecialchars($product['authorname']) ?></td>
                    <td><?= htmlspecialchars($product['isbn']) ?></td>
                    <td><?= htmlspecialchars($product['booktype']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
  </body>

</html>