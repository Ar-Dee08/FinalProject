<?php

//USE WHEN THERE'S A HEADER ISSUE
include 'includes/header.php';
include 'admin_middleware.php';
require "../vscode/dbcon.php";
if($sesh_ad_priv === 2) {
    unset($_SESSION['isPriv']);
}

if (!isset($_SESSION['isPriv'])) { //CHECK IF USER IS ADMIN, will be updated
    header("Location: ../adminside/homeadmin.php?error=You can't access that page.");
    // echo "ayaw";
    exit();
} else {
    
?>

<!-- CONTENT -->

<div class="logo-bg-2"></div>
<div class="admin-container">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <h2 style="font-family: 'Inter', sans-serif; font-size: 40px; font-weight: bold;">
                    User Detail Records
                </h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered custom-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Full Name</th>
                                <th>Student Number</th>
                                <th>Email</th>
                                <th>Membership Status</th>
                                <th>Customer Type</th>
                                <th>User Verification Status</th>
                                <th>Date Created</th>
                                <th>Account Status</th>                                
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
                                $records = RetrieveAll("user_information", $con, $start, $limit);

                                if (mysqli_num_rows($records) > 0) {
                                    foreach ($records as $item) :
                            ?>
                                        <tr>
                                            <td ><?=$item['userinfo_id']?> </td>
                                            <td ><?=$item['user_fullname']?> </td>
                                            <td><?=$item['student_number']?> </td>
                                            <td><?=$item['email']?> </td>
                                            <td><?=$item['memstatus']?> </td>
                                            <td><?=$item['customer_type']?> </td>
                                            <td><?=$item['type_verification_stat']?> </td>
                                            <td><?=$item['account_created']?> </td>
                                            <td class="item-txt"><?=$item['account_status']?> </td>
                                            <td>
                                                <div class="col-md-15 ms-auto me-auto" style="text-align:center">
                                                    <form action="mod_userinfo.php?uiidlabel=<?=$item['userinfo_id']?>" method="post">
                                                    
                                                            <button type="submit" name="ui-edit-btn">Edit Records</button>

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
                        <div class="btn-user">
                            <div class="col-md-4 ms-auto">
                                <form action="mod_userinfo.php?uiidlabel?=0" method="post">
                                    <button type="submit" name="ui-add-btn">Add New Account</button>

                                </form>                            
                            </div>
                            <br>
                            <div class="col-md-4 ms-auto">
                                <form action="view_userinfo.php?=0" method="post">
                                    <button type="submit" name="ui-add-btn">Go to User Information</button>
                                </form>
                            </div>
                            
                        </div>

                    </div>


                </div>


<!-- END OF CONTENTS -->
</div>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>




<?php
include 'includes/footer.php';
                                }
function RetrieveAll($table, $con, $start, $limit)
{
    
    $query = " SELECT 
        ui.userinfo_id,
        CONCAT(ui.firstname, ' ', ui.lastname) as user_fullname,
        ui.student_number,
        ui.email,
        uc.password,
        ms.memstatus,
        ct.customer_type,
        ctv.type_verification_stat,
        ui.account_created,
        ui.account_status
        FROM user_information ui
        LEFT JOIN user_credentials uc ON ui.userinfo_id = uc.userinfo_id
        LEFT JOIN mem_status ms ON ui.memstatus_id = ms.memstatus_id
        LEFT JOIN customertype ct ON ui.customertype_id = ct.customertype_id
        LEFT JOIN customertype_verification ctv ON ui.custype_verif_id = ctv.custype_verif_id
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
    $totalQuery = "SELECT COUNT(*) as total FROM user_information";
    $totalResult = mysqli_fetch_assoc(mysqli_query($con, $totalQuery));
    $total = $totalResult['total'];

    // Calculate total pages
    $totalPages = ceil($total / $limit);

    return [$limit, $totalPages];
}


?>

