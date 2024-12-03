<?php
session_start();

if (isset($_SESSION['uid']) && isset($_SESSION['admin_id'])) { //CHECK IF USER IS ADMIN, will be updated

    include('includes/header.php');
    ?>

<h1>HOME</h1>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


<?php

include('includes/footer.php');

} else {
    header("Location: index.php");
    exit();
}

?>
>>>>>>> 631ae2ed956d2a0753d31da3383ad4d066ab4e2f:adminside/homeadmin.php
