<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>
    <title>Register</title>
</head>
<body class="login-bg">
    <header>
    <a href="index.php"><button type="button" id="back-btn"><i class="fa-solid fa-arrow-left"></i></button></a> 
        <img src="images/SSITE-LOGO.png" alt="Site Logo" style="width:80px;height:auto;">
        <h1>REGISTER</h1>
        <a href="index.php" style="position: absolute; left: 10px; top: 10px;"></a>
    </header>

    <main>
        <section>
            <h2>Let's get you signed up!</h2>
            <p>Enter required information</p>
            <?php
                    if (isset($_GET['error'])) {
                        echo '<p class="error-login">' . $_GET['error'] . '</p>';
                    }            
                ?>
            <form action="../vscode/submit_registration.php" method="post">
                <label for="mobile">Mobile Number:</label>
                <input type="tel" id="mobile" name="mobile" placeholder="Enter your mobile number" required><br><br>                                

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" required><br><br>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required><br>
                
                <p id="passwarning"><b>Password does NOT match</b></p>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" onkeyup="confirmPass();" required><br><br>

                <label for="type">Type:</label>
                <select class="login-sel" id="type" name="type" required> 
                    <!-- WILL BA MODIFIED WITH PHP LATER -->
                    <option value="student">Student</option>
                    <option value="non_student">Non-Student</option>
                </select><br><br>
            
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" required><br><br>
                
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" required><br><br>
                
                <label for="gender">Gender:</label>
                <select class="login-sel" id="gender" name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select><br><br>
                
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" placeholder="Enter your date of birth" required><br><br>
                
                <label for="student_number">Student Number:</label>
                <input type="text" id="student_number" name="student_number" placeholder="Enter your student number" required><br><br>
                
                <button type="submit" name="signUp">COMPLETE REGISTRATION</button>
            </form>
        </section>
    </main>
    <script src="reg.js" type="text/javascript"></script>

</body>
</html>