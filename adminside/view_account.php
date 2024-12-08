<?php
// session_start();
require_once 'includes/header.php';
require_once 'admin_middleware.php';
require_once '../vscode/dbcon.php';

// Redirect if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user ID from session
$user_id = $_SESSION['user_id'];

try {
    // Prepare and execute query to fetch user details
    $query = "SELECT firstname, lastname, sex, bday, student_number, email, contact_number, type FROM users WHERE id = ?";
    $stmt = $con->prepare($query);
    
    if (!$stmt) {
        throw new Exception("Error preparing statement: " . $con->error);
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        throw new Exception("User not found.");
    }
} catch (Exception $e) {
    // Handle exceptions gracefully
    echo "An error occurred: " . htmlspecialchars($e->getMessage());
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="logo-bg-2">
<div class="admin-container">
    <h1>My Profile</h1>
    <h3>Manage and protect your account.</h3>
    <p>First Name: <?php echo htmlspecialchars($user['firstname']); ?></p>
    <p>Last Name: <?php echo htmlspecialchars($user['lastname']); ?></p>
    <p>Sex: <?php echo htmlspecialchars($user['sex']); ?></p>
    <p>Birthday: <?php echo htmlspecialchars($user['bday']); ?></p>
    <p>Student Number: <?php echo htmlspecialchars($user['student_number']); ?></p>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    <p>Mobile Number: <?php echo htmlspecialchars($user['contact_number']); ?></p>
    <p>Type: <?php echo htmlspecialchars($user['type']); ?></p>

    <!-- Edit Button -->
    <a href="edit_account.php" class="edit-button">Edit Profile</a>
</div>

<div class="footer-footer">
    <?php include 'includes/footer.php'; ?>
</div>
</body>
</html>

<style>
.edit-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 20px;
    font-weight: bold;
}

.edit-button:hover {
    background-color: #45a049;
}
</style>