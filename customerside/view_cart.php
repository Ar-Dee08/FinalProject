<?php
include 'includes/header.php';
include 'user_middleware.php';
include '../vscode/dbcon.php';



$userinfo_id = $_SESSION['uid'];

    // Fetch item details from the database
    $cartquery = "SELECT * FROM cart c LEFT JOIN items i ON c.item_id = i.item_id LEFT JOIN categories cat ON i.cat_id = cat.cat_id LEFT JOIN user_information ui ON c.userinfo_id = ui.userinfo_id WHERE ui.userinfo_id = ? AND cart_status = 'Active'";
    $stmt = $con->prepare($cartquery);
    $stmt->bind_param("i", $userinfo_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $item = $result->fetch_assoc();
        }
    }
?>
<body class="logo-bg-2">
    <div class="product-container">
        <div class="product-txt">
            <div class="back-cont">
                <div>
                    <h1 style="font-family: 'Inter', sans-serif; font-weight: bold; color: black;">Your Cart</h1>
                    <hr>
                </div>


                <!-- Product Display -->
                <div class="display-cont">
                <div class="cart-cont">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($item = $result->fetch_assoc()) {
                                $item_name = $item['item_name'];
                                $item_spec = $item['item_spec'];
                                $item_desc = $item['item_desc'];
                                $quant = $item['quantity'];
                                $item_price = $item['item_price'];
                                $item_discprice = $item['item_discprice'];
                                $item_img = $item['item_img'];
                                $item_cat = $item['category_name'];
                        ?>
                        <form action="customer_proc.php" method="post" class="form-cart">
                            <input type="hidden" name="item_id" value="<?= $item['item_id']; ?>"> <!-- Pass the item ID -->
                            <div class="item-top-section">
                                <div class="cbox">
                                    <input type="checkbox" id="cboxes<?=$cart_id?>" name="sel" onclick="cboxClick()">
                                </div>
                                <div class="item-detail-image">
                                    <img src="../adminside/record_images/item_images/<?=$item_img?>" alt="<?=$item_name?>" class="item-detail-image">
                                </div>

                                <div class="item-detail-name">
                                    <a href="">
                                    <h1><?=$item_name?></h1>
                                    </a>
                                    <?php
                                    if($item['memstatus_id']==3 ||  $item['memstatus_id']==1 ){ //NON MEMBER
                                                ?>
                                                 <h6>Price: ₱<?=$item_price?></h6>

<?php
                                            } else if($item['memstatus_id']==2) { ?> //NON MEMBER
                                                <h6>Price: ₱<?=$item_discprice?></h6>
                                                
<?php
                                            }
                                        ?>

                                    <br>
                                    <h6><?=$item_spec?></h6>
                                    <div class="quantity-container">
                                        <button type="button" class="quantity-btn" id="minus">-</button>
                                        <input type="number" id="quantity" name="quantity" value="<?=$quant?>" min="1" step="1" class="form-control" required>
                                        <button type="button" class="quantity-btn" id="plus">+</button>
                                    </div>
                                    <div>
                                        <?php
                                        
                                            if($item['memstatus_id']==3 ||  $item['memstatus_id']==1 ){ //NON MEMBER
                                                ?>
                                                 <h6>SSITE Non-Member Price: ₱<?=$item_price?></h6>
<?php
                                            } else if($item['memstatus_id']==2) { ?> //NON MEMBER
                                                <h6>SSITE Member Price: ₱<?=$item_discprice?></h6>                                           
<?php
                                            }
                                        ?>
                                    </div>
                                    <div class="item-description">
                                        <p>Description:</p>
                                        <p><?=$item_desc?></p>
                                    </div>
                                    <button type="submit" class="buy-btn" name="item-order-btn">
                                        Buy Now
                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="bottom-float" id="item-selected" >
            <p>Total (#  of Items) : P00.00</p>
        </div>
                        <?php
                            }//END OF LOOP ?>
                      <?php  } else {
                            echo "<p>Your cart is empty.</p>";
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>        
    </div>

    <script>
    // JavaScript for handling the quantity increment and decrement
    document.getElementById('plus').addEventListener('click', function() {
        let quantityInput = document.getElementById('quantity');
        let value = parseInt(quantityInput.value);
        quantityInput.value = value + 1;
    });

    document.getElementById('minus').addEventListener('click', function() {
        let quantityInput = document.getElementById('quantity');
        let value = parseInt(quantityInput.value);
        if (value > 1) {
            quantityInput.value = value - 1;
        }
    });

    function cboxClick() {
    var checkBox = document.getElementById("cboxes");
    var div = document.getElementById("item-selected");

    if (checkBox.checked == true){
        div.style.visibility = "visible";
    } else {
        div.style.visibility = "hidden";
    }
    }

</script>

<div class="footer-footer">
    <?php
        include 'includes/footer.php';
    ?>
</div>


<style>
    .quantity-container {
    display: flex;
    align-items: center;
    }

    .quantity-btn {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 15px;
    font-size: 18px;
    cursor: pointer;
    border-radius: 5px;
    }

    .quantity-btn:active {
    background-color: #45a049;
    }

    input[type="number"] {
    width: 60px;
    height: 40px;
    text-align: center;
    font-size: 18px;
    margin: 0 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    }

    .cbox input[type='checkbox']{
    align-items: middle;
    width: 30px;
    height: 30px;
}

.cbox {
    align-items: middle;
    margin: auto;
}

.bottom-float {
    background-color: rosybrown;
    width: 100%;
    height: 5em;
    position: fixed;
    bottom: 0;
    z-index: 1000;
    align-items: center;
    text-align: center;
    padding: 2%;
    visibility: hidden;
    left: 0;
}

.item-detail-name {
    color: black;
}

</style>