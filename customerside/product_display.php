<?php
// session_start();
include 'includes/header.php';
include 'user_middleware.php';
include '../vscode/dbcon.php';
?>

<body class="logo-bg-2">
    <div class="product-container">
        <div class="home-txt">

            <div>
                div container
                <div>
                    Header
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
                                $itemPrice = htmlspecialchars($row['item_price']); // Sanitize and ensure the path is valid
                        ?>
                            <li>
                                <a href="#">
                                    <div class="display-item">
                                        <div class="display">
                                            <img  src="../adminside/record_images/item_images/<?=$itemImage;?>" alt="<?php echo $itemName; ?>" class="item-image">

                                        </div>
                                        <div>
                                            <?php echo $itemName . '<br>';
                                             
                                            echo '₱'.  $itemPrice; ?>
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
<style>
    .display-cont li {
        display: inline-block;
    }

    .display-item{
        display: inline-block;
        background-color: red;
        border-radius: 5px;
        padding: 15px;
    }

    .item-image {
        width: 7em;
        height: 7em;
        max-width: 7em;
        max-height: 7em;
    }


</style>    




<div class="footer-footer">
    <?php
        include 'includes/footer.php';
    ?>
</div>