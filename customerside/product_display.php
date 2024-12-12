<?php
include 'includes/header.php';
include 'user_middleware.php';
include '../vscode/dbcon.php';

// Check database connection

// Get selected category from URL (default to null if not set)
$selectedCategory = isset($_GET['category']) ? (int)$_GET['category'] : null;

// Query to fetch items, filter by category if selected
$query = "SELECT * FROM items WHERE record_status = 'Active'";
if ($selectedCategory) {
    $query = "SELECT * FROM items WHERE cat_id = $selectedCategory AND record_status = 'Active'"; // Assuming `items` has a `category_id` column
}
$result = $con->query($query);

// Query to fetch all categories
$categoryQuery = "SELECT * FROM categories WHERE record_status = 'Active'";
$categoryResult = $con->query($categoryQuery);
?>

<body class="logo-bg-2">
    <div class="product-container">
        <div class="product-txt">
            <div class="back-cont">
                <div>
                    <h1>Products</h1>
                    <hr>
                </div>

                <!-- Category Filter Form -->
                <form method="GET" action="product_display.php" style="text-align: right; margin-bottom: 20px;">
                    <select name="category" id="category" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        <?php
                        if ($categoryResult && $categoryResult->num_rows > 0) {
                            while ($categoryRow = $categoryResult->fetch_assoc()) {
                                $categoryId = htmlspecialchars($categoryRow['cat_id']);
                                $categoryName = htmlspecialchars($categoryRow['category_name']);
                                $isSelected = $selectedCategory === (int)$categoryId ? "selected" : "";
                                echo "<option value='$categoryId' $isSelected>$categoryName</option>";
                            }
                        }
                        ?>
                    </select>
                </form>

                <!-- Product Display -->
                <div class="display-cont">
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
                                            <img src="../adminside/record_images/item_images/<?= $itemImage ?: 'default.jpg'; ?>" 
                                                 alt="<?= $itemName; ?>" class="item-image">
                                        </div>
                                        <div>
                                            <p>
                                                <?= $itemName; ?><br>
                                                ₱<?= $itemDisplayPrice; ?>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php 
                            } 
                        } else { 
                        ?>
                            <li>No items yet in this category.</li>
                        <?php 
                        } 
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    

</style>    




<div class="footer-footer">
    <?php
        include 'includes/footer.php';
    ?>
</div>