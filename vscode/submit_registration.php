<?php

require 'dbcon.php';

if (isset($_POST['signUp'])) {

    $email = $_POST['email'];
    $emailAlreadyExists = CheckEmail($con, $email);
    $firstpass = $_POST['password'];
    $confirmpass = $_POST['confirm_password'];

    if ($emailAlreadyExists) {
        header("Location: ../adminside/register.php?error=Email Address Already Exists");

    } else if ($firstpass != $confirmpass) {
        header("Location: ../adminside/register.php?error=Password does not match");
    } else {
        $firstName = ucwords(strtolower($_POST['first_name']));
        $lastName = ucwords(strtolower($_POST['last_name']));
        $gender = ucwords(strtolower($_POST['gender']));
        $bday = $_POST['dob'];
        $contactnum = $_POST['mobile'];
        $account_status = "Active";
        $mem_status = 1; //unidentified
        $password = $firstpass;

        //checks type converts to id
        $val_custype = $_POST['type'];
        if ($val_custype == "student") {
            $customertype_id = 1;
        } else if ($val_custype == "non_student") {
            $customertype_id = 2;
        } else {
            $customertype_id = 0;
        }

        //check for student number if student
        if ($customertype_id == 1) {
            $studentnum = $_POST['student_number'];
        } else {
            $studentnum = "-";
        }

        $custype_verif_id = 1; //pending
        $uid = (TableRowCount("user_information", $con)) + 1;
        $ucredid = (TableRowCount("user_credentials",$con)) + 1;
        // echo $uid . $firstName . $lastName . $gender . $bday . $contactnum . $account_status . $mem_status . $email . $customertype_id . $studentnum . $custype_verif_id;

        $registerquery = "INSERT INTO user_information(userinfo_id, firstname, lastname, gender, bday, student_number, contact_number,email,account_status,memstatus_id,customertype_id,custype_verif_id,account_created)
        VALUES(" . $uid . ",'" . $firstName . "','" . $lastName . "','" . $gender . "','" . $bday . "','" . $studentnum . "','" . $contactnum . "','" . $email . "','" . $account_status . "'," . $mem_status . "," . $customertype_id . "," . $custype_verif_id . ", NOW());";

        $credquery = "INSERT INTO user_credentials(usercred_id, email,password,userinfo_id,usertype_id) VALUES(". $ucredid .", '" . $email . "','" . $password . "',". $uid .",1);";

        $SuccessRegisterInfo = InsertRecord($registerquery, $con);
        $SuccessRegisterCred = InsertRecord($credquery,$con);

        if($SuccessRegister && $SuccessRegisterCred){
            header("Location: ../adminside/homeadmin.php");

        } else {
            header("Location: ../adminside/register.php?error=Registration Unsuccessful. Report issue with SSITE.");
        }
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

function InsertRecord($query,$con){
    if (mysqli_query($con,$query)) {
        echo "New record created successfully";
        return true;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
        return false;
    }
}

function CheckEmail( $con, $email)
{
    $check_email = "SELECT * FROM user_information WHERE email='$email'";
    $results = $con->query($check_email);
    if ($results->num_rows > 0) {
        echo "Email Address already Exists";
        return true;
    } else {
        return false;
    }
    // return False;
}
