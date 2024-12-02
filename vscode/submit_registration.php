<?php

require 'dbcon.php';

if (isset($_POST['signUp'])) {

    // $isadmin = False;
    $email = $_POST['email'];
    $emailAlreadyExists = CheckEmail("user_information", $con, $email);
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

        //check if verified email

        //checks type converts to id

        $val_custype = $_POST['type'];
        if ($val_custype == "student") {
            $customertype_id = 1;
        } else if ($val_custype == "non_student") {
            $customertype_id = 2;
        } else {
            $customertype_id = 0;
        }

        if ($customertype_id == 1) {
            $studentnum = $_POST['student_number'];
        } else {
            $studentnum = "-";
        }

        $custype_verif_id = 1; //pending
        $uid = (TableRowCount("user_information", $con)) + 1;

        echo $uid . $firstName . $lastName . $gender . $bday . $contactnum . $account_status . $mem_status . $email . $customertype_id . $studentnum . $custype_verif_id;

        $registerquery = "INSERT INTO user_information(userinfo_id, firstname, lastname, gender, bday, student_number, contact_number,email,account_status,memstatus_id,customertype_id,custype_verif_id,account_created)
        VALUES(" . $uid . ",'" . $firstName . "','" . $lastName . "','" . $gender . "','" . $bday . "','" . $studentnum . "','" . $contactnum . "','" . $email . "','" . $account_status . "'," . $mem_status . "," . $customertype_id . "," . $custype_verif_id . ", NOW());";

        if (mysqli_query($con,$registerquery)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $registerquery . "<br>" . mysqli_error($con);
        }

        // firstname    /
        // middlename    /
        // lastname    /
        // sex/
        //     bday /
        //     student_number     -
        //     contact_number /
        //         email
        //             account_status/
        //                 memstatus_id /
        //                     customertype_id /
        //                         custype_verif_id /

        header("Location: ../adminside/homeadmin.php");
    }
}

function TableRowCount(string $table, $con)
{
    $query = "SELECT * FROM " . $table;
    $count = 0;

    if ($results = mysqli_query($con, $query)) {
        $count = mysqli_fetch_assoc($results);
    }

    return $count;
}

function CheckEmail($table, $con, $email)
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
