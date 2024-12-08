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
                            $counter = 0;                             
                            while ($item = $result->fetch_assoc()) {
                                $counter++;
                                $item_name = $item['item_name'];
                                $item_spec = $item['item_spec'];
                                $item_desc = $item['item_desc'];
                                $item_type = $item['item_type'];
                                $quant = $item['quantity'];
                                $item_price = $item['item_price'];
                                $item_discprice = $item['item_discprice'];
                                $item_img = $item['item_img'];
                                $item_cat = $item['category_name'];
                                $cart_id = $item['cart_id'];

                                if($item['memstatus_id']==3 ||  $item['memstatus_id']==1 ){
                                    $finalprice = $item_price;
                                } else if($item['memstatus_id']==2) {
                                    $finalprice = $item_discprice;
                                }
                        ?>
                        <form action="customer_proc.php" method="post" class="form-cart">
                            <input type="hidden" name="item_id" value="<?= $item['item_id']; ?>"> <!-- Pass the item ID -->
                            <div class="item-top-section">
                                <div class="cbox">
                                    <input type="checkbox" value="<?=$cart_id?>" id="cboxes<?=$cart_id?>" name="sel" data-price="<?=$finalprice?>" data-quantity="<?=$quant?>" data-counter="<?=$counter?>" onclick="cboxClick(<?=$cart_id?>)">
                                </div>
                                <div class="item-detail-image">
                                    <img src="../adminside/record_images/item_images/<?=$item_img?>" alt="<?=$item_name?>" class="item-detail-image">
                                </div>

                                <div class="item-detail-name">
                                    
                                    <a href="item_detail.php?item_id=<?=$item['item_id']?>">
                                        <h1><?=$item_name?></h1>
                                    </a>
                                        <h6>Price: ₱<?=$finalprice?></h6>

                                    <br>
                                    <h6>Specification : <?=$item_spec?></h6>
                                    <div class="quantity-container">
                                        <button type="button" class="quantity-btn" id="minus-<?php echo $counter; ?>"  data-cart_id="<?php echo $item['cart_id']; ?>">-</button>
                                        <input type="number" id="quantity-<?php echo $counter; ?>" name="quantity" value="<?php echo $quant; ?>" min="1" step="1" class="form-control" required>
                                        <button type="button" class="quantity-btn" id="plus-<?php echo $counter; ?>" data-cart_id="<?php echo $item['cart_id']; ?>">+</button>
                                    </div>
                                    <div>
                                        <br>

                                        <?php
                                            if($item['memstatus_id']==3 ||  $item['memstatus_id']==1 ){ //NON MEMBER
                                                ?>
                                                <h6>SSITE Non-Member Price: ₱<?=$item_price?></h6>
                                                <p>Type: <?=$item_type?></p>
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
                                    
                                </div>
                            </div>
                        </form>
                        <hr>
                              <div class="bottom-float" id="item-selected" style="color: white;">
                                <div class="bottom-float-items">
                              <h5 style="color: white;"><b>Total (# of Items) : P00.00</b></>
                              <h5>Total (# of Items): P00.00</h5>
                                </div>
                                <div class="bottom-float-button">
                                    <button type="submit" id="order-proceed-btn" class="buy-btn" name="item-order-btn">
                                        Buy Now
                                    </button>
                                </div>
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
 document.addEventListener('DOMContentLoaded', function () {
    // Select all "plus" and "minus" buttons
    const plusButtons = document.querySelectorAll("button[id^='plus-']");
    const minusButtons = document.querySelectorAll("button[id^='minus-']");
    const checkboxes = document.querySelectorAll('input[type="checkbox"][name="sel"]');
    const totalDiv = document.getElementById("item-selected");

    // Function to update quantity in the database
    function updateQuantity(cartId, newQuantity) {
        fetch('update_cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ cart_id: cartId, quantity: newQuantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Quantity updated successfully!");
            } else {
                console.error("Failed to update quantity: ", data.message);
            }
        })
        .catch(error => console.error("Error:", error));
    }

    // Function to update the total items and price
    function updateTotal() {
        let totalItems = 0;
        let totalPrice = 0;
        const proceedButton = document.getElementById("order-proceed-btn");

        checkboxes.forEach((checkbox) => {
        if (checkbox.checked) {
            const price = parseFloat(checkbox.dataset.price);
            const quantity = parseInt(document.getElementById(`quantity-${checkbox.dataset.counter}`).value);
            totalPrice += price * quantity;
            totalItems++;
        }
    });

    if (totalItems > 0) {
        totalDiv.style.visibility = "visible";
        proceedButton.style.visibility = "visible"; // Show the button
        totalDiv.innerHTML = `<p>Total (${totalItems} item/s): Total Price: ₱${totalPrice.toFixed(2)}</p>`;
    } else {
        totalDiv.style.visibility = "hidden";
        proceedButton.style.visibility = "hidden"; // Hide the button
    }
}

    // Add event listeners to "plus" buttons
    plusButtons.forEach(button => {
        button.addEventListener('click', function () {
            const counter = this.id.split('-')[1];
            const quantityInput = document.getElementById(`quantity-${counter}`);
            const cartId = this.dataset.cart_id;
            let value = parseInt(quantityInput.value);
            value++;
            quantityInput.value = value;
            updateQuantity(cartId, value);
            updateTotal(); // Update total on quantity change
        });
    });

    // Add event listeners to "minus" buttons
    minusButtons.forEach(button => {
        button.addEventListener('click', function () {
            const counter = this.id.split('-')[1];
            const quantityInput = document.getElementById(`quantity-${counter}`);
            const cartId = this.dataset.cart_id;
            let value = parseInt(quantityInput.value);
            if (value > 1) {
                value--;
                quantityInput.value = value;
                updateQuantity(cartId, value);
                updateTotal(); // Update total on quantity change
            }
        });
    });

    // Add event listeners to checkboxes
    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', function () {
            const counter = this.dataset.counter;  // Get the counter for the current checkbox
            const plusButton = document.getElementById(`plus-${counter}`);
            const minusButton = document.getElementById(`minus-${counter}`);
            const quantityInput = document.getElementById(`quantity-${counter}`);

            if (!this.checked) {
                plusButton.disabled = false;  // Enable the buttons
                minusButton.disabled = false;
                quantityInput.disabled = false;  // Enable the input
            } else {
                plusButton.disabled = true;  // Disable the buttons
                minusButton.disabled = true;
                quantityInput.disabled = true;  // Disable the input
            }

            updateTotal();  // Update total when checkbox is changed
        });
    });

    // Initialize state on page load
    updateTotal();
});


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

    .quantity-container input[type="number"]:disabled {
        color: #285963;
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
    background-color: #a9cad0;
    color: white !important;
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
    display: flex; /* Enable flexbox */
    justify-content: space-between;
}

.bottom-float-items p {
    flex: 1; /* Allow this div to take available space */
    width: 50%;
    padding-left: 15em;
    align-items: right;
}

.bottom-float-button {
    /* flex: 0; Make this div take only the space needed for its content */
    bottom: 0;
    width: 50%;
    padding: 5em 15em;
}

#order-proceed-btn {
    z-index: 1000;
}

.item-detail-name {
    color: black;
}

</style>
