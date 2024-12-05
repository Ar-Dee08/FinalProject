<?php
session_start();
include 'admin_middleware.php';
include 'includes/header.php';
require "../vscode/dbcon.php";

?>

<!-- CONTENT -->
<div class="logo-bg-2"></div>
<div class="admin-container">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>
                        News and Updates Records
                    </h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered custom-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Post Title</th>
                                <th>Post Image</th>
                                <th>Post Caption</th>
                                <th>Post URL</th>
                                <th>Date Created</th>
                                <th>Creator Admin ID</th>
                                <th>Record Status</th>
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
                                $newsrecords = RetrieveAll("news_update", $con, $start, $limit);

                                if (mysqli_num_rows($newsrecords) > 0) {
                                    foreach ($newsrecords as $item) :
                            ?>
                                        <tr>
                                            <td class="custom-table"><?=$item['post_id']?> </td>
                                            <td class="custom-table"><?=$item['title']?> </td>

                                            <td class="custom-table"> 
                                                <img  src="record_images/post_images/<?=$item['post_img'];?>" alt="item">
                                            
                                            
                                            </td>
                                            <td><?=$item['caption']?> </td>
                                            <td>
                                                <a href="<?=$item['post_url']?>"><?=$item['post_url']?></a>
                                            </td>
                                            <td><?=$item['date_webposted']?> </td>
                                            <td><?=$item['admin_creator']?> </td>
                                            <td class="item-txt"><?=$item['record_status']?> </td>
                                            <td>
                                                <div class="col-md-15 ms-auto me-auto" style="text-align:center">
                                                    <form action="mod_news.php?postidlabel=<?=$item['post_id']?>" method="post">
                                                        <button type="submit" name="post-edit-btn">Edit Records</button>
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
                            <form action="mod_news.php?postidlabel?=0" method="post">
                                <button type="submit" name="post-add-btn">Add New Item</button>

                            </form>
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

function RetrieveAll($table, $con, $start, $limit)
{
    
    $query = "SELECT 
                np.post_id,
                np.title,
                np.post_img,
                np.caption,
                np.post_url,
                np.date_webposted, 
                CONCAT('admin', np.admin_id, ' : ', us.firstname) AS admin_creator, 
                np.record_status 
              FROM news_update np 
              LEFT JOIN admin a ON np.admin_id = a.admin_id 
              LEFT JOIN user_information us ON a.userinfo_id = us.userinfo_id
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
    $totalQuery = "SELECT COUNT(*) as total FROM items";
    $totalResult = mysqli_fetch_assoc(mysqli_query($con, $totalQuery));
    $total = $totalResult['total'];

    // Calculate total pages
    $totalPages = ceil($total / $limit);

    return [$limit, $totalPages];
}


?>

