<?php
header("Content-Type: application/json");

$host = 'localhost';
$dbname = 'wtxoeyoq_organic';
$username = 'root';
$password = '';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo json_encode(["success" => false, "message" => "DB connection failed"]);
  exit;
}

// Get incoming data
$data = json_decode(file_get_contents("php://input"), true);

$name = $data["name"] ?? '';
$email = $data["email"] ?? '';
$phone = $data["phone"] ?? '';
$password = password_hash($data["password"] ?? '', PASSWORD_DEFAULT);
$cartItems = $data["cartItems"] ?? [];

try {
  // Insert user
  $stmt = $pdo->prepare("INSERT INTO user (user_username, user_email, user_password, user_mobile, user_created_date) VALUES (?, ?, ?, ?, NOW())");
  $stmt->execute([$name, $email, $password, $phone]);
  $userId = $pdo->lastInsertId();

  // Prepare cart insert statement
  $stmtCart = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity, added_at) VALUES (?, ?, ?, NOW())");

  // Loop through each product in cart
  foreach ($cartItems as $productId => $item) {
    // Check if product already exists
    $check = $pdo->prepare("SELECT COUNT(*) FROM products WHERE product_id = ?");
    $check->execute([$productId]);

    // Insert product if not already present
    if ($check->fetchColumn() == 0) {
      $insertProduct = $pdo->prepare("INSERT INTO products (
        product_id, productId, product_name, product_description, product_category,
        product_brand, product_price, product_quantity, product_image,
        product_rating, created_at
      ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

      $insertProduct->execute([
        null,
        $productId,
        $item['name'] ?? '',
        $item['description'] ?? '',
        $item['category'] ?? '',
        $item['brand'] ?? '',
        $item['price'] ?? 0,
        $item['qty'] ?? 1,
        $item['image'] ?? '',
        $item['rating'] ?? 0
      ]);
    }

    // Insert cart item
    $stmtCart->execute([$userId, $productId, $item['qty'] ?? 1]);
  }

  echo json_encode(["success" => true]);
} catch (Exception $e) {
  echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
