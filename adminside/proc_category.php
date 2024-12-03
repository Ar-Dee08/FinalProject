<?php

session_start();

require "../vscode/dbcon.php";

//THIS IS FOR CONFIRMING AND INSERTING / UPDAITNG CATEGORY RECORD
if(isset($_POST['cat-confirm-btn'])){
    $isEdit = $_POST['cat-confirm-btn'];
    $catname = $_POST['catname']; // Fetch category name from input

    if($isEdit === "1"){
        //INSERT UPDATE
        header("Location: view_category.php");
        exit();
        
    } else if($isEdit === "0") {
        $catid = (TableRowCount("categories",$con)+1);
        $admin_id = $_SESSION['admin_id'];

        $query= "INSERT INTO categories(cat_id,category_name,admin_creator,date_created,record_status) VALUES(".$catid.",'".$catname."',".$admin_id.",NOW(),'Active');";

        $SuccessCat = InsertRecord($query,$con);

        if($SuccessCat){

            header("Location: view_category.php");
            exit();
        } else {
            echo 'unsuccessful';
            header("Location: mod_product.php");
            exit();        
        }
    } else {
        echo $isEdit;
    }

    

} else if (isset($_POST['cancel-btn'])){
    header("Location: view_category.php");
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

function InsertRecord($query, $con)
{
    if (mysqli_query($con, $query)) {
        echo "New record created successfully";
        return true;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
        return false;
    }
}









?>

