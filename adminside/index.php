
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<header>
    <img src="images/SSITE-LOGO.png" alt="SSITE-LOGO Logo" style="width:80px;height:auto;">
    <h1>LOGIN</h1>
</header>
<body class="login-bg">
    <div class="ssite">
        <img src="images/SSITE-LOGO.png" alt="Site Logo" style="width:80px;height:auto;">
        <p>Order your merchandise now!</p>
    </div>
        <div class="login-container">
         <h2>Log In</h2>

            <?php
                if (isset($_GET['catid'])) {
                    echo '<p style="color: #CEDFE3;" class="error-login" align="center">' . $_GET['catid'] . '</p>';
                }            
            ?>
         <form action="../vscode/userlogin.php" method="post">
            <div class="form-group">
                <label for="username">Email:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <p><a href="adminLogin.php">Are you an admin? Log in here</a></p>

            <button type="submit" id="logintype" name="logintype" value="1">LOG IN</button>
            <button type="button" onclick="window.location.href='register.php'">CREATE ACCOUNT</button>
            <!-- FORGOR PASS ADMEN BUTON -->
            <!-- <button type="button" onclick="window.location.href='forgotpassword.html'">FORGOT PASSWORD</button>
            <button type="button" onclick="window.location.href='admin.html'">ADMIN</button> -->
            </form>
        </div>
</body>
</html>