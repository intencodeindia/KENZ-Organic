<?php
// Database credentials
$host = 'localhost'; // Database host
$username = 'wtxoeyoq_organic';  // Database username
$password = 'PRZBL24jRPvw8geS4Bg4';      // Database password
$dbname = 'wtxoeyoq_organic'; // Database name

// Create a new PDO instance for database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate the input
    $first_name = htmlspecialchars(trim($_POST['FirstName']));
    $last_name = htmlspecialchars(trim($_POST['LastName']));
    $job_title = htmlspecialchars(trim($_POST['YourJob']));
    $company_name = htmlspecialchars(trim($_POST['YourCompany']));
    $email = filter_var(trim($_POST['Email']), FILTER_SANITIZE_EMAIL);
    $message = filter_var(trim($_POST['message']));
    $country_code = htmlspecialchars(trim($_POST['CountryCode']));
    $mobile_number = htmlspecialchars(trim($_POST['MobileNumber']));
    $terms_conditions = isset($_POST['termsCondition']) ? 1 : 0;
    $privacy_policy = isset($_POST['privacyPolicy']) ? 1 : 0;

    // Validate the data
    if (empty($first_name) || empty($job_title) || empty($company_name) || empty($email) || empty($country_code) || empty($mobile_number)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare SQL query to insert data into the database
    $sql = "INSERT INTO contact_enquiry (first_name, last_name, job_title, company_name, email, country_code, mobile_number, terms_conditions, privacy_policy, message)
            VALUES (:first_name, :last_name, :job_title, :company_name, :email, :country_code, :mobile_number,  :terms_conditions, :privacy_policy, :message)";
    
    // Prepare statement
    $stmt = $pdo->prepare($sql);
    
    // Bind the parameters to the query
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':job_title', $job_title);
    $stmt->bindParam(':company_name', $company_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':country_code', $country_code);
    $stmt->bindParam(':mobile_number', $mobile_number);
    $stmt->bindParam(':terms_conditions', $terms_conditions);
    $stmt->bindParam(':privacy_policy', $privacy_policy);
    $stmt->bindParam(':message', $message);

    // Execute the query
    if ($stmt->execute()) {
        echo "Details submitted successfully.";
    } else {
        echo "There was an error submitting your details.";
    }
}
?>
