
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>
    <link rel="icon" href="images/SSITE-LOGO.png" type="image/png">
    </head>
    <header>
        <a href="index.php"><button type="button" id="back-btn"><i class="fa-solid fa-arrow-left"></i></button></a> 
        <img src="images/SSITE-LOGO.png" alt="SSITE-LOGO Logo" style="width:80px;height:auto;">
        <h1>ADMIN LOGIN</h1>
    </header>
<body class="login-bg">
    <div class="logossite">
        <img src="images/SSITE-LOGO.png" alt="Site Logo" style="width:80px;height:auto;">
        <p>Set our merchandise now!</p>
    </div>
        <div class="login-container">
         <h2>Log In</h2>
             <?php
                if (isset($_GET['error'])) {
                    echo '<p style="color: #CEDFE3;" class="error-login" align="center">' . $_GET['error'] . '</p>';
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
            <p><a href="index.php">Are you an awesome customer? Log in here</a></p>
            <button type="submit" id="logintype" name="logintype" value="2">LOG IN</button>
            <br>
            <button type="button" onclick="window.location.href='register.php'">CREATE ACCOUNT</button>
            </form>
        </div>
</body>
</html>