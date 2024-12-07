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
            $item_spec = $item['item_spec'];
            $item_type = $item['item_type'];
            $item_price = $item['item_price'];
            $item_discprice = $item['item_discprice'];
            $item_img = $item['item_img'];
            $item_cat = $item['category_name'];

?>

<div class="product-container">

    <div class="product-txt">
            product-container [eto mismong container na white]
        <div class="back-cont">
            back-cont [idk]
            <div class="item-header">
                <h1>
                    Header
                </h1>
            </div>
            <div class="item-top-section">
                    
                <div class="item-detail-image">
                    <img src='../adminside/record_images/item_images/<?=$item['item_img']?>' alt='<?=$item['item_name']?>' class="item-detail-image">
                </div>
                <div>
                    <h1><?=$item['item_name'] ?></h1>
                    <p>Price: ₱<?=$item['item_price']?></p>
                </div>

            </div>
            <div>
                <p>Description : <?=$item_desc?></p>

            </div>

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
            
