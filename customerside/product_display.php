<?php
include 'includes/header.php';
include 'user_middleware.php';
include '../vscode/dbcon.php';

// Check database connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get selected category from URL (default to null if not set)
$selectedCategory = isset($_GET['category']) ? (int)$_GET['category'] : null;

// Query to fetch items, filter by category if selected
$query = "SELECT * FROM items";
if ($selectedCategory) {
    $query .= " WHERE category_id = $selectedCategory"; // Assuming `items` has a `category_id` column
}
$result = $con->query($query);

// Query to fetch all categories
$categoryQuery = "SELECT * FROM categories";
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
                                $itemName = htmlspecialchars($row['item_name']);
                                $itemImage = htmlspecialchars($row['item_img']);
                                $itemPrice = htmlspecialchars($row['item_price']);
                        ?>
                            <li>
                                <a href="#">
                                    <div class="display-item">
                                        <div class="display">
                                            <img src="../adminside/record_images/item_images/<?= $itemImage ?: 'default.jpg'; ?>" 
                                                 alt="<?= $itemName; ?>" class="item-image">
                                        </div>
                                        <div>
                                            <p>
                                                <?= $itemName; ?><br>
                                                ₱<?= $itemPrice; ?>
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
                </div>
            </div>
        </div>
    </div>

    <!-- Styles -->
    <style>
        .product-container {
            padding: 10px;
            background-color: #f9f9f9;
        }

        .product-txt {
            text-align: center;
        }

        .back-cont {
            margin: 20px auto;
            max-width: 1200px;
        }

        .back-cont h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .back-cont form select {
            padding: 10px;
            font-size: 1em;
            margin-bottom: 20px;
        }

        .display-cont {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* Three columns */
            gap: 15px; /* Space between grid items */
            justify-items: start; /* Align items to the start (left) */
            margin: auto;
        }

        .display-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            text-align: center;
            transition: transform 0.2s ease-in-out;
        }

        .display-item:hover {
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }

        .item-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            width: 7em;
            height: 7em;
        }


        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin: 10px;
        }
    </style>

    <!-- Footer -->
    <div class="footer-footer">
        <?php include 'includes/footer.php'; ?>
    </div>
</body>
