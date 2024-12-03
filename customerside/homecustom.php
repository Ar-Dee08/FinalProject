<?php
session_start();

if (isset($_SESSION['uid'])) { //CHECK IF USER IS ADMIN, will be updated
    echo '<h1>home customer</h1>';
    ?>

<!-- SPACE FOR HTML -->



<?php
} else {
    header("Location: ../adminside/index.php");
    exit();
}

?>