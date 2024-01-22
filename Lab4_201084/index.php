<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarket Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="buttons-div">
    <form action="add_product.php" method="post">
        <input type="submit" value="Add a new product">
    </form>
    <form action="daily_transactions.php" method="post">
        <input type="submit" value="Daily transactions">
    </form>
</div>
<div class="container">
    <form class="add-to-cart-form" action="index.php" method="post">
        <label>Product Code:
            <input type="text" name="product_code">
        </label>
        <label>Quantity:
            <input type="number" name="quantity">
        </label>
        <input type="submit" name="add_to_cart" value="Add to Cart">
    </form>

    <?php
    include 'database.php';

    session_start();

    if (!isset($_SESSION['cart_id'])) {
        $cartInsertStmt = $pdo->prepare("INSERT INTO shopping_cart (date_and_time) VALUES (NOW())");
        $cartInsertStmt->execute();
        $cart_id = $pdo->lastInsertId();
        $_SESSION['cart_id'] = $cart_id;
    } else {
        $cart_id = $_SESSION['cart_id'];
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_POST['add_to_cart'])) {
        $product_code = $_POST['product_code'];
        $quantity = $_POST['quantity'];

        $stmt = $pdo->prepare("SELECT * FROM products WHERE product_code = ?");
        $stmt->execute([$product_code]);
        $product = $stmt->fetch();

        if ($product) {
            $_SESSION['cart'][] = [
                'product_name' => $product['product_name'],
                'unit_price' => $product['unit_price'],
                'quantity' => $quantity,
                'total_price' => $product['unit_price'] * $quantity
            ];

            $insertStmt = $pdo->prepare("INSERT INTO cart_items (product_id, cart_id, product_amount) VALUES (?, ?, ?)");
            $insertStmt->execute([$product['id'], $cart_id, $quantity]);
        } else {
            echo "Product does not exist.";
        }
    }

    if ($cart_id) {
        $stmt = $pdo->prepare("
        SELECT p.product_name, p.unit_price, ci.product_amount, (p.unit_price * ci.product_amount) AS total_price
        FROM cart_items ci 
        JOIN products p ON ci.product_id = p.id 
        WHERE ci.cart_id = ?
    ");
        $stmt->execute([$cart_id]);

        $cartItems = $stmt->fetchAll();
        $totalSum = 0;

        if ($cartItems) {
            echo '<div class="cart-table">';
            echo "<h2 class='align-center'>Cart $cart_id</h2>";
            echo '<table>';
            echo '<tr><th>Product Name</th><th>Unit Price</th><th>Quantity</th><th>Total Price</th></tr>';

            foreach ($cartItems as $item) {
                $totalSum += $item['total_price'];
                echo '<tr>';
                echo "<td>{$item['product_name']}</td>";
                echo "<td>" . number_format($item['unit_price'], 2) . "</td>";
                echo "<td>" . number_format($item['product_amount']) . "</td>";
                echo "<td>" . number_format($item['total_price'], 2) . "</td>";
                echo '</tr>';
            }

            echo '</table>';
            echo "<p>Total sum: " . number_format($totalSum, 2) . "</p>";
            echo '
<div class="buttons-div">
<form action="pay.php" method="post">
    <input type="hidden" name="payment_method" value="cash">
    <input type="submit" value="Pay with cash">
</form>

<form action="pay.php" method="post">
    <input type="hidden" name="payment_method" value="card">
    <input type="submit" value="Pay with card">
</form>
</div>';
            echo '</div>';
        } else {
            echo "<p class='align-center'>Your cart is empty.</p>";
        }
    } else {
        echo "<p class='align-center'>No active cart found.</p>";
    }
    ?>
</div>
</body>
</html>