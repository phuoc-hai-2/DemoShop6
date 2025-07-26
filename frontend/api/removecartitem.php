<?php
session_start();
header('Content-Type: application/json');

if (!isset($_POST['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing product ID']);
    exit;
}

$id = trim($_POST['id']);

if (!isset($_SESSION['cart'][$id])) {
    http_response_code(404);
    echo json_encode(['error' => 'Product not found in cart']);
    exit;
}

unset($_SESSION['cart'][$id]);

echo json_encode(['success' => true]);
