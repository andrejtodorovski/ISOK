<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Transactions Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div>
    <form action="index.php" method="post">
        <input type="submit" value="Back to home">
    </form>
</div>
<div class="container-reverse">
    <form action="daily_transactions.php" method="GET">
        <label for="date">Select Date:</label>
        <input class="date-input" type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
        <input type="submit" value="Show Turnover">
    </form>

    <?php
    include 'database.php';

    $selectedDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

    $stmt = $pdo->prepare("SELECT id, payment_type FROM shopping_cart WHERE date_and_time >= ? AND date_and_time < ? + INTERVAL 1 DAY ORDER BY date_and_time ASC");
    $stmt->execute([$selectedDate, $selectedDate]);
    $transactions = $stmt->fetchAll();

    if ($transactions) {
        echo "<table>";
        echo "<tr><th>Shopping Cart ID</th><th>Total Amount</th><th>Payment Type</th></tr>";
        foreach ($transactions as $transaction) {
            $stmt = $pdo->prepare("
        SELECT p.product_name, p.unit_price, ci.product_amount, (p.unit_price * ci.product_amount) AS total_price
        FROM cart_items ci 
        JOIN products p ON ci.product_id = p.id 
        WHERE ci.cart_id = ?
    ");
            $stmt->execute([$transaction['id']]);

            $cartItems = $stmt->fetchAll();
            $totalSum = 0;
            if ($cartItems) {
                foreach ($cartItems as $item) {
                    $totalSum += $item['total_price'];
                }
            }
            if ($transaction['payment_type'] === 2) {
                $totalSum *= 0.95;
            }
            echo "<tr>";
            echo "<td>{$transaction['id']}</td>";
            echo "<td>" . number_format($totalSum, 2) . "</td>";
            echo "<td>" . ($transaction['payment_type'] === 1 ? 'Cash' : 'Card') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No transactions found for selected date.</p>";
    }
    ?>
</div>
</body>
</html>
