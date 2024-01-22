<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div>
    <form action="index.php" method="post">
        <input type="submit" value="Back to home">
    </form>
</div>
<div class="container">
    <?php
    include 'database.php';
    session_start();

    $cart_id = isset($_SESSION['cart_id']) ? $_SESSION['cart_id'] : null;
    $totalSum = 0;
    $paymentMethod = isset($_POST['payment_method']) ? $_POST['payment_method'] : 'cash';
    $paymentId = $paymentMethod === 'cash' ? 1 : 2;

    if ($cart_id) {
        $updateStmt = $pdo->prepare("UPDATE shopping_cart SET payment_type = ? WHERE id = ?");
        $updateStmt->execute([$paymentId, $cart_id]);
        unset($_SESSION['cart']);
        unset($_SESSION['cart_id']);

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
        }
        if ($paymentMethod === 'card') {
            $totalSum *= 0.95;
        }
        echo "<p>Payment successful. Method: " . ($paymentMethod === 'card' ? "Card" : "Cash") . "</p>";
        echo "<p>Total sum" . ($paymentMethod === 'card' ? " with 5% discount" : "") . ": " . number_format($totalSum, 2) . "</p>";
    } else {
        echo "<p>No active cart found.</p>";
    }
    ?>
</div>
</body>
</html>