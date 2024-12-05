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

}

//THIS IS FOR CONFIRMING AND INSERTING / UPDAITNG ITEM RECORD


else if(isset($_POST['item-confirm-btn'])){   //FOR ITEM PROCESSING
    $isEdit = $_POST['item-confirm-btn'];
    $item_name = $_POST['item_name'];
    $item_spec = $_POST['item_spec'];
    $item_desc = $_POST['item_desc'];
    $item_price = $_POST['item_price'];
    $cat_id = $_POST['cat_id']; 
    
    
    if($isEdit === "1"){
        $item_id = $_POST['item_id'];
        $item_recstat = $_POST['recstat'];
        $init_img = $_POST['init_img'];


        if (!empty($_FILES['item_img']['name'])) {
            // New image uploaded
            $item_img = $_FILES['item_img']['name'];
            $path = "record_images/item_images/";
            $item_img_ext = pathinfo($item_img, PATHINFO_EXTENSION);
            $imgfile_name = $item_id . "_" . time() . '.' . $item_img_ext;
            move_uploaded_file($_FILES['item_img']['tmp_name'], $path . $imgfile_name);
        } else {
            // No new image uploaded, retain the existing one
            $imgfile_name = $init_img;

            $query = "SELECT item_img FROM items WHERE item_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("i", $item_id);
            if($stmt->execute()){
                $imgres = $stmt->get_result();
                $qrow = $imgres->fetch_assoc(); // Adjusted fetch method
                $imgfile_name = $qrow['item_img'];
            }
        }
        

        $query = "UPDATE items SET item_name = ?, item_spec = ?, item_desc=?, item_price=?, cat_id=?, item_img=?, record_status = ? WHERE item_id = ?";
        // 
        $stmt = $con->prepare($query);
        $stmt->bind_param("sssdissi", $item_name,$item_spec, $item_desc, $item_price, $cat_id, $imgfile_name, $item_recstat, $item_id);

        if ($stmt->execute()) {
            header("Location: view_product.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

    } else if($isEdit === "0") {
        $item_id = TableRowCount("items",$con)+1;
        $admin_id = $_SESSION['admin_id'];

        $item_img = $_FILES['item_img']['name'];
            $path = "record_images/item_images/";
            $item_img_ext = pathinfo($item_img,PATHINFO_EXTENSION);
            $imgfile_name = $item_id."_".time(). '.' . $item_img_ext;
            move_uploaded_file($_FILES['item_img']['tmp_name'], $path . $imgfile_name);
            echo $imgfile_name;

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

//THIS IS FOR CONFIRMING AND INSERTING / UPDAITNG NEWS AND UPDATE RECORD



else if(isset($_POST['post-confirm-btn'])){   //FOR NEWS AND UPDATE PROCESSING
    $isEdit = $_POST['post-confirm-btn'];
    $post_title = $_POST['post_title'];
    $post_caption = $_POST['post_caption'];
    $post_url = $_POST['post_url']; 
    
    
    if($isEdit === "1"){
        $post_id = $_POST['post_id'];
        $post_recstat = $_POST['recstat'];
        $init_img = $_POST['init_img'];


        if (!empty($_FILES['post_img']['name'])) {
            // New image uploaded
            $post_img = $_FILES['post_img']['name'];
            $path = "record_images/post_images/";
            $path_img_ext = pathinfo($post_img, PATHINFO_EXTENSION);
            $imgfile_name = $post_id . "_" . time() . '.' . $path_img_ext;
            move_uploaded_file($_FILES['post_img']['tmp_name'], $path . $imgfile_name);
            
        } else {
            // No new image uploaded, retain the existing one
            $imgfile_name = $init_img;

            $query = "SELECT post_img FROM news_update WHERE post_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("i", $post_id);
            if($stmt->execute()){
                $imgres = $stmt->get_result();
                $qrow = $imgres->fetch_assoc(); // Adjusted fetch method
                $imgfile_name = $qrow['post_img'];
            }
        }
        
        $query = "UPDATE news_update SET title=?, post_url=?, caption=?, post_img=?, record_status = ? WHERE post_id = ?";
        // 
        $stmt = $con->prepare($query);
        $stmt->bind_param("sssssi", $post_title, $post_url, $post_caption, $imgfile_name, $post_recstat, $post_id);

        if ($stmt->execute()) {
            header("Location: view_news.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

    } else if($isEdit === "0") {
        $post_id = TableRowCount("news_update",$con)+1;
        $admin_id = $_SESSION['admin_id'];

        $post_img = $_FILES['post_img']['name'];
        $path = "record_images/post_images/";
        $post_img_ext = pathinfo($post_img,PATHINFO_EXTENSION);
        $imgfile_name = $post_id."_".time(). '.' . $post_img_ext;
        move_uploaded_file($_FILES['post_img']['tmp_name'], $path . $imgfile_name);


        $query = "INSERT INTO news_update(post_id,title,caption,post_img,post_url,admin_id,date_webposted,record_status)
        VALUES(?,?,?,?,?,?, NOW() ,'Active');";


        //INSERT QUERY NOT UPDATED YET

        $stmt = $con->prepare($query);
        $stmt->bind_param("issssi", $post_id,$post_title,$post_caption,$imgfile_name, $post_url, $admin_id);

        if ($stmt->execute()) {
            header("Location: view_news.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }


    } else {
        echo "Invalid action.";
    } 

} else if (isset($_POST['post-cancel-btn'])){
    header("Location: view_news.php");
}

//THIS IS FOR CONFIRMING AND INSERTING / UPDAITNG USER INFORMATION RECORD



else if(isset($_POST['ui-confirm-btn'])){   //FOR NEWS AND UPDATE PROCESSING
    $isEdit = $_POST['ui-confirm-btn'];
    $post_title = $_POST['post_title'];
    $post_caption = $_POST['post_caption'];
    $post_url = $_POST['post_url']; 
    
    
    if($isEdit === "1"){
        $post_id = $_POST['post_id'];
        $post_recstat = $_POST['recstat'];
        $init_img = $_POST['init_img'];


        if (!empty($_FILES['post_img']['name'])) {
            // New image uploaded
            $post_img = $_FILES['post_img']['name'];
            $path = "record_images/post_images/";
            $path_img_ext = pathinfo($post_img, PATHINFO_EXTENSION);
            $imgfile_name = $post_id . "_" . time() . '.' . $path_img_ext;
            move_uploaded_file($_FILES['post_img']['tmp_name'], $path . $imgfile_name);
            
        } else {
            // No new image uploaded, retain the existing one
            $imgfile_name = $init_img;

            $query = "SELECT post_img FROM news_update WHERE post_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("i", $post_id);
            if($stmt->execute()){
                $imgres = $stmt->get_result();
                $qrow = $imgres->fetch_assoc(); // Adjusted fetch method
                $imgfile_name = $qrow['post_img'];
            }
        }
        
        $query = "UPDATE news_update SET title=?, post_url=?, caption=?, post_img=?, record_status = ? WHERE post_id = ?";
        // 
        $stmt = $con->prepare($query);
        $stmt->bind_param("sssssi", $post_title, $post_url, $post_caption, $imgfile_name, $post_recstat, $post_id);

        if ($stmt->execute()) {
            header("Location: view_account.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

    } else if($isEdit === "0") {
        $post_id = TableRowCount("news_update",$con)+1;
        $admin_id = $_SESSION['admin_id'];

        $post_img = $_FILES['post_img']['name'];
        $path = "record_images/post_images/";
        $post_img_ext = pathinfo($post_img,PATHINFO_EXTENSION);
        $imgfile_name = $post_id."_".time(). '.' . $post_img_ext;
        move_uploaded_file($_FILES['post_img']['tmp_name'], $path . $imgfile_name);


        $query = "INSERT INTO news_update(post_id,title,caption,post_img,post_url,admin_id,date_webposted,record_status)
        VALUES(?,?,?,?,?,?, NOW() ,'Active');";


        //INSERT QUERY NOT UPDATED YET

        $stmt = $con->prepare($query);
        $stmt->bind_param("issssi", $post_id,$post_title,$post_caption,$imgfile_name, $post_url, $admin_id);

        if ($stmt->execute()) {
            header("Location: view_account.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }


    } else {
        echo "Invalid action.";
    } 

} else if (isset($_POST['post-cancel-btn'])){
    header("Location: view_news.php");
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

