<?php

require "dbcon.php";

session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    function verify($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
$uemail = verify($_POST['username']);
$pass = verify($_POST['password']);
//FOR ADMIN ONLY
$setname = "admin";
$setpass = "pass";

//FOR USERS
$userIsRegistered = False;
// $userIsRegistered = CheckUserEmail("user_information", $con, $email);
$table = "user_credentials";
$field = "userinfo_id";
$uidres = RetrieveUser($table,$con,$pass, $email);

if(mysqli_num_rows($uidres)===1){
    // $userIsRegistered = True;
    $uinfo_row = mysqli_fetch_assoc($uidres);
    if($uinfo_row['email'] == $uemail && $uinfo_row['password'] == $pass) {
        $uid = $uinfo_row['userinfo_id'];
        $aidres = RetrieveAdmin($con,$uid);
        if(mysqli_num_rows($aidres)==1){
            $admin_row = mysqli_fetch_assoc($aidres);
            echo 'This is admin';
            header("Location: ../adminside/homeadmin.php");
            exit();
        } else if(mysqli_num_rows($aidres)==0){

            echo 'This is not admin';
            header("Location: ../customerside/homecustom.php");
            exit();
        }
    }
} else {
    // $userIsRegistered = False;
}

// if (empty($uname)) {
//     header("Location: ../adminside/index.php?error=User Name is required");
//     exit();
// } else if(empty($pass)) {
//     header("Location: ../adminside/index.php?error=Password is required");
//     exit();
// }

// $sql = "SELECT * FROM assess5 WHERE user_name = '$uname' AND password = '$pass';";

// $results = mysqli_query($conn, $sql);

// // THIS IS IF IM GONNA SHOW VALIDATION SEPARATELY
// // TEST THIS IN THE INDEX PHP IF IT WORKS

if (mysqli_num_rows($results) === 1) {
    $row = mysqli_fetch_assoc($results);
    if ($row['user_name'] == $uname && $row['password'] == $pass) {
        echo 'Logged In!';
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['id'] = $row['id'];
        header("Location: main.php");
        exit();
    }
}

// } else {
//     header("Location: index.php?error=Incorrect User Name or Password");
//     exit();
// }

if ($uname === $setname && $pass === $setpass) {
    echo 'Logged in!';
    $_SESSION['signedin_email'] = $uname;
    $_SESSION['signedin_pass'] = $pass;
    $_SESSION['userid'];

    //CHECK IF USER IS CUSTOMER OR ADMIN USING IF ELSE AND SETTING $_SESSION['user_type']

    header("Location: ../customerside/homecustom.php"); //IF NOT CUSTOMER OR ADMIN, SHOULD BE STRAIGHT TO HOME
    // header("Location: ../adminside/homeadmin.php");    //IF ADMIN, SHOULD PROMPT IF AS CUSTOMER OR ADMIN
} else {
    header("Location: ../adminside/index.php");
    exit();
}

function RetrieveUser($table,$con, $pass, $email)
{
    $retrievefield = "SELECT * FROM ".$table." WHERE email='".$email."' AND password= '".$pass."';";
    $results = $con->query($retrievefield);
    if ($results->num_rows > 0) {
        echo "Record already Exists";
        return $results;
    } else {
        return 0;
    }
}

function RetrieveAdmin($con,$uid){
    $retrievefield = "SELECT * FROM admin WHERE userinfo_id=".$uid.";";
    $results = $con->query($retrievefield);
    if ($results->num_rows > 0) {
        echo "Record already Exists";
        return $results;
    } else {
        return 0;
    }
}


function CheckUserType()
{
    $as = s;
}

// function RetrieveFromOneField($table,$field, $con, $condition)
// {
//     $retrievefield = "SELECT ".$field." FROM ".$table." WHERE email='".$condition."'";
//     $results = $con->query($retrievefield);
//     if ($results->num_rows > 0) {
//         echo "Record already Exists";
//         return $results;
//     } else {
//         return 0;
//     }
// }