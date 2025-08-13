<?php
session_start();
header('Content-Type: application/json');
require_once('../function/db.php');

// Basic validation
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$input = json_decode(file_get_contents("php://input"), true);
if (!$input) {
    echo json_encode(['success' => false, 'message' => 'Invalid JSON']);
    exit;
}

$productId = $input['product_id'] ?? null;
$action = $input['action'] ?? null;

if (!isset($_SESSION['user_id']) || !$productId || !$action) {
    echo json_encode(['success' => false, 'message' => 'Missing data or not logged in']);
    exit;
}

$userId = $_SESSION['user_id'];

try {
    // Check if item exists
    $stmt = $conn->prepare("SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$userId, $productId]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$item) {
        echo json_encode(['success' => false, 'message' => 'Item not found']);
        exit;
    }

    $qty = (int) $item['quantity'];

    if ($action === 'increment') {
        $qty++;
        $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$qty, $userId, $productId]);

    } elseif ($action === 'decrement') {
        $qty = max(1, $qty - 1);
        $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$qty, $userId, $productId]);

    } elseif ($action === 'delete') {
        $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$userId, $productId]);

        echo json_encode(['success' => true, 'message' => 'Item deleted']);
        exit;
    }

    echo json_encode([
        'success' => true,
        'product_id' => $productId,
        'new_quantity' => $qty,
        'message' => 'Cart updated'
    ]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
