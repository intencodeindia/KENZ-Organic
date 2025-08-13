<?php
session_start();
header("Content-Type: application/json");

// DB connection details
$host = 'localhost';
$dbname = 'wtxoeyoq_organic';
$username = 'root';
$password = '';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo json_encode(["success" => false, "message" => "Database connection failed"]);
  exit;
}

// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);
$email = $data["email"] ?? '';
$passwordInput = $data["password"] ?? '';

if (!$email || !$passwordInput) {
  echo json_encode(["success" => false, "message" => "Email and password are required"]);
  exit;
}

try {
  $stmt = $pdo->prepare("SELECT * FROM user WHERE user_email = ?");
  $stmt->execute([$email]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($passwordInput, $user['user_password'])) {
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['user_name'] = $user['user_username'];
    $_SESSION['user_email'] = $user['user_email'];

    echo json_encode([
      "success" => true,
      "message" => "Login successful",
      "user" => [
        "id" => $user['user_id'],
        "name" => $user['user_username'],
        "email" => $user['user_email']
      ]
    ]);
  } else {
    echo json_encode(["success" => false, "message" => "Invalid email or password"]);
  }
} catch (Exception $e) {
  echo json_encode(["success" => false, "message" => "Login failed: " . $e->getMessage()]);
}
?>
