
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="icon" href="https://fontawesome.com/v4/icon/arrow-left">
    </head>
    <header>
        <button type="button" onclick="window.location.href='index.php'"></button>
        <i class="fa fa-arrow-left" aria-hidden="true"></i>
        </button>
        <img src="images/SSITE-LOGO.png" alt="SSITE-LOGO Logo" style="width:80px;height:auto;">
        <h1>ADMIN LOGIN</h1>
    </header>
<body>
    <div class="logossite">
        <img src="images/SSITE-LOGO.png" alt="Site Logo" style="width:80px;height:auto;">
        <p>Set our merchandise now!</p>
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
                <label for="username">Email:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">LOG IN</button>
            <button type="button" onclick="window.location.href='register.php'">CREATE ACCOUNT</button>
            </form>
        </div>
</body>
</html>