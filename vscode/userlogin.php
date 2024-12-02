<?php

require "dbcon.php";

session_start();
//USERNAME MIGHT BE CHANGED TO EMAIL
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
// $setname = "admin";
// $setpass = "pass";

//FOR USERS
$table = "user_credentials";
$uidres = RetrieveUser($table,$con,$uemail, "email");

if(mysqli_num_rows($uidres)===1){
    $uinfo_row = mysqli_fetch_assoc($uidres);
    if($uinfo_row['email'] === $uemail && password_verify($pass, $uinfo_row['password'])) {
        $uid = $uinfo_row['userinfo_id'];
        $ucred_id = $uinfo_row['usercred_id'];

        echo $uid;
        $aidres = RetrieveAdmin($con,$uid);
        if(mysqli_num_rows($aidres)===1){           //verified user and is admin
            $admin_row = mysqli_fetch_assoc($aidres);
            $aid = $admin_row['admin_id'];
            $usertype_id = 2; //admin id
            echo 'This is admin';
            $_SESSION['uid'] = $uid;
            $_SESSION['admin_id'] = $aid;

            $SuccessInsert = InsertUserLog( $con,$ucred_id,$usertype_id);// USER TYPE ID WILL BE CHANGED IN DIFF PAGE FOR VERIFICATION

            header("Location: ../adminside/homeadmin.php");     //WILL BE CHANGED IF MAY BRIDGE PAGE NA TO ADMIN
            exit();
        } else {                                            //verified but customer only
            echo 'This is not admin';
            $usertype_id = 1; //customer id
            $_SESSION['uid'] = $uid;

            $SuccessInsert = InsertUserLog( $con,$ucred_id,$usertype_id);// USER TYPE ID WILL BE CHANGED IN DIFF PAGE FOR VERIFICATION

            header("Location: ../customerside/homecustom.php");
            exit();
        }
    }else {
        echo 'Invalid password.';
        header("Location: ../adminside/index.php?error=Incorrect Password.");
        exit();
    }
} else {
    // $userIsRegistered = False;
    echo 'This user is not registered';
    header("Location: ../adminside/index.php?error=Invalid Credentials.");
    exit();
}

function RetrieveUser($table, $con, $email, $conditionfield) {
    $retrievefield = "SELECT * FROM $table WHERE $conditionfield = ?";
    $stmt = $con->prepare($retrievefield);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result(); // Always return the result object
}

function RetrieveAdmin($con, $uid) {
    $retrievefield = "SELECT * FROM admin WHERE userinfo_id = ?";
    $stmt = $con->prepare($retrievefield);
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    return $stmt->get_result(); // Always return the result object
}

function InsertUserLog($con,$ucred_id,$usertype_id){
    $userlogin_query = "INSERT INTO user_login(userlogin_id,usercred_id,logindate,usertype_id) VALUES (".(TableRowCount("user_login",$con)+1). ",".$ucred_id.",NOW(),".$usertype_id.")";

    if (mysqli_query($con, $userlogin_query)) {
        echo "New record created successfully";
        return true;
    } else {
        echo "Error: " . $userlogin_query . "<br>" . mysqli_error($con);
        return false;
    }
}

function TableRowCount(string $table, $con)
{
    $query = "SELECT COUNT(*) AS total FROM " . $table;
    $count = 0;

    if ($results = mysqli_query($con, $query)) {
        $row = mysqli_fetch_assoc($results);
        $count = $row['total'];
    }

    return $count;
}