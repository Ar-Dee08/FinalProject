<?php
// Include database connection
include '../vscode/dbcon.php';

// Set content type to JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Parse JSON input
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate input
    if (isset($data['cart_id']) && isset($data['quantity'])) {
        $cart_id = $data['cart_id'];
        $quantity = $data['quantity'];

        // Prevent invalid or negative quantities
        if ($quantity < 1) {
            echo json_encode(['success' => false, 'message' => 'Invalid quantity']);
            exit;
        }

        // Update query
        $query = "UPDATE cart SET quantity = ? WHERE cart_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('ii', $quantity, $cart_id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Cart updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update cart']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

$con->close();
?>
