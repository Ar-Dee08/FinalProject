<?php
session_start();

if (isset($_SESSION['password']) && isset($_SESSION['user_name'])) {    //CHECK IF USER IS ADMIN, will be updated
    
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>HIIII</h1>
</body>
</html>


<!-- CHECKS IF USERLOGGED IN AS ADMIN -->

<?php
} else {
    header("Location: index.php");
    exit();
}

?>