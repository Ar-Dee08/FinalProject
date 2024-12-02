<?php

require 'dbcon.php';

if(isset($_POST['signUp'])){

    $email = $_POST['email'];
    $emailAlreadyExists = CheckEmail("user_information",$con,$email);

    if($emailAlreadyExists){
        if (empty($uname)) {
            header("Location: ../adminside/register.php?error=Email Address Already Exists");
            exit();
        }
    } else {
        $firstName = ucwords(strtolower($_POST['first_name']));
        // $middleName = $_POST['first_name'];
        $lastName = ucwords(strtolower($_POST['last_name']));
        $gender = ucwords(strtolower($_POST['gender']));
        $bday = $_POST['dob'];
        $contactnum = $_POST['mobile'];
        $account_status = "Active";
        $mem_status = 1; //unidentified
    
        //check if verified email
        
       
        //checks type converts to id
    
        $val_custype = $_POST['type'];
        if($val_custype == "student"){
            $customertype_id = 1;
        } else if($val_custype == "non_student"){
            $customertype_id = 2;
        } else {
            $customertype_id = 0;
        }
    
        if($customertype_id == 1){
            $studentnum = $_POST['student_number'];
        } else {
            $studentnum = "-";
        }
    
        $custype_verif_id = 1; //pending
        $uid = (TableRowCount("user_information",$con)) + 1;
    
        echo $uid . $firstName . $lastName . $gender . $bday . $contactnum . $account_status . $mem_status . $email . $customertype_id . $studentnum . $custype_verif_id ;
    
        // CHECK ID 
    
    
        // firstname	/
        // middlename	/
        // lastname	/
        // sex/
        // 	bday /	
        //     student_number	 -
        //     contact_number /
        //     	email
        //         	account_status/
        //             	memstatus_id /
        //                 	customertype_id /
        //                     	custype_verif_id /
    }    
}


function TableRowCount(string $table, $con) {
    $query = "SELECT * FROM " . $table;
    $count = 0;

    if ($results = mysqli_query($con,$query))
    $count = mysqli_fetch_assoc($results);

    return $count;
}

function CheckEmail($table, $con,$email){
    $check_email = "SELECT * FROM user_information WHERE email='$email'";
    $results=$con->query($check_email);
    if($results->num_rows>0){
        echo "Email Address already Exists";
        return True;
    } else {
        return False;
    }
    // return False;
}

?>