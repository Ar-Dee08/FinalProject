<?php
// session_start();
include 'includes/header.php';
include 'admin_middleware.php';
require "../vscode/dbcon.php";

// Redirect if the user is not logged in
if (!isset($_SESSION['uid'])) {
    header("Location: index.php");
    exit();
}

// Fetch user ID from session
$user_id = $_SESSION['uid'];

try {
    // Prepare and execute query to fetch user details
    $query = "SELECT ui.firstname, ui.lastname, ui.sex, ui.bday, ui.student_number, ui.email, ui.contact_number, t.customer_type, t.customertype_id FROM user_information ui LEFT JOIN customertype t ON ui.customertype_id = t.customertype_id WHERE ui.userinfo_id = ?";
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

<body class="logo-bg-2">
<div class="admin-container">
    <h1>My Profile</h1>
    <h3>Manage and protect your account.</h3>
    <p>First Name: <?php echo htmlspecialchars($user['firstname']); ?></p>
    <p>Last Name: <?php echo htmlspecialchars($user['lastname']); ?></p>
    <p>Sex: <?php echo htmlspecialchars($user['sex']); ?></p>
    <p>Birthday: <?php echo htmlspecialchars($user['bday']); ?></p>
<?php
    if($user['customertype_id'] == 1){  ?>
        <p>Student Number: <?php echo htmlspecialchars($user['student_number']); ?></p>
<?php    }
?>

    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    <p>Mobile Number: <?php echo htmlspecialchars($user['contact_number']); ?></p>
    <p>Type: <?php echo htmlspecialchars($user['customer_type']); ?></p>

    <!-- Edit Button -->
    <a href="edit_account.php" class="edit-button">Edit Profile</a>
</div>

<div class="footer-footer">
    <?php include 'includes/footer.php'; ?>
</div>
</body>
</html>
