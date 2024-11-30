<?php

session_start();

if (isset($_POST['uname']) && isset($_POST['password'])) {
    function verify($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

$uname = verify($_POST['uname']);
$pass = verify($_POST['password']);
$setname = "admin";
$setpass = "pass";

if (empty($uname)) {
    header("Location: index.php?error=User Name is required");
    exit();
} else if(empty($pass)) {
    header("Location: index.php?error=Password is required");
    exit();
}

// $sql = "SELECT * FROM assess5 WHERE user_name = '$uname' AND password = '$pass';";

// $results = mysqli_query($conn, $sql);

// // THIS IS IF IM GONNA SHOW VALIDATION SEPARATELY 
// // TEST THIS IN THE INDEX PHP IF IT WORKS

// if (mysqli_num_rows($results) === 1) {
//     $row = mysqli_fetch_assoc($results);
//     if ($row['user_name'] == $uname && $row['password'] == $pass) {
//         echo 'Logged In!';
//         $_SESSION['user_name'] = $row['user_name'];
//         $_SESSION['password'] = $row['password'];
//         $_SESSION['id'] = $row['id'];
//         header("Location: main.php");
//         exit();
//     } 
    
// } else {
//     header("Location: index.php?error=Incorrect User Name or Password");
//     exit();
// }

if ($uname === $setname && $pass === $setpass) {
    echo 'Logged in!';
    $_SESSION['user_name'] = $uname;
    $_SESSION['password'] = $pass;

    header("Location: admin.php");    
} else {
    header("Location: wronglog.php");
    exit();
}
