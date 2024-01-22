<!DOCTYPE html>
<html lang="">
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div>
    <form action="index.php" method="post">
        <input type="submit" value="Back to home">
    </form>
</div>
<div class="container">
    <form action="add_product.php" method="post" class="add-new-product-form">
        Product Name: <label>
            <input type="text" name="product_name">
        </label>
        Product Code: <label>
            <input type="text" name="product_code">
        </label>
        Unit Price: <label>
            <input type="number" step="0.01" name="unit_price">
        </label>
        <input type="submit" name="submit" value="Add Product">
    </form>
</div>
</body>
</html>
<?php
include 'database.php';

if (isset($_POST['submit'])) {
    $product_name = $_POST['product_name'];
    $product_code = $_POST['product_code'];
    $unit_price = $_POST['unit_price'];

    $stmt = $pdo->prepare("INSERT INTO products (product_name, product_code, unit_price) VALUES (?, ?, ?)");
    $stmt->execute([$product_name, $product_code, $unit_price]);

    echo "Product added successfully!";
}
?>
