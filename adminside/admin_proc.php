<?php

session_start();

require "../vscode/dbcon.php";

//THIS IS FOR CONFIRMING AND INSERTING / UPDAITNG CATEGORY RECORD
if(isset($_POST['cat-confirm-btn'])){
    $isEdit = $_POST['cat-confirm-btn'];
    $catname = $_POST['catname']; // Fetch category name from input

    if($isEdit === "1"){
        // UPDATE
        
        $catid = $_POST['catid'];
        $cat_recstat = $_POST['recstat'];
        $query = "UPDATE categories SET category_name = ?, record_status = ? WHERE cat_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("sss", $catname,$cat_recstat, $catid);

        if ($stmt->execute()) {
            header("Location: view_category.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else if($isEdit === "0") {
        $catid = TableRowCount("categories", $con) + 1;
        $admin_id = $_SESSION['admin_id'];

        $query = "INSERT INTO categories (cat_id, category_name, admin_creator, date_created, record_status) 
                  VALUES (?, ?, ?, NOW(), 'Active')";
        $stmt = $con->prepare($query);
        $stmt->bind_param("isi", $catid, $catname, $admin_id);

        if ($stmt->execute()) {
            header("Location: view_category.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Invalid action.";
    }

} else if (isset($_POST['cat-cancel-btn'])){
    header("Location: view_category.php");

} else if(isset($_POST['item-confirm-btn'])){   //FOR ITEM PROCESSING
    $isEdit = $_POST['item-confirm-btn'];
    $item_name = $_POST['item_name'];
    $item_spec = $_POST['item_spec'];
    $item_desc = $_POST['item_desc'];
    $item_price = $_POST['item_price'];
    $cat_id = $_POST['cat_id']; 

    $item_img = $_FILES['item_img']['name'];
    $path = "item_images/";
    $item_img_ext = pathinfo($item_img,PATHINFO_EXTENSION);
    $imgfile_name = $item_id."_".time(). '.' . $item_img_ext;
    move_uploaded_file($_FILES['item_img']['tmp_name'], $path . $imgfile_name);

    if($isEdit === "1"){
        $item_id = $_POST['item_id'];
        $item_recstat = $_POST['recstat'];

        $query = "UPDATE items SET item_name = ?, item_spec = ?, item_desc=?, item_price, cat_id, item_img, record_status = ? WHERE item_id = ?";
        // 
        $stmt = $con->prepare($query);
        $stmt->bind_param("sssdsisi", $item_name,$item_spec, $item_desc, $item_price, $imgfile_name, $cat_id, $item_recstat, $item_id);

        if ($stmt->execute()) {
            header("Location: view_category.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }



    } else if($isEdit === "0") {
        $item_id = TableRowCount("items",$con)+1;
        $admin_id = $_SESSION['admin_id'];

        $query = "INSERT INTO items(item_id,item_name,item_spec,item_desc,item_price,cat_id,item_img,admin_creator,date_created,record_status)
        VALUES(?,?,?,?,?,?,?,?,NOW(),'Active');";

        $stmt = $con->prepare($query);
        $stmt->bind_param("isssdisi", $item_id,$item_name,$item_spec,$item_desc,$item_price,$cat_id,$imgfile_name, $admin_id);

        if ($stmt->execute()) {
            header("Location: view_product.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }


    } else {
        echo "Invalid action.";
    } 

} else if (isset($_POST['item-cancel-btn'])){
    header("Location: view_product.php");

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














// function ExecQuery($query, $con)
// {
//     if (mysqli_query($con, $query)) {
//         echo "New record created successfully";
//         return true;
//     } else {
//         echo "Error: " . $query . "<br>" . mysqli_error($con);
//         return false;
//     }
// }


?>

