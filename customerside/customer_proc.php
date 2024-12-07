<?php

if(isset($_POST['item-cart-btn'])){
    $quanit = $_POST['quantity'];

    



    echo 'HELLO CART' . $_SESSION['uid'];





} else if(isset($_POST['item-order-btn'])) {
    echo 'HELLO ORDER NOW';





}


?>