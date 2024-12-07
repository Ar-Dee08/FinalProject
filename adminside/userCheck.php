<?php

    // 0 == NOT ADMIN
    // 1 == AUTHORIZED
    // 2 == UNAUTHORIZED
        // $_SESSION[''];
    // echo  $_SESSION['admin_id'];  

        $query = "SELECT * FROM admin WHERE admin_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $_SESSION['admin_id']);
        $stmt->execute();
            $imgres = $stmt->get_result();
            $qrow = $imgres->fetch_assoc(); // Adjusted fetch method
            // echo $_SESSION['admin_id'];
            $test_ad_priv = $qrow['user_privilege'];            
        
        if($test_ad_priv == 'Authorized'){                
            $sesh_ad_priv = 1;
            // $_SESSION['sesh_ad_priv'] = 1;
        } else if ($test_ad_priv == 'Unauthorized'){
            // $_SESSION['sesh_ad_priv'] = 2;
            $sesh_ad_priv = 2;
        } else {
            $sesh_ad_priv = 0;
            // $_SESSION['sesh_ad_priv'] = 0;

        }
        
?>