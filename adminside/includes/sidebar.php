
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <img src="images/SSITE-LOGO-CIRCLE.png" alt="SSITE Logo" height="120px" width="120px">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="list-group">
                <a href="view_category.php" class="list-group-item list-group-item-action">CATEGORIES</a>
                <a href="view_product.php" class="list-group-item list-group-item-action">PRODUCTS/ITEMS</a>
                <a href="view_news.php" class="list-group-item list-group-item-action">NEWS & UPDATES</a>
                <a href="view_admin.php" class="list-group-item list-group-item-action">ADMINISTRATORS</a>
                <a href="#" class="list-group-item list-group-item-action">TRANSACTIONS</a>
                <!-- Collapsible Section -->
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
        </div>
    <?php }

?>

                
            </div>
        </div>
    </div>

    
    <!-- Sidebar JS -->
 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 
