<?php


    include 'includes/header.php';
    include 'admin_middleware.php';

?>

<!-- CONTENT -->

<div class="logo-bg-2"></div>
<div class="admin-container">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <h2 style="font-family: 'Inter', sans-serif; font-size: 40px; font-weight: bold;">
                    Transaction Records
                </h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered custom-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Order ID</th>
                                <th>User ID</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Total Amt</th>
                                <th>User</th> 
                                <!-- authorized / unauthorized -->
                                <th>Payment Method</th>
                                <th>Status</th>                                
                                <th style="text-align : center">Edit</th>
                            </tr>
                        </thead>
                        <tbody class="record-img">
                                <!-- FETCHING DATA -->
                            <?php
                                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $page = max($page, 1); // Ensure page is at least 1
                                [$limit, $totalPages] = pagination($con);
                                $start = ($page - 1) * $limit;
                                
                                // Fetch records for the current page
                                $records = RetrieveAll("admin", $con, $start, $limit);

                                if (mysqli_num_rows($records) > 0) {
                                    foreach ($records as $item) :
                            ?>
                                        <tr>
                                            <td ><?=$item['transaction_id']?> </td>
                                            <td ><?=$item['order_id']?> </td>
                                            <td ><?=$item['userinfo_id']?> </td>
                                            <td><?=$item['item_name']?> </td>
                                            <td><?=$item['quantity']?> </td>
                                            <td><?=$item['item_totalamount']?> </td>
                                            <td><?=$item['user_full']?> </td>
                                            <td><?=$item['payment_method']?> </td>
                                            <td class="item-txt"><?=$item['transaction_status']?> </td>
                                            <td>
                                                <div class="col-md-15 ms-auto me-auto" style="text-align:center">
                                                    <form action="mod_transaction.php?tridlabel=<?=$item['transaction_id']?>" method="post">
                                                        <button type="submit" name="tr-edit-btn">Edit Records</button>
                                                    </form>
                                                </div>                                             
                                            </td>
                                        </tr>

                                    <?php
                                    endforeach;                                                                 
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="15" class="text-center">No records found</td>
                                    </tr>
                                <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <div>
            
                        <nav>
                            <ul class="pagination">
                                <!-- Previous Button -->
                                <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?page=<?= $page - 1; ?>">Previous</a>
                                </li>

                                <!-- Page Numbers -->
                                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                    <li class="page-item <?= ($page === $i) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                                    </li>
                                <?php endfor; ?>

                                <!-- Next Button -->
                                <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?page=<?= $page + 1; ?>">Next</a>
                                </li>
                            </ul>
                        </nav>

                        <!-- TEMPORARY, REMOVE THIS BUTTON AFTER -->
                            <div class="col-md-4 ms-auto">
                                <form action="mod_transaction.php?tridlabel=1" method="post">
                                    <button type="submit" name="tr-edit-btn">Edit</button>
                                </form>
                            </div>
                            <br>
                            <?php 
                            if(isset($_SESSION['isPriv'])){ ?>
                            <div class="col-md-4 ms-auto">
                                <form action="view_userinfo.php" method="post">
                                    <button type="submit" name="tr-userinfo-btn">Go to User Information</button>
                                </form>
                            </div>
                            <?php 
                            } ?>
                            

                    </div>


                </div>


<!-- END OF CONTENTS -->
</div>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>



<footer>
<?php
include 'includes/footer.php';




function RetrieveAll($table, $con, $start, $limit)
{
    
    $query = "SELECT 
	tr.transaction_id,
    ord.order_id,
    tr.userinfo_id,
    i.item_name,
    ord.quantity,
    ord.item_totalamount,
    CONCAT(ui.firstname, ' ', ui.lastname) AS user_full,
    tr.payment_method, trs.transaction_status

 FROM  transactions tr
 LEFT JOIN item_orders ord ON tr.transaction_id = ord.transaction_id
 LEFT JOIN items i ON ord.item_id = i.item_id
 LEFT JOIN user_information ui ON tr.userinfo_id = ui.userinfo_id
 LEFT JOIN transactionstatus trs ON tr.transaction_status_id = trs.transaction_status
        LIMIT ?, ?;"; // Use LIMIT with placeholders for pagination

    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $start, $limit);
    $stmt->execute();
    return $stmt->get_result();
}

function pagination($con)
{
    // Number of rows per page
    $limit = 10;

    // Fetch total number of rows
    $totalQuery = "SELECT COUNT(*) as total FROM transactions";
    $totalResult = mysqli_fetch_assoc(mysqli_query($con, $totalQuery));
    $total = $totalResult['total'];

    // Calculate total pages
    $totalPages = ceil($total / $limit);

    return [$limit, $totalPages];
}


?>

