
<?php
session_start();
include_once('../function/db.php');
require_once '../function/constants.php';  // Defines STRIPE_SECRET_KEY

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['user_id'];


// Sanitize input data
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

$billing = [
    'recipient_name' => sanitize($_POST['billing_recipient_name']),
    'address' => sanitize($_POST['billing_address']),
    'city' => sanitize($_POST['billing_city']),
    'state' => sanitize($_POST['billing_state']),
    'pincode' => sanitize($_POST['billing_pincode']),
    'mobile' => sanitize($_POST['billing_mobile']),
];

$shipping = [
    'recipient_name' => sanitize($_POST['shipping_recipient_name']),
    'address' => sanitize($_POST['shipping_address']),
    'city' => sanitize($_POST['shipping_city']),
    'state' => sanitize($_POST['shipping_state']),
    'pincode' => sanitize($_POST['shipping_pincode']),
    'mobile' => sanitize($_POST['shipping_mobile']),
    'country' => strtoupper(sanitize($_POST['shipping_country'])),  // important: uppercase country code
];

// Define agricultural product IDs (replace with your actual product IDs)
$agriculturalProductIds = [101, 102, 103, 104]; // Example: polytunnel=101, dutch buckets=102, fan pad=103, tower garden=104

// Define tax rates by country code (decimal fraction)
$taxRatesByCountry = [
    'IN' => 0.18, // 18% GST
    'UK' => 0.20, // 20% VAT
    'US' => 0.0,  // No tax example
    // add more countries here as needed
];

// Get user country from shipping address
$userCountry = $shipping['country'] ?? 'IN';
$taxRate = $taxRatesByCountry[$userCountry] ?? 0;

// Fetch cart items
$stmt = $conn->prepare("
    SELECT 
        c.product_id,
        c.quantity,
        p.product_price,
        p.product_name
    FROM cart c
    JOIN products p ON c.product_id = p.product_id
    WHERE c.user_id = :user_id
");
$stmt->execute(['user_id' => $userId]);

$line_items = [];
$metadata = [];
$totalTaxAmount = 0;

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $productId = (int)$row['product_id'];
    $quantity = (int)$row['quantity'];
    $price = (float)$row['product_price'];
    $name = $row['product_name'];
    
    // Add product line item
    $line_items[] = [
        'price_data' => [
            'currency' => 'inr',
            'product_data' => ['name' => $name],
            'unit_amount' => (int)($price * 100),
        ],
        'quantity' => $quantity,
    ];

    // Calculate tax only if product is agricultural and tax rate > 0
    if (in_array($productId, $agriculturalProductIds) && $taxRate > 0) {
        $totalTaxAmount += round($price * $quantity * $taxRate, 2);
    }

    // Add product metadata
    $metadata["product_{$productId}_name"] = $name;
    $metadata["product_{$productId}_qty"] = $quantity;
    $metadata["product_{$productId}_price"] = $price;
}

// Add tax as separate line item if tax > 0
if ($totalTaxAmount > 0) {
    $line_items[] = [
        'price_data' => [
            'currency' => 'inr',
            'product_data' => ['name' => 'Tax (' . ($taxRate * 100) . '%)'],
            'unit_amount' => (int)($totalTaxAmount * 100),
        ],
        'quantity' => 1,
    ];
}

// Add user and addresses info to metadata
$metadata['user_id'] = $userId;
foreach ($billing as $key => $value) {
    $metadata["billing_{$key}"] = $value;
}
foreach ($shipping as $key => $value) {
    $metadata["shipping_{$key}"] = $value;
}

// Prepare payload for Stripe checkout session
$payload = [
    // 'payment_method_types[]' => 'card',
    'mode' => 'payment',
    'billing_address_collection' => 'required',   // ask Stripe for billing address
    'success_url' => BASE_URL . '/payment/success.php?session_id={CHECKOUT_SESSION_ID}',
    'cancel_url' => BASE_URL . '/payment/checkout.php',
    
    // Multiple payment methods
    'payment_method_types[]' => 'card',
        'tax_id_collection[enabled]' => 'true',

];

// Add line_items to payload
foreach ($line_items as $index => $item) {
    $payload["line_items[{$index}][price_data][currency]"] = $item['price_data']['currency'];
    $payload["line_items[{$index}][price_data][product_data][name]"] = $item['price_data']['product_data']['name'];
    $payload["line_items[{$index}][price_data][unit_amount]"] = $item['price_data']['unit_amount'];
    $payload["line_items[{$index}][quantity]"] = $item['quantity'];
}

// Add metadata to payload
foreach ($metadata as $key => $value) {
    $payload["metadata[{$key}]"] = $value;
}

// Execute cURL POST request to Stripe API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/checkout/sessions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_USERPWD, STRIPE_SECRET_KEY . ':');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
    curl_close($ch);
    exit();
}

curl_close($ch);

$responseData = json_decode($response, true);

if (isset($responseData['url'])) {
    header('Location: ' . $responseData['url']);
    exit();
} else {
    echo "<h3>Stripe API Error:</h3><pre>";
    print_r($responseData);
    echo "</pre>";
    exit();
}
