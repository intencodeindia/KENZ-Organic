<?php
session_start();
require_once '../function/db.php';
require_once '../function/constants.php';  // Ensure STRIPE_SECRET_KEY is defined here

// Validate Stripe session_id and user session
if (!isset($_GET['session_id']) || empty($_GET['session_id'])) {
    die('Invalid request.');
}
if (!isset($_SESSION['user_id'])) {
    die('User not logged in.');
}

$sessionId = $_GET['session_id'];
$userId    = $_SESSION['user_id'];

// Fetch Stripe Checkout Session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.stripe.com/v1/checkout/sessions/{$sessionId}?expand[]=line_items");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, STRIPE_SECRET_KEY . ":");
$response = curl_exec($ch);
if (curl_errno($ch)) {
    die("Stripe cURL error: " . curl_error($ch));
}
curl_close($ch);

$data = json_decode($response, true);
if (!$data || isset($data['error'])) {
    die('Stripe API error: ' . ($data['error']['message'] ?? 'unknown'));
}

$metadata  = $data['metadata'] ?? [];
$lineItems = $data['line_items']['data'] ?? [];

if (empty($metadata) || empty($lineItems)) {
    die('Missing order data.');
}

// Extract payment details
$paymentStatus = $data['payment_status'] ?? '';
$paymentMethod = $data['payment_method_types'][0] ?? '';
$intentId      = $data['payment_intent'] ?? '';
$totalAmount   = isset($data['amount_total']) ? $data['amount_total'] / 100 : 0;

try {
    $conn->beginTransaction();

    // Insert order
    $stmt = $conn->prepare("
        INSERT INTO orders (user_id, stripe_session_id, amount_total, created_at)
        VALUES (?, ?, ?, NOW())
    ");
    $stmt->execute([$userId, $sessionId, $totalAmount]);
    $orderId = $conn->lastInsertId();

    // Insert order items
    foreach ($metadata as $key => $val) {
        if (preg_match('/product_(\d+)_qty/', $key, $m)) {
            $pid   = (int)$m[1];
            $qty   = (int)$val;
            $price = isset($metadata["product_{$pid}_price"]) ? (float)$metadata["product_{$pid}_price"] : 0.0;

            $stmt = $conn->prepare("
                INSERT INTO order_items (order_id, product_id, quantity, price)
                VALUES (?, ?, ?, ?)
            ");
            $stmt->execute([$orderId, $pid, $qty, $price]);
        }
    }

    // Insert address data
    foreach (['billing', 'shipping'] as $type) {
        $keys = [
            "{$type}_recipient_name",
            "{$type}_address",
            "{$type}_city",
            "{$type}_state",
            "{$type}_pincode",
            "{$type}_mobile"
        ];
        $hasAll = array_reduce($keys, fn($carry, $k) => $carry && isset($metadata[$k]), true);

        if ($hasAll) {
            $stmt = $conn->prepare("
                INSERT INTO shipping_details
                (order_id, user_id, recipient_name, address, city, state, pincode, mobile, shipping_date, address_type)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)
            ");
            $stmt->execute([
                $orderId,
                $userId,
                $metadata["{$type}_recipient_name"],
                $metadata["{$type}_address"],
                $metadata["{$type}_city"],
                $metadata["{$type}_state"],
                $metadata["{$type}_pincode"],
                $metadata["{$type}_mobile"],
                $type
            ]);
        }
    }

    // Insert payment info
    $stmt = $conn->prepare("
        INSERT INTO payment (order_id, payment_method, payment_status, transaction_id, payment_date)
        VALUES (?, ?, ?, ?, NOW())
    ");
    $stmt->execute([$orderId, $paymentMethod, $paymentStatus, $intentId]);

    // Insert initial tracking
    $stmt = $conn->prepare("
        INSERT INTO order_tracking (order_id, status_update, updated_at)
        VALUES (?, ?, NOW())
    ");
    $stmt->execute([$orderId, 'Order placed']);

    $conn->commit();

    // SUCCESS PAGE HTML
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Payment Successful</title>
    <style>
        body {
            margin: 0;
            background: #198754;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .success-container {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            max-width: 500px;
            width: 100%;
        }
        .checkmark {
            font-size: 60px;
            background: white;
            color: #198754;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            box-shadow: 0 0 0 6px rgba(255,255,255,0.3);
        }
        h2 {
            margin: 10px 0;
            font-size: 2rem;
        }
        p {
            margin: 6px 0;
            font-size: 1.1rem;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 18px;
            background: white;
            color: #198754;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            background: #f8f9fa;
        }
              /* Confetti Styles */
    .confetti {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        overflow: hidden;
        z-index: 1;
    }
    .confetti-piece {
        position: absolute;
        top: -10px;
        opacity: 0.8;
        animation-name: fall;
        animation-timing-function: linear;
        animation-iteration-count: infinite;
    }
    @keyframes fall {
        0% { transform: translateY(0) rotate(0deg); }
        100% { transform: translateY(100vh) rotate(360deg); }
    }
    </style>
    </head>
    <body>
    
        <div class="success-container">
            <div class="checkmark">&#10003;</div>
            <h2>Payment Successful!</h2>
            <p>Your order has been placed successfully.</p>
            <p><strong>Transaction ID:</strong> ' . htmlspecialchars($intentId) . '</p>
            <a href="/orders.php">View My Orders</a>
        </div>
    </body>
    </html>
    ';
} catch (PDOException $e) {
    $conn->rollBack();
    error_log("Order save error [User {$userId}, Session {$sessionId}]: " . $e->getMessage());

    echo "<h2>Oops!</h2>";
    echo "<p>Your payment was successful but we couldn’t save your order.</p>";
    echo "<p>Please contact support with your transaction ID: <strong>{$intentId}</strong></p>";
}
exit;
