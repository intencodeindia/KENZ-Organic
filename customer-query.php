<?php
session_start();

// Define a password for access
$valid_password = "12345"; // Change this to a secure password

// Check if the password is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entered_password = $_POST['password'] ?? '';

    // Validate password
    if ($entered_password === $valid_password) {
        $_SESSION['can_access'] = true;
    } else {
        $error_message = "Invalid password. Please try again.";
    }
}

// Check session access
if (!isset($_SESSION['can_access']) || !$_SESSION['can_access']) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Password Protected</title>
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <div class="container text-center mt-5">
        <h2>Enter Password to View Content</h2>
        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error_message); ?></div>
        <?php } ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control w-25 mx-auto" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </body>
    </html>
    <?php
    exit;
}

// Database credentials
$host = 'localhost';
$username = 'wtxoeyoq_organic';
$password = 'PRZBL24jRPvw8geS4Bg4';
$dbname = 'wtxoeyoq_organic';

// Create a new PDO instance for database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

// Query to fetch data from the database
$sql = "SELECT * FROM contact_enquiry ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sno = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Enquiry Data</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <!-- jQuery (required by DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-fluid my-5 px-5">
        <h1 class="mb-4 text-center">Contact Enquiry Data</h1>
        <?php if (!empty($data)) { ?>
            <div class="table-responsive">
                <table id="enquiryTable" class="table table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Job Title</th>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Terms & Conditions</th>
                            <th>Privacy Policy</th>
                            <th>Message</th>
                            <th>Submission Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $row) { ?>
                            <tr>
                                <td><?= $sno++; ?></td>
                                <td><?= htmlspecialchars($row['first_name']); ?></td>
                                <td><?= htmlspecialchars($row['last_name']); ?></td>
                                <td><?= htmlspecialchars($row['job_title']); ?></td>
                                <td><?= htmlspecialchars($row['company_name']); ?></td>
                                <td><?= htmlspecialchars($row['email']); ?></td>
                                <td>+<?= htmlspecialchars($row['country_code']); ?> <?= htmlspecialchars($row['mobile_number']); ?></td>
                                <td><?= $row['terms_conditions'] ? 'Accepted' : 'Not Accepted'; ?></td>
                                <td><?= $row['privacy_policy'] ? 'Accepted' : 'Not Accepted'; ?></td>
                                <td><?= htmlspecialchars($row['message']); ?></td>
                                <td>
                                    <?= !empty($row['created_at']) ? date('F j, Y', strtotime($row['created_at'])) : 'N/A'; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="alert alert-warning text-center">No data available.</div>
        <?php } ?>
    </div>

    <!-- DataTable Initialization -->
    <script>
        $(document).ready(function() {
            $('#enquiryTable').DataTable();
        });
    </script>
</body>
</html>
