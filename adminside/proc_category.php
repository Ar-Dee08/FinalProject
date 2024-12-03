<?php

session_start();

require "../vscode/dbcon.php";

if(isset($_POST['cat-btn'])){
    $catname = $_POST['catname'];

    $catid = (TableRowCount("categories",$con)+1);
    $admin_id = $_SESSION['admin_id'];

    $query= "INSERT INTO categories(cat_id,category_name,admin_creator,date_created) VALUES(".$catid.",'".$catname."',".$admin_id.",NOW());";

    $SuccessCat = InsertRecord($query,$con);

    if($SuccessCat){

        header("Location: mod_category.php?=1");
        exit();
    } else {
        echo 'unsuccessful';
        header("Location: mod_category.php?");
        exit();
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

