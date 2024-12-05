<?php
session_start();
include 'admin_middleware.php';
include 'includes/header.php';
include 'includes/footer.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body class="logo-bg-2">
    <div class="home-txt">
        <h2>Welcome, Admin!</h2>
        <p>What would you like to do today?</p>
    </div>
    <!-- 
    <?php
        if (isset($_SESSION['firstname'])) {
            echo "<p>Hello, " . htmlspecialchars($_SESSION['firstname']) . "!</p>";
        } else {
            echo "<p>Hello, Admin!</p>";
        }
        ?>
     -->

</body>
</html>