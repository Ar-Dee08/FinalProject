<?php
include '../vscode/dbcon.php';
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['cart_id']) && isset($data['quantity'])) {
    $cartId = intval($data['cart_id']);
    $newQuantity = intval($data['quantity']);

    $query = "UPDATE cart SET quantity = ? WHERE cart_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $newQuantity, $cartId);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update quantity."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid input."]);
}
?>
