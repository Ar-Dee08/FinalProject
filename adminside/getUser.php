<?php
include('../vscode/dbcon.php');

// Get the ID from the request
$userId = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($userId)) {
    echo json_encode(['success' => false, 'error' => 'No ID provided']);
    exit();
}

// Query the database
$query = $con->prepare("SELECT CONCAT(firstname, ' ', lastname) AS fullname FROM user_information WHERE userinfo_id = ?");
$query->bind_param("s", $userId);
$query->execute();
$result = $query->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode(['success' => true, 'full_name' => $row['fullname']]);
} else {
    echo json_encode(['success' => false, 'error' => 'User not found']);
}

$query->close();
$con->close();
