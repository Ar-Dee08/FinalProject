<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="list-group">
            <a href="view_category.php" class="list-group-item list-group-item-action">CATEGORIES</a>
            <a href="view_product.php" class="list-group-item list-group-item-action">PRODUCTS/ITEMS</a>
            <a href="view_news.php" class="list-group-item list-group-item-action">NEWS & UPDATES</a>

            <!-- Collapsible Section -->
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
                    <a class="list-group-item list-group-item-action" href="category2.php">USER ACCOUNT DETAILS</a>
                </ul>
            </div>

            <a href="#" class="list-group-item list-group-item-action">ADMINISTRATORS</a>
            <a href="#" class="list-group-item list-group-item-action">TRANSACTIONS</a>
            <a href="#" class="list-group-item list-group-item-action">USERS</a>
        </div>
    </div>
</div>
