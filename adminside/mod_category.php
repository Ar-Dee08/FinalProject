<?php
session_start();
include 'admin_middleware.php';
include 'includes/header.php';
include '../vscode/dbcon.php';


if(isset($_POST['cat-edit-btn'])){ //IF EDITING RECORD
    if (isset($_GET['catidlabel'])) {
        $catid = $_GET['catidlabel'];
        $isEdit = True;

    }                                     
} else if (isset($_POST['cat-add-btn'])){ //IF NEW RECORD
    $catid = TableRowCount("categories",$con)+1;
    $isEdit = False;

}

?>

<!-- CONTENTS -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>
                    Modify Category
                </h2>
            </div>
            <div class="card-body">
                <form action="proc_category.php" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            
                            <?php
                                if($isEdit){?>
                                    <label for="">
                                        Current Category Name
                                    </label>
                                    <input type="text" disabled value=$cat_name name="catname" placeholder="Enter Category Name" class="form-control" required>
                                    <label for="">
                                        New Category Name
                                    </label>
                                    <input type="text" name="catname" placeholder="Enter Category Name" class="form-control" required>
                                    
                                    <?php
                                }else {?>
                                    <label for="">
                                        Category Name
                                    </label>
                                    <input type="text" name="catname" placeholder="Enter Category Name" class="form-control" required>                                
                                    <?php
                                }
                            ?>
                        </div>
                        <div class="col-md-1">
                            <label for="">
                                ID
                            </label>                            
                            <?php                                
                                echo '<p style="color: #CEDFE3;" class="cat-label" align="center">' . $catid . '</p>';
                                       
                            ?>                            
                        </div>
                        <div>
                            <br>
                            <button type="submit" value="<?= $isEdit ? '1' : '0'; ?>" name="cat-confirm-btn">Confirm</button>
                            <button type="submit" name="cancel-btn" formnovalidate>Cancel</button>
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
</body>

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