<?php
// session_start();
include 'includes/header.php';
include 'admin_middleware.php';
include '../vscode/dbcon.php';
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
    
    <?php
        if (isset($_SESSION['admin_id'])) {

            $getnamequery = "SELECT * FROM admin a LEFT JOIN user_information ui ON a.userinfo_id = ui.userinfo_id WHERE admin_id = ?";
            $stmt = $con->prepare($getnamequery);
            $stmt->bind_param("i",$_SESSION['admin_id']);

            if ($stmt->execute()) {
                $results = $stmt->get_result(); // Always return the result object        
                $ui_row = mysqli_fetch_assoc($results); 
                $admin_name = $ui_row['firstname'];
                
            
            echo "<h2>Hello, Admin " . htmlspecialchars($admin_name) . "!</h2>";
            }
            
        } else {
            echo "<p>Hello, Admin!</p>";
        }
        ?>
        <p>What would you like to do today?</p>

        <?php
            if (isset($_GET['error'])) {
                echo '<p style="color: #458D9E;" class="error-login" align="center">' . $_GET['error'] . '</p>';
            }            
        ?> 

<div class="footer-footer">
    <?php
        include 'includes/footer.php';
    ?>
</div>