<?php
session_start();

if (isset($_SESSION['signedin_pass']) && isset($_SESSION['signedin_email'])) { //CHECK IF USER IS ADMIN, will be updated
    echo 'home customer';
    ?>

<!-- SPACE FOR HTML -->




<?php
} else {
    header("Location: index.php");
    exit();
}

?>