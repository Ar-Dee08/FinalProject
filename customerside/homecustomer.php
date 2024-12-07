<?php
// session_start();
include 'includes/header.php';
include 'user_middleware.php';
include '../vscode/dbcon.php';
?>
    <div class="home-txt">
    
    <div>
    <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">Home</a>
                <a href="product_display.php" class="list-group-item list-group-item-action">Products</a>
                <a href="#" class="list-group-item list-group-item-action">News & Updates</a>
                <a href="#" class="list-group-item list-group-item-action">About Us</a>
                <a href="#" class="list-group-item list-group-item-action">Profile Account</a>
                
    <a class="list-group-item list-group-item-action" 
    data-bs-toggle="collapse" 
    href="#collapseAccounts" 
    role="button" 
    aria-expanded="false" 
    aria-controls="collapseAccounts">
        Collapsible Title
    </a>
    <div class="collapse" id="collapseAccounts">
        <ul class="list-group mt-2">
            <a class="list-group-item list-group-item-action" href="view_userinfo.php">Asdfghjkl 1</a>
            <a class="list-group-item list-group-item-action" href="view_useracc.php">Asdfghjkl 2</a>
        </ul>

                
                </div>
    </div>
    </div>
    
<div class="footer-footer">
    <?php
        include 'includes/footer.php';
    ?>
</div>