<?php
// session_start();
include 'includes/header.php';
include 'admin_middleware.php';
include '../vscode/dbcon.php';
?>

<body class="logo-bg-2">
    <div class="home-txt">
    
    
    <?php
        if (isset($_SESSION['admin_id'])) {

            $getnamequery = "SELECT * FROM admin a LEFT JOIN user_information ui ON a.userinfo_id = ui.userinfo_id WHERE admin_id = ?";
            $stmt = $con->prepare($getnamequery);
            $stmt->bind_param("i",$_SESSION['admin_id']);

            if ($stmt->execute()) {
                $results = $stmt->get_result(); // Always return the result object        
                $ui_row = mysqli_fetch_assoc($results); 
                $admin_name = $ui_row['firstname'];
                
            
            echo "<h2>Hello, Admin " . htmlspecialchars($admin_name) . "!</h2>";
            }
            
        } else {
            echo "<p>Hello, Admin!</p>";
        }
        ?>
        <p>What would you like to do today?</p>

        <?php
            if (isset($_GET['error'])) {
                echo '<p style="color: #458D9E;" class="error-login" align="center">' . $_GET['error'] . '</p>';
            }            
        ?> 
    <div>
    <div class="list-group">
                <a href="view_category.php" class="list-group-item list-group-item-action">CATEGORIES</a>
                <a href="view_product.php" class="list-group-item list-group-item-action">PRODUCTS/ITEMS</a>
                <a href="view_news.php" class="list-group-item list-group-item-action">NEWS & UPDATES</a>
                <a href="view_admin.php" class="list-group-item list-group-item-action">ADMINISTRATORS</a>
                <a href="view_transaction.php" class="list-group-item list-group-item-action">TRANSACTIONS</a>
                <?php 

if(isset($_SESSION['isPriv'])){ ?>
    <a class="list-group-item list-group-item-action" 
    data-bs-toggle="collapse" 
    href="#collapseAccounts" 
    role="button" 
    aria-expanded="false" 
    aria-controls="collapseAccounts">
        USER ACCOUNT RECORDS
    </a>
    <div class="collapse" id="collapseAccounts">
        <ul class="list-group mt-2">
            <a class="list-group-item list-group-item-action" href="view_userinfo.php">USER INFORMATION</a>
            <a class="list-group-item list-group-item-action" href="view_useracc.php">USER ACCOUNT DETAILS</a>
        </ul>
<?php }

?>


                
                </div>
    </div>
    </div>

<?php

include 'includes/footer.php';


?>