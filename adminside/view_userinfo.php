<?php
session_start();
include 'admin_middleware.php';
include 'includes/header.php';
require "../vscode/dbcon.php";

?>

<!-- CONTENT -->

<div class="admin-container">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>
                        User Information Records
                    </h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered custom-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Full Name</th>
                                <th>Student Number</th>
                                <th>Sex</th>
                                <th>Birthdate</th>
                                <th>Contact #</th>
                                <th>Email</th>
                                <th>Account Status</th>
                                <!-- <th>Membership Status</th>
                                <th>Customer Type</th>
                                <th>User Verification Status</th>
                                <th>Date Created</th>
                                <th>Creator Admin ID</th>
                                <th>Record Status</th> -->
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
                                            <td><?=$item['sex']?> </td>
                                            <td><?=$item['bday']?> </td>
                                            <td><?=$item['contact_number']?> </td>
                                            <td><?=$item['email']?> </td>
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
                        <div class="col-md-4 ms-auto">
                            <form action="mod_userinfo.php?uiidlabel?=0" method="post">
                                <button type="submit" name="ui-add-btn">Add New Account</button>

                            </form>
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

function RetrieveAll($table, $con, $start, $limit)
{
    
    $query = "SELECT userinfo_id, CONCAT(firstname, ' ',lastname) AS user_fullname, student_number, sex, bday, contact_number, email, account_status FROM user_information LIMIT ?, ?;"; // Use LIMIT with placeholders for pagination

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

