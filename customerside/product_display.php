<?php
// session_start();
include 'includes/header.php';
include 'user_middleware.php';
include '../vscode/dbcon.php';
?>

<body class="logo-bg-2">
    <div class="product-container">
        <div class="product-txt">
            product-container [eto mismong container na white]
            <div class="back-cont">
                back-cont [idk]
                <div>
                    <h1>
                        Header
                    </h1>
                </div>
                <?php
                $query = "SELECT * FROM items"; // Adjust the column names if needed
                $result = $con->query($query); // Execute the query
                ?>

                <div class="display-cont">
                    cont body
                    <ul>
                        <?php 
                        if ($result && $result->num_rows > 0) { 
                            while ($row = $result->fetch_assoc()) { 
                                $itemName = htmlspecialchars($row['item_name']); // Sanitize for HTML output
                                $itemImage = htmlspecialchars($row['item_img']); // Sanitize and ensure the path is valid
                                $itemDisplayPrice = htmlspecialchars($row['item_price']); // Sanitize and ensure the path is valid
                                $item_id = htmlspecialchars($row['item_id']);
                        ?>
                            <li>
                                <!-- LINK TO ITEMS -->
                                <a href="item_detail.php?item_id=<?= urlencode($row['item_id']); ?>"> 
                                    <div class="display-item">
                                        <div class="display">
                                            <img  src="../adminside/record_images/item_images/<?=$itemImage;?>" alt="<?php echo $itemName; ?>" class="item-image">

                                        </div>
                                        <br>
                                        <div>
                                            <p>
                                            <?php echo $itemName . '<br>';
                                            echo '₱'.  $itemDisplayPrice; ?>

                                            </p>
                                             
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php 
                            } 
                        } else { 
                        ?>
                            <li>No items found in the database.</li>
                        <?php 
                        } 
                        ?>
                    </ul>

                    end of cont body
                </div>
                    
            </div>

        <div>
    </div>
</div>
 


<div class="footer-footer">
    <?php
        include 'includes/footer.php';
    ?>
</div>