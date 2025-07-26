<?php
session_start();
header('Content-Type: application/json');

if (!isset($_POST['id'], $_POST['quantity'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing product ID or quantity']);
    exit;
}

$id = trim($_POST['id']);
$quantity = intval($_POST['quantity']);

if ($quantity <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Quantity must be at least 1']);
    exit;
}

if (!isset($_SESSION['cart'][$id])) {
    http_response_code(404);
    echo json_encode(['error' => 'Product not found in cart']);
    exit;
}

$_SESSION['cart'][$id]['quantity'] = $quantity;
$_SESSION['cart'][$id]['total'] = $_SESSION['cart'][$id]['price'] * $quantity;

echo json_encode(['success' => true]);
