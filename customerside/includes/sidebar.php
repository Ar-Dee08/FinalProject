<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <img src="images/SSITE-LOGO-CIRCLE.png" alt="SSITE Logo" height="120px" width="120px">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="list-group">
            <a href="product_display.php" class="list-group-item list-group-item-action">Products</a>
            <a href="view_news.php" class="list-group-item list-group-item-action">News & Updates</a>
            <a href="about_ssite.php" class="list-group-item list-group-item-action">About Us</a>
            <a href="view_profile.php" class="list-group-item list-group-item-action">Account</a>
            <!-- To edit -->
            <!-- Collapsible Section -->
            <?php if(isset($_SESSION['isPriv'])) { ?>
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
                <style>
                    .collapse {
                        text-indent: 20px;
                    }
                </style>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Sidebar JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
