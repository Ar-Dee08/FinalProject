<?php
include 'includes/header.php';
include 'admin_middleware.php';
include '../vscode/dbcon.php';


if(isset($_POST['tr-edit-btn'])){ //IF EDITING RECORD
    if (isset($_GET['tridlabel'])) {
        $tr_id = $_GET['tridlabel'];

        $getnamequery = "SELECT * FROM  transactions tr
            LEFT JOIN items i ON tr.item_id = i.item_id
            LEFT JOIN user_information ui ON tr.userinfo_id = ui.userinfo_id
            LEFT JOIN transactionstatus trs ON tr.transaction_status_id = trs.transaction_status
            WHERE tr.transaction_id = ?";
        $stmt = $con->prepare($getnamequery);
        $stmt->bind_param("i", $tr_id);

if ($stmt->execute()) {
    $results = $stmt->get_result(); 
    $tr_row = mysqli_fetch_assoc($results);            

        $tr_full = $tr_row['firstname'] . ' ' . $tr_row['lastname'];
        $tr_uid = $tr_row['userinfo_id'];
        $tr_item = $tr_row['item_name'];
        $tr_q = $tr_row['quantity'];
        $tr_total = $tr_row['totalamount'];
        $tr_payment = $tr_row['payment_method'];
        $tr_stat = $tr_row['transaction_status'];
        $isEdit = True;
        } else {
            echo "Error executing query: " . $stmt->error;
        }

    }                                     
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
                        Transaction Status Updates
                    </h2>
                </div>
                <div class="card-body">
                    <form action="admin_proc.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="tr_id" value="<?= $tr_id; ?>"> <!-- Pass the category ID -->
                                <?php
                                    // IF EDIT RECORD
                                    if($isEdit){?> 
                                        <h1>
                                        Transaction #<?=$tr_id?> : 
                                        </h1>
                                        <label for="">
                                            User : 
                                        </label>
                                        <input type="text" value="<?=htmlspecialchars($tr_id)?>" disabled name="tr_full" placeholder="User">  
                                        <br>
                                        <label for="">
                                            Ordered Item
                                        </label>
                                        <input type="text" value="<?= $tr_item ?>" disabled name="tr_item" placeholder="Ordered Item" required>  
                                        <br>
                                        <label for="">
                                            Quantity : 
                                        </label>
                                        <input type="text" value="<?= $tr_q ?>" disabled name="tr_q" placeholder="Item Quantity" required>  
                                        <br>
                                        <label for="">
                                            Total Amount Price : 
                                        </label>
                                        <input type="text" value="<?= $tr_total ?>" disabled name="tr_total" placeholder="Total Amount Price" required>  
                                        <br>
                                        <label for="">
                                            Payment Method
                                        </label>
                                        <input type="text" value="<?= $tr_payment ?>" disabled name="tr_payment" placeholder="Payment Method"  required>  
                                        <br>
                                        <br>
                                        <br>
                                <label for="tr_stat">Transaction Status:</label>
                                <br>
                                <select class="admin-sel" name="tr_stat">
                                    <?php
                                    $catquery = "SELECT * FROM transactionstatus";
                                    $result = mysqli_query($con, $catquery);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {

                                            if($isEdit){
                                                $selected = ($row['transaction_status_id'] == $tr_stat) ? 'selected' : '';
                                                echo '<option value="' . $row['transaction_status_id'] . '" ' . $selected . '>' . htmlspecialchars($row['transaction_status']) . '</option>';

                                            } else {
                                                echo '<option value="' . $row['transaction_status_id'] . '">' . htmlspecialchars($row['transaction_status']) . '</option>';

                                            }

                                        }
                                    } else {
                                        echo '<option value="0">Status not set</option>';
                                    }
                                    ?>
                                </select>

                                <br>
                                        <br>
                                     <?php   
                                    }                                                                        
                                       ?>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="admin-label">
                                    Transaction ID : <?=$tr_id?>
                                </label>            
                                <br>
                                <label for="" class="admin-label">
                                    User ID : <?=$tr_uid?>
                                </label>        
                                <br>

                                                               
                            </div>
                            <div>
                                <br>
                                <button type="submit" name="tr-confirm-btn">Confirm</button>
                                <button type="submit" name="tr-cancel-btn" formnovalidate>Cancel</button>
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