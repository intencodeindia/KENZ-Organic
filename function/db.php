<?php
// $host = 'localhost'; // Database host
// $username = 'root';  // Database username
// $password = '';      // Database password
// $dbname = 'wtxoeyoq_organic';
// Create a new PDO instance for database connection

// Database credentials
$host = 'localhost'; // Database host
$username = 'wtxoeyoq_organic';  // Database username
$password = 'PRZBL24jRPvw8geS4Bg4';      // Database password
$dbname = 'wtxoeyoq_organic'; // Database name

try {
	$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	die("Could not connect to the database $dbname :" . $e->getMessage());
}
