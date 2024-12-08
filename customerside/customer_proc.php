<?php
session_start();
include '../vscode/dbcon.php';

// include 'includes/header.php';
if(isset($_POST['item-cart-btn'])){     //CREATING CART RECORD
    $quantity = $_POST['quantity'];
    $item_id = $_POST['item_id'];
    $userinfo_id = $_SESSION['uid'];
    $cart_status = 'Active';
    echo $quantity;

    $cartquery = "SELECT * FROM cart c LEFT JOIN items i ON c.item_id = i.item_id LEFT JOIN categories cat ON i.cat_id = cat.cat_id LEFT JOIN user_information ui ON c.userinfo_id = ui.userinfo_id WHERE ui.userinfo_id = ? AND i.item_id = ?";
    $stmt = $con->prepare($cartquery);
    echo $userinfo_id;
    echo $item_id;
    $stmt->bind_param("ii", $userinfo_id, $item_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo 'SHOUDL UPDATE';
            $item = $result->fetch_assoc();
            $oldquant = $item['quantity'];
            $oldcart_id = $item['cart_id'];
            echo $oldquant;
            $quantity += $oldquant;
            echo $quantity;
            echo $oldcart_id;

            // ERROR WITH SQL SYNTAX AND LOGIC

            $query = "UPDATE cart SET quantity = ? WHERE cart_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("ii", $quantity, $oldcart_id );
            $stmt->execute();
            header("Location: view_cart.php");
            exit();
        
    } else {
        echo 'SHOUDL INSERT';

        $cart_id = TableRowCount("cart",$con)+1;
          $query = "INSERT INTO cart(cart_id, item_id, quantity, cart_status, userinfo_id) 
          VALUES(?,?,?,?,?)";
          $stmt = $con->prepare($query);
          $stmt->bind_param("iiisi", $cart_id, $item_id,$quantity,$cart_status,$userinfo_id);
          if ($stmt->execute()) {
            header("Location: view_cart.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    }

    header("Location: view_cart.php");
    exit();

} else if(isset($_POST['item-order-btn'])) {
    $item_id = $_POST['item_id'];

    header("Location: ordeR_confirm.php?item_id=$item_id");
    exit();



}





function TableRowCount(string $table, $con)
{
    $query = "SELECT COUNT(*) AS total FROM " . $table;
    $count = 0;

    if ($results = mysqli_query($con, $query)) {
        $row = mysqli_fetch_assoc($results);
        $count = $row['total'];
    }

    return $count;
}





?>