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
    $query = "SELECT ui.firstname, ui.lastname, ui.sex, ui.bday, ui.student_number, ui.email, ui.contact_number, t.customer_type, ui.customertype_id FROM user_information ui LEFT JOIN customertype t ON ui.customertype_id = t.customertype_id WHERE ui.userinfo_id = ?";
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
    <h1 style="font-family: 'Inter', sans-serif; font-size: 40px; font-weight: bold;">
    My Profile
    </h1>
    <h3>Manage and protect your account.</h3>
    <div class="profile-details">
        <p><strong>First Name:</strong> <?php echo htmlspecialchars($user['firstname']); ?></p>
        <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user['lastname']); ?></p>
        <p><strong>Sex:</strong> <?php echo htmlspecialchars($user['sex']); ?></p>
        <p><strong>Birthday:</strong> <?php echo htmlspecialchars($user['bday']); ?></p>
        <?php if($user['customertype_id'] == 1){ ?>
            <p><strong>Student Number:</strong> <?php echo htmlspecialchars($user['student_number']); ?></p>
        <?php } ?>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Mobile Number:</strong> <?php echo htmlspecialchars($user['contact_number']); ?></p>
        <p><strong>Type:</strong> <?php echo htmlspecialchars($user['customer_type']); ?></p>
    </div>
    <!-- Edit Button -->
    <button onclick="location.href='edit_account.php'" class="edit-button" style="background-color: #458D9E; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Edit Profile</button>
    </div>
</div>

<div class="footer-footer">
    <?php include 'includes/footer.php'; ?>
</div>
</body>
</html>
