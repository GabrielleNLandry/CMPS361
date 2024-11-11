<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['productname'];
    //any field displayed at the bottom

    $query = "INSERT INTO products (productname,description,price,stock_level) VALUES(:productname,:description,:price,:stock_level)";
    $stmt->execute(['productname' => $name]);
}

?>

<html>
    <head>
        <title>Add Product </title>
    </head>
<body>
    <form method="POST">
        <label>Product Name:</label>
        <input type="text" name="productname" require><br>
    </form>
</body>
</html>