<?php
// session_start();
include 'includes/header.php';
include 'user_middleware.php';
include '../vscode/dbcon.php';
?>

<body class="logo-bg-2">
    <div class="product-container">
        <div class="home-txt">

            <div>
                div container
                <div>
                    Header
                </div>
                <div class="display-cont">
                    cont body
                    <ul>
                        <li>
                            <a href="">
                                
                                <div class="display-item" >
                                    <div>
                                        IMAGE
                                    </div>
                                    <div>
                                        item name
                                    </div>
                                </div>

                            </a>
                        </li>
                        <li>
                            <a href="">
                                <div class="display-item" >
                                    <div>
                                        IMAGE
                                    </div>
                                    <div>
                                        item name
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <div class="display-item" >
                                    <div>
                                        IMAGE
                                    </div>
                                    <div>
                                        item name
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    end of cont body
                </div>
                    
            </div>

        <div>
    </div>
</div>
<style>
    .display-cont li {
        display: inline-block;
    }

    .display-item{
        display: block;
        background-color: red;
    }
</style>    
<div class="footer-footer">
    <?php
        include 'includes/footer.php';
    ?>
</div>