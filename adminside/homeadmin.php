<?php
session_start();
include 'admin_middleware.php';
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Home</h1>
    <div class="logo-bg-2">
        <img src="images/SSITE-LOGO.png" alt="Site Logo" style="width:80px;height:auto;">
    </div>

    <!-- Sidebar JS -->
    <div>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </div>

    <?php
        include 'includes/footer.php';
    ?>
</body>
</html>