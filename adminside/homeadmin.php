<?php
session_start();

if (isset($_SESSION['signedin_pass']) && isset($_SESSION['signedin_email'])) { //CHECK IF USER IS ADMIN, will be updated

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin</title>
</head>
<body>
<<<<<<< HEAD:adminside/homeadmin.html
<header>
   
</header>

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
=======

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
>>>>>>> 631ae2ed956d2a0753d31da3383ad4d066ab4e2f:adminside/homeadmin.php
        </div>
    </div>

<<<<<<< HEAD:adminside/homeadmin.html
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon"></span>
    </button>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
=======
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
>>>>>>> 631ae2ed956d2a0753d31da3383ad4d066ab4e2f:adminside/homeadmin.php
