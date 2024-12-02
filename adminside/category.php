<?php
session_start();

if (isset($_SESSION['uid']) && isset($_SESSION['admin_id'])) { //CHECK IF USER IS ADMIN, will be updated

    include 'includes/header.php';
?>



<H1>HIIII CATEGORY</H1>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>


<?php

    include 'includes/footer.php';

} else {
    header("Location: index.php");
    exit();
}

?>