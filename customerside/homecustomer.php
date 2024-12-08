<?php
// session_start();
include 'includes/header.php';
include 'user_middleware.php';
include '../vscode/dbcon.php';

// echo $_SESSION['uid'];
?>
    <div class="home-txt">
    <?php
        if (isset($_SESSION['customertype_id'])) {

            $getnamequery = "SELECT * FROM customertype a LEFT JOIN user_information ui ON a.userinfo_id = ui.userinfo_id WHERE customertype_id = ?";
            $stmt = $con->prepare($getnamequery);
            $stmt->bind_param("i",$_SESSION['customertype_id']);

            if ($stmt->execute()) {
                $results = $stmt->get_result(); // Always return the result object        
                $ui_row = mysqli_fetch_assoc($results); 
                $user_name = $ui_row['firstname'];
                
            
            echo "<h2 style=\"font-family: 'Inter', sans-serif; font-size: 35px; font-weight: bold; color: black;\">Hello, User " . htmlspecialchars($user_name) . "!</h2>";
            }
            
        } else {
            echo "<p style=\"font-family: 'Inter', sans-serif; font-size: 35px; font-weight: bold; color: black;\">Hello, USer!</p>";
        }
        ?>
        <p style="margin: 0;">Discover the world of SSITE - </p>
        <p style="margin: 0;">Your gateway to knowledge and innovation.</p>
        <p style="margin-top: 0;">Explore now!</p>

        <?php
            if (isset($_GET['error'])) {
                echo '<p style="color: #458D9E;" class="error-login" align="center">' . $_GET['error'] . '</p>';
            }            
        ?> 

    <div>
    <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action"><i class="fa-solid fa-house"></i> Home</a>
                <a href="product_display.php" class="list-group-item list-group-item-action"><i class="fa-solid fa-shirt"></i> Products</a>
                <a href="view_updates.php" class="list-group-item list-group-item-action"><i class="fa-solid fa-newspaper"></i> News & Updates</a>
                <a href="#" class="list-group-item list-group-item-action"><img src="images/SSITE-LOGO-WHITE.png" alt="Logo" style="width: 20px; height: 20px; filter: invert(1) brightness(0);"> About Us</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="fa-solid fa-user"></i> Profile Account</a>
                   
                </div>
    </div>
    </div>
    
    <style>
        .home-txt {
            text-align: center;
            margin-top: 50px;
        }

        .list-group {
            margin: 20px auto;
            width: 100%;
            position: relative;
            left: 0;
        }

        .list-group-item {
            font-size: 18px;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            color: #333;
            padding: 15px 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: background-color 0.3s ease;
        }

        .list-group-item:hover {
            background-color: #f0f0f0;
        }
    </style>

<div class="footer-footer">
    <?php
        include 'includes/footer.php';
    ?>
</div>