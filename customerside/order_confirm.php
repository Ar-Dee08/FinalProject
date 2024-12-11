<?php
include 'includes/header.php';
include 'user_middleware.php';
include '../vscode/dbcon.php';

if(isset($_POST['order-proceed-btn'])){     //CREATING CART RECORD
    $cart_id = $_POST['cart_id'];
    $userinfo_id = $_SESSION['uid'];
    $cartQuery = "SELECT * FROM cart c LEFT JOIN items i ON c.item_id = i.item_id LEFT JOIN categories cat ON i.cat_id = cat.cat_id LEFT JOIN user_information ui ON c.userinfo_id = ui.userinfo_id WHERE c.cart_id = ? AND ui.userinfo_id = ? AND c.cart_status = 'Active'";

    $stmt = $con->prepare($cartQuery);
    $stmt->bind_param('ii', $cart_id, $userinfo_id);
    $stmt->execute();
    $result = $stmt->get_result();

?>

<body class="logo-bg-2">
    <div class="product-container">
        <div class="order-txt">
            <div class="back-cont">
                <div style="display: flex width:40%">
                    <h1>Confirm Your Pre-Order</h1>
                    <hr>
                </div>

                <!-- Product Display -->
                <div class="display-cont">
                    <div class="order-cont">
                    <form action="customer_proc.php" method="post">

                    <div class="order-item caption">
                            <div class="order-item-image">
                                <h5>IMAGE</h5>
                            </div>
                                <div class="order-detail-name">
                                    <h5>Item</h5>
                                </div>
                                <div class="order-detail-spec">
                                    <h5>Specification</h5>
                                </div>
                                <div class="order-unit-price">
                                    <h5>Unit Price</h5>
                                </div>
                                <div class="order-unit-quantity">
                                    <h5>Quantity</h5>
                                </div>
                                <div class="order-item-subtotal">
                                    <h5>Subtotal</h5>
                                </div>
                                <hr>
                        </div>
                        <?php
                        if (isset($result) && $result->num_rows > 0) {
                            $isFirst = true; // Track the first unique record
                            while ($item = $result->fetch_assoc()) {
                                $item_name = $item['item_name'];
                                $item_spec = $item['item_spec'];
                                $item_desc = $item['item_desc'];
                                $quant = $item['quantity'];
                                $item_price = $item['item_price'];
                                $item_discprice = $item['item_discprice'];
                                $item_img = $item['item_img'];
                                $item_cat = $item['category_name'];
                                $cart_id = $item['cart_id'];
                                
                                if ($item['memstatus_id'] == 3 || $item['memstatus_id'] == 1) {
                                    $finalprice = $item_price;
                                } else if ($item['memstatus_id'] == 2) {
                                    $finalprice = $item_discprice;
                                }

                                $subtotal = $finalprice * $quant;

                        ?>
                        <div class="order-item">
                            <div class="order-item-image">
                                <img src="../adminside/record_images/item_images/<?= $item_img ?>" 
                                     alt="<?= $item_name ?>" 
                                     class="order-detail-image">
                            </div>
                                <div class="order-detail-name">
                                    <h6><?= $item_name ?></h6>
                                </div>
                                <div class="order-detail-spec">
                                    <h6><?= $item_spec ?></h6>
                                </div>
                                <div class="order-unit-price">
                                    <h6>₱<?= $finalprice ?></h6>
                                </div>
                                <div class="order-unit-quantity">
                                    <h6><?= $quant ?></h6>
                                </div>
                                <div class="order-item-subtotal">
                                    <h6>₱<?= $subtotal ?></h6>
                                </div>

                        </div>
                        <hr>

                        <label style="color: #1E4A50">Payment Method:</label>
                        <input type="hidden" name="cart_id" value="<?= $cart_id; ?>"> 

                        <select id="payment" name="payment" required style="text-align: center;">
                            <option value="GCash">GCash</option>
                            <option value="Paymaya">Paymaya</option>
                            <option value="Onsite Payment"> Onsite Payment</option>
                        </select>


                        <?php
                            }   
                        } else {
                            echo "<p>Your cart is empty.</p>";
                        }
                        ?>
                    </div>
                    <hr>
                    <h6>NOTE: If you chose online, your transaction status will remain pending until payment.</h6>
                    <button type="submit" class="buy-btn" name="complete-order-btn">Confirm</button>
                    <button type="submit" class="buy-btn" name="cancel-order-btn">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</body>
<?php


} else {
    echo "No items selected.";
}


?>