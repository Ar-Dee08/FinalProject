<?php
// session_start();
include 'includes/header.php';
include 'admin_middleware.php';
include '../vscode/dbcon.php';


if(isset($_POST['ad-edit-btn'])){ //IF EDITING RECORD
    if (isset($_GET['adidlabel'])) {
        $admin_id = $_GET['adidlabel'];

        $getnamequery = "SELECT * FROM admin a
LEFT JOIN user_information ui ON a.admin_id = ui.userinfo_id WHERE a.admin_id = ?";
        $stmt = $con->prepare($getnamequery);
        $stmt->bind_param("s",$admin_id);
        if ($stmt->execute()) {
            $results = $stmt->get_result(); // Always return the result object        
            $ad_row = mysqli_fetch_assoc($results);      
            $ad_full = $ad_row['firstname'] . ' ' . $ad_row['lastname'];
            $ad_uid = $ad_row['userinfo_id'];
            $ad_su = $ad_row['student_number'];
            $ad_email = $ad_row['email'];
            $ad_priv = $ad_row['user_privilege'];
            $ad_date = $ad_row['granting_date'];
            $ad_stat = $ad_row['admin_status'];
            $ad_contact = $ad_row['contact_number'];


        } else {
            echo "Error: " . $stmt->error;
        }
        $isEdit = True;

    }                                     
} else if (isset($_POST['ad-add-btn'])){ //IF NEW RECORD
    $admin_id = TableRowCount("admin",$con)+1;
    $isEdit = False;
    $ad_priv = 'Unauthorized';

}

?>

<!-- CONTENTS -->
<div class="logo-bg-2"></div>
<div class="admin-container">

    <div class="row admin-mod-text">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <h2 style="font-family: 'Inter', sans-serif; font-size: 40px; font-weight: bold;">
                        Admin Information Records
                    </h2>
                </div>
                <div class="card-body">
                    <form action="admin_proc.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="admin_id" value="<?= $admin_id; ?>"> <!-- Pass the category ID -->
                                <?php
                                    // IF EDIT RECORD
                                    if($isEdit){?> 
                                        <label for="">
                                            Current User : 
                                        </label>
                                        <input type="text" value="<?= $ad_full ?>" disabled name="ad_full" placeholder="Enter First Name" class="form-control" required>  
                                        <br>
                                        <label for="">
                                            User Email : 
                                        </label>
                                        <input type="text" value="<?= $ad_email ?>" disabled name="ad_email" placeholder="Enter First Name" class="form-control" required>  
                                        <br>
                                        <label for="">
                                            User Contact Number : 
                                        </label>
                                        <input type="text" value="<?= $ad_contact ?>" disabled name="ad_contact" placeholder="Enter First Name" class="form-control" required>  
                                        <br>
                                        <label for="">
                                            User Student Number : 
                                        </label>
                                        <input type="text" value="<?= $ad_su ?>" disabled name="ad_su" placeholder="Enter First Name" class="form-control" required>  
                                        <br>
                                        <label for="">
                                            Current User Database Access : 
                                        </label>
                                        <input type="text" value="<?= $ad_priv ?>" disabled name="ad_priv" placeholder="User Database Privilege" class="form-control" required>  
                                        
                                        <?php
                                            if (isset($_GET['error'])) {
                                                echo '<p class="error-login">' . $_GET['error'] . '</p>';
                                            }            
                                        ?>
                                         <?php
                                    } else {  //ADDING USER
                                        ?>
                                        <h1>Grant Administrator Privileges</h1>
                                        <label for="">
                                            Enter User ID : 
                                        </label>
                                        <input type="text" name="ad_uid" placeholder="Enter User ID" class="form-control" required>  
                                        <br>
                                        <br>
                                       
                                        <p>Not sure? You can check the user information.</p>
                                        <button type="submit" name="ad-userinfo-btn" formnovalidate>Check User Information</button>

                                     <?php   
                                    }                                    
                                    ?>
                                        <br>
                                        <br>

                                        <label for="">
                                            User Database Access
                                        </label>
                                        <br>
                                        <select class="admin-sel" name="ad_priv" id="recstat">
                                            <?php
                                                if($ad_priv == "Authorized"){
                                                    ?>
                                                        <option value="Authorized">Authorize</option>
                                                        <option value="Unauthorized">Unauthorize</option>
                                                    <?php
                                                } else {
                                                    ?>
                                                        <option value="Unauthorized">Unauthorize</option>
                                                        <option value="Authorized">Authorize</option>
                                                    <?php
                                                }
                                            ?>                                    
                                        </select>
                                        <br>
                                       <?php 
                                       
                                       if($isEdit){ //ADDING USER
                                       ?>



                                        <br>
                                        <br>
                                        <br>
                                        
                                        <label for="">
                                            Administrator Status
                                        </label>
                                        <br>
                                        <select class="admin-sel" name="recstat" id="recstat">
                                            <?php
                                                if($ad_stat == "Active"){
                                                    ?>
                                                        <option value="Active">Active</option>
                                                        <option value="Removed">Remove</option>
                                                    <?php
                                                } else {
                                                    ?>
                                                        <option value="Removed">Remove</option>
                                                        <option value="Active">Active</option>
                                                    <?php
                                                }
                                            ?>                                    
                                        </select>
                                        <br>
                                        <br>

                                        <?php
                                    }?>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="admin-label">
                                    Admin ID : <?=$admin_id?>
                                </label>        
                                <br>

                                    <?php 
                                    if($isEdit){
                                        ?>
                                        <label for="" class="userinfo-label">
                                            User ID : <?=$ad_uid?>
                                        </label>  
                                        <br> 
                                        <?php
                                    }                                    
                                    ?>

                                                               
                            </div>
                            <div>
                                <br>
                                <button type="submit" value="<?= $isEdit ? '1' : '0'; ?>" name="ad-confirm-btn">Confirm</button>
                                <button type="submit" name="ad-cancel-btn" formnovalidate>Cancel</button>
                            </div>
                        </div>
                    </form>                
                </div>
            </div>
        </div>
    </div>



<!-- END OF CONTENTS -->
</div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="reg.js" type="text/javascript"></script>
</body>
<footer>
<?php
include 'includes/footer.php';

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


?>