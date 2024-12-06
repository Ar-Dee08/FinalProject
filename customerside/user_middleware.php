<?php
if (!isset($_SESSION['uid'])) { //CHECK IF USER IS ADMIN, will be updated
    $_SESSION['message'] = "Login to continue";
    header("Location: index.php?error=Login to continue.");
}