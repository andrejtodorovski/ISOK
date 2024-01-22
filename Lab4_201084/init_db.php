<?php
require_once 'database.php';

$sql = file_get_contents('supermarket.sql');

try {
    $pdo->exec($sql);
    echo "Database initialized successfully.";
} catch (PDOException $e) {
    echo "Database initialization failed: " . $e->getMessage();
}
