<?php
require 'db.php'; // Include your DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit_industry_profile'])) {
        try {
            // Sanitize inputs
            $first_name = htmlspecialchars(trim($_POST['FirstName'] ?? ''));
            $last_name = htmlspecialchars(trim($_POST['LastName'] ?? ''));
            $email = filter_var(trim($_POST['Email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $country_code = htmlspecialchars(trim($_POST['CountryCode'] ?? ''));
            $mobile_number = htmlspecialchars(trim($_POST['MobileNumber'] ?? ''));
            $terms_conditions = isset($_POST['termsCondition']) ? 1 : 0;
            $privacy_policy = isset($_POST['privacyPolicy']) ? 1 : 0;

            // Validate email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Invalid email address.");
            }

            // Insert into database
            $sql = "INSERT INTO company_profile (first_name, last_name, email, country_code, mobile_number, terms_conditions, privacy_policy)
                    VALUES (:first_name, :last_name, :email, :country_code, :mobile_number, :terms_conditions, :privacy_policy)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':first_name' => $first_name,
                ':last_name' => $last_name,
                ':email' => $email,
                ':country_code' => $country_code,
                ':mobile_number' => $mobile_number,
                ':terms_conditions' => $terms_conditions,
                ':privacy_policy' => $privacy_policy
            ]);

            // Redirect with a loading popup
            echo "<html><body>";
            echo "<div id='loading' style='position: fixed; top: 0; left: 0; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; background: rgba(0,0,0,0.7); color: white; font-size: 24px;'>Profile is loading...</div>";
            echo "<script>
                setTimeout(function() {
    window.open('../KOF_202409_V01.pdf', '_blank'); // Opens the PDF in a new tab
}, 3000); // Redirect after 3 seconds

            </script>";
            echo "</body></html>";
            exit;

        } catch (Exception $e) {
            // In a real-world application, you should log the error for debugging purposes and show a user-friendly message
            echo "There was an error submitting your details. Please try again later.";
        }
    }
}
?>
