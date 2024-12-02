
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<header>
    <img src="images/SSITE-LOGO.png" alt="SSITE-LOGO Logo" style="width:80px;height:auto;">
    <h1>LOGIN</h1>
</header>
<body>
    <div class="ssite">
        <img src="images/SSITE-LOGO.png" alt="Site Logo" style="width:80px;height:auto;">
        <p>Order your merchandise now!</p>
    </div>
        <div class="login-container">
         <h2>Log In</h2>
            <?php
                if (isset($_GET['error'])) {
                    echo '<p class="error-login">' . $_GET['error'] . '</p>';
                }            
            ?>
         <form action="../vscode/userlogin.php" method="post">
            <div class="form-group">
                <label for="username">Username / Email:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">LOG IN</button>
            <button type="button" onclick="window.location.href='register.php'">CREATE ACCOUNT</button>
            <!-- FORGOR PASS ADMEN BUTON -->
            <!-- <button type="button" onclick="window.location.href='forgotpassword.html'">FORGOT PASSWORD</button>
            <button type="button" onclick="window.location.href='admin.html'">ADMIN</button> -->
            </form>
        </div>
</body>
</html>