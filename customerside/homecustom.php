<?php
session_start();

if (isset($_SESSION['uid'])) { //CHECK IF USER IS ADMIN, will be updated
    echo 'home customer';
    ?>

<!-- SPACE FOR HTML -->




<?php
} else {
    header("Location: ../adminside/index.php");
    exit();
}

?>