<?php
// Start session and include necessary files
// session_start();
require_once 'includes/header.php';
require_once 'user_middleware.php';
require_once '../vscode/dbcon.php';

// Redirect if the user is not logged in
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

// Fetch user ID from session
$user_id = $_SESSION['uid'];

// Initialize variables
$update_success = false;
$error_message = "";

// Handle form submission for updating user details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $sex = htmlspecialchars(trim($_POST['sex']));
    $bday = htmlspecialchars(trim($_POST['bday']));
    $student_number = htmlspecialchars(trim($_POST['student_number']));
    $email = htmlspecialchars(trim($_POST['email']));
    $contact_number = htmlspecialchars(trim($_POST['contact_number']));
    $type = htmlspecialchars(trim($_POST['type']));

    // Prepare the update query
    try {
        $query = "UPDATE user_information SET firstname = ?, lastname = ?, sex = ?, bday = ?, student_number = ?, email = ?, contact_number = ?, customertype_id = ? WHERE userinfo_id = ?";
        $stmt = $con->prepare($query);
        
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $con->error);
        }

        // Bind parameters
        $stmt->bind_param("sssssssii", $firstname, $lastname, $sex, $bday, $student_number, $email, $contact_number, $type, $user_id);
        
        // Execute query
        if ($stmt->execute()) {
            $update_success = true;
        } else {
            throw new Exception("Error executing query: " . $stmt->error);
        }
    } catch (Exception $e) {
        $error_message = "An error occurred: " . htmlspecialchars($e->getMessage());
    }
}

// Fetch user details
try {
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
    $error_message = "An error occurred: " . htmlspecialchars($e->getMessage());
}
?>

<body class="logo-bg-2">
<div class="admin-container">
    <h1 style="font-family: 'Inter', sans-serif; font-weight: bold; color: black;">My Profile</h1>
    <h3>Manage and protect your account.</h3>

    <?php if ($update_success): ?>
        <p class="success-message">Your profile has been updated successfully.</p>
    <?php elseif ($error_message): ?>
        <p class="error-message"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>

        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>

        <label for="sex">Sex:</label>
        <select id="sex" name="sex" required>
            <option value="Male" <?php echo ($user['sex'] == 'Male') ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo ($user['sex'] == 'Female') ? 'selected' : ''; ?>>Female</option>
            <option value="Other" <?php echo ($user['sex'] == 'Other') ? 'selected' : ''; ?>>Other</option>
        </select>

        <label for="bday">Birthday:</label>
        <input type="date" id="bday" name="bday" value="<?php echo htmlspecialchars($user['bday']); ?>" required>

        <label for="student_number">Student Number:</label>
        <input type="text" id="student_number" name="student_number" value="<?php echo htmlspecialchars($user['student_number']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label for="contact_number">Mobile Number:</label>
        <input type="text" id="contact_number" name="contact_number" value="<?php echo htmlspecialchars($user['contact_number']); ?>" required>

        <label for="type">Type:</label>
        <select id="type" name="type" required>
            <option value="1" >Student</option>
            <option value="2" >Non-Student</option>

        </select>
        <br>
        <div>
            <strong><a href="view_profile.php" class="button-back" style="background-color: #458D9E; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-right: 10px;">Back</a></strong>
            <button type="submit" class="button-update" style="background-color: #458D9E; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Update Profile</button>
        </div>
    </form>
</div>

<div class="footer-footer">
    <?php include 'includes/footer.php'; ?>
</div>
