<?php
require 'db.php'; 
header("Content-Type: application/json");

// ✅ Define your secret API token
$api_token = "9f812bb50e02b31729f3265b12d244f3d0838b5c95f7656ee17fc296de1fcfa1";

// ✅ Check Authorization Header
$headers = getallheaders();
if (!isset($headers['Authorization'])) {
    http_response_code(401);
    echo json_encode(["status" => false, "message" => "Authorization header missing"]);
    exit;
}

// ✅ Extract Bearer Token
$authHeader = $headers['Authorization'];
if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
    http_response_code(401);
    echo json_encode(["status" => false, "message" => "Invalid Authorization format"]);
    exit;
}

$token = $matches[1];

// ✅ Validate token
if ($token !== $api_token) {
    http_response_code(401);
    echo json_encode(["status" => false, "message" => "Invalid or expired token"]);
    exit;
}



$response = ["status" => false, "message" => "", "leads" => []];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM contact_enquiry ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    $leads = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($leads) {
        $response["status"] = true;
        $response["message"] = "Leads fetched successfully.";
        $response["leads"] = $leads;
    } else {
        $response["message"] = "No leads found.";
    }

} catch (PDOException $e) {
    $response["message"] = "Error: " . $e->getMessage();
}

echo json_encode($response);
