<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <img src="images/SSITE-LOGO-CIRCLE.png" alt="SSITE Logo" height="120px" width="120px">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="list-group">
                <a href="view_category.php" class="list-group-item list-group-item-action">Categories</a>
                <a href="view_product.php" class="list-group-item list-group-item-action">Products</a>
                <a href="view_news.php" class="list-group-item list-group-item-action">News & Updates</a>
                <?php 
                if(isset($_SESSION['isPriv'])){ ?>
                    <a href="view_admin.php" class="list-group-item list-group-item-action"> Administrator</a>
                    <?php } ?>
                <a href="view_transaction.php" class="list-group-item list-group-item-action">Transactions</a>
                <!-- Collapsible Section -->
<?php 

    if(isset($_SESSION['isPriv'])){ ?>
        <a class="list-group-item list-group-item-action" 
        data-bs-toggle="collapse" 
        href="#collapseAccounts" 
        role="button" 
        aria-expanded="false" 
        aria-controls="collapseAccounts">
            User Account Records
        </a>
        <div class="collapse" id="collapseAccounts">
            <ul class="list-group mt-2">
                <a class="list-group-item list-group-item-action" href="view_userinfo.php">User Information</a>
                <a class="list-group-item list-group-item-action" href="view_useracc.php">User Account Details</a>
            </ul>
        </div>
        <style>
            .collapse {
                text-indent: 20px;
            }
        </style>
    <?php }

?>

                
            </div>
        </div>
    </div>

    
    <!-- Sidebar JS -->
 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 
