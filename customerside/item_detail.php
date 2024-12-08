<?php
include 'includes/header.php';
include 'user_middleware.php';
include '../vscode/dbcon.php';

if (isset($_GET['item_id'])) {
    $item_id = intval($_GET['item_id']); // Convert to integer for security

    // Fetch item details from the database
    $query = "SELECT * FROM items i LEFT JOIN categories c ON i.cat_id = c.cat_id WHERE item_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $item_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $item = $result->fetch_assoc();
            $item_name = $item['item_name'];
            $item_spec = $item['item_spec'];
            $item_desc = $item['item_desc'];
            $item_type = $item['item_type'];
            $item_price = $item['item_price'];
            $item_discprice = $item['item_discprice'];
            $item_img = $item['item_img'];
            $item_cat = $item['category_name'];
?>

<div class="product-container">

    <div class="product-txt">
        <div class="back-cont">
            <form action="customer_proc.php" method="post">
                <input type="hidden" name="item_id" value="<?= $item_id; ?>"> <!-- Pass the item ID -->

                <div class="item-top-section">
                    <div class="item-detail-image">
                        <img src='../adminside/record_images/item_images/<?=$item['item_img']?>' alt='<?=$item['item_name']?>' class="item-detail-image">
                    </div>
                    <div class="item-detail-name">
                        <h1><?=$item_name?></h1>
                        <h5>Price: ₱<?=$item_discprice?> — ₱<?=$item_price?></h5>
                        <h6>Specification : <?=$item_spec?></h6>
                        
                        <!-- Quantity section with buttons -->
                        <div class="quantity-container">
                            <button type="button" class="quantity-btn" id="minus">-</button>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" step="1" class="form-control" required>
                            <button type="button" class="quantity-btn" id="plus">+</button>
                        </div>
                        
                        <div>
                            <br>
                            <h6>SSITE Member Price : ₱<?=$item_discprice?></h6>
                            <h6>SSITE Non-Member Price : ₱<?=$item_price?></h6>
                            <p>Type: <?=$item_type?></p>
                            </div>
                    </div>
                </div>
                
                <hr>
                <div class="item-mid-section">
                    <div class="item-description">
                        <p>Description : </p>
                        <p><?=$item_desc?></p>
                    </div>
                </div>
                    
                <div class="item-bottom-section">
                    <div class="item-detail-buttons">
                        <button type="submit" name="item-cart-btn">Add to Cart</button>
                        <button type="submit" name="item-order-btn">Order Now</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
        } else {
            echo "<p>Item not found.</p>";
        }
    } else {
        echo "<p>Error fetching item details.</p>";
    }
} else {
    echo "<p>No item selected.</p>";
}
?>

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
</script>

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
</style>