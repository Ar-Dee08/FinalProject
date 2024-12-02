<?php
session_start();

if (isset($_SESSION['password']) && isset($_SESSION['user_name'])) { //CHECK IF USER IS ADMIN, will be updated

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>

</body>
</html>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action">CATEGORIES</a>
            <a href="#" class="list-group-item list-group-item-action">PRODUCTS/ITEMS</a>
            <a href="#" class="list-group-item list-group-item-action">NEWS & UPDATES</a>
            <a href="#" class="list-group-item list-group-item-action">ACCOUNTS</a>
            <a href="#" class="list-group-item list-group-item-action">ADMINISTRATORS</a>
            <a href="#" class="list-group-item list-group-item-action">TRANSACTIONS</a>
            <a href="#" class="list-group-item list-group-item-action">USERS</a>
        </div>
    </div>
</div>

<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
    Open Menu
</button>
<a href="../vscode/userlogout.php">Back</a>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php
} else {
    header("Location: index.php");
    exit();
}

?>