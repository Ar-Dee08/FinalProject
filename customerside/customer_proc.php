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

    $cartquery = "SELECT * FROM cart c LEFT JOIN items i ON c.item_id = i.item_id LEFT JOIN categories cat ON i.cat_id = cat.cat_id LEFT JOIN user_information ui ON c.userinfo_id = ui.userinfo_id WHERE ui.userinfo_id = ? AND i.item_id = ? AND c.cart_status = 'Active'";
    $stmt = $con->prepare($cartquery);
    echo $userinfo_id;
    echo $item_id;
    $stmt->bind_param("ii", $userinfo_id, $item_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $item = $result->fetch_assoc();
        
        if ($result->num_rows > 0) {
            echo 'SHOUDL UPDATE';

                echo 'SHOUDL ACTUALLY UPDATE';
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
            
            } else if ($result->num_rows == 0) {
                echo 'SHOUDL INSERT' . $cart_id . $item_id . $item['cart_status'];

                $cart_id = TableRowCount("cart",$con)+1;
                $query = "INSERT INTO cart(cart_id, item_id, quantity, cart_status, userinfo_id) 
                VALUES(?,?,?,'Active',?)";
                $stmt = $con->prepare($query);
                $stmt->bind_param("iiii", $cart_id, $item_id,$quantity,$userinfo_id);
                if ($stmt->execute()) {
                    header("Location: view_cart.php");
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }
            

            }
        }
    echo "Error: " . $stmt->error;

    // header("Location: view_cart.php");
    // exit();

} else if(isset($_POST['item-order-btn'])) {
    $item_id = $_POST['item_id'];

    header("Location: order_confirm.php?item_id=$item_id");
    exit();

} else

if(isset($_POST['cancel-order-btn'])){     //CREATING CART RECORD
    header("Location: view_cart.php");


} else if (isset($_POST['complete-order-btn'])){ 
    $cart_id =$_POST['cart_id'];

    $cartQuery = "SELECT * FROM cart c LEFT JOIN items i ON c.item_id = i.item_id LEFT JOIN categories cat ON i.cat_id = cat.cat_id LEFT JOIN user_information ui ON c.userinfo_id = ui.userinfo_id LEFT JOIN customertype ct ON ui.customertype_id = ct.customertype_id WHERE c.cart_id = ? AND c.cart_status = 'Active'";

    $stmt = $con->prepare($cartQuery);
    $stmt->bind_param('i', $cart_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
    $quantity = $item['quantity'];

    if($item['memstatus_id'] == 2){
        $item_price = $item['item_discprice'];
    } else {
        $item_price = $item['item_price'];
    }

    $totalamount = $item_price * $quantity;
    $payment = $_POST['payment'];
    $transaction_status = 1;
    $userinfo_id = $item['userinfo_id'];
    $item_id = $item['item_id'];


    $tr_id = TableRowCount("transactions",$con)+1;

    $query = "INSERT INTO transactions(transaction_id, totalamount, payment_method, order_date, transaction_status_id, userinfo_id, item_id, quantity) 
    VALUES(?,?,?,NOW(),?,?,?,?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("idsiiii", $transaction_id, $totalamount, $payment, $transaction_status, $userinfo_id, $item_id, $quantity);
    // echo $transaction_id . $totalamount . $payment . $transaction_status . $userinfo_id . $item_id . $quantity ;
    if ($stmt->execute()) {
        
        $CompleteQuery = "UPDATE cart SET cart_status = 'Complete' WHERE cart_id = ?";
        $stmt = $con->prepare($CompleteQuery);
        $stmt->bind_param("i", $cart_id);

        if ($stmt->execute()) {
            header("Location: homecustomer.php?end=Transaction is now Pending.<br>Wait for your email.");
            exit();
        } else {
            // Failure: Redirect back with an error message
            header("Location: view_cart.php?status=error");
        }   
  } else {
      echo "Error: " . $stmt->error;
  }
} else if (isset($_GET['cart_id'])){
    $cart_id = $_GET['cart_id'];

    // Prepare the SQL DELETE statement
    $deleteQuery = "UPDATE cart SET cart_status = 'Removed' WHERE cart_id = ?";
    $stmt = $con->prepare($deleteQuery);
    $stmt->bind_param("i", $cart_id);

    if ($stmt->execute()) {
        // Success: Redirect back to the cart page with a success message
        header("Location: view_cart.php?status=Successfully deleted");
    } else {
        // Failure: Redirect back with an error message
        header("Location: view_cart.php?status=error");
    }
    $stmt->close();


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