<?php 
session_start();
require "../vscode/dbcon.php";
include 'admin_middleware.php';

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/SSITE-LOGO.png" type="image/png">
    <title>SSITE Inventory System</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['SCRIPT_NAME']) . '/style.css'; ?>">
    </head>
<body>

<?php
    include 'userCheck.php';
    // if($sesh_ad_priv === 2) {
    //     unset($_SESSION['isPriv']);
    // }
?>

<div class="custom-nav">
<?php 
include 'navbar.php'; 
include 'sidebar.php'; 
?>
            <div class="content">
            <!-- Your content goes here -->
