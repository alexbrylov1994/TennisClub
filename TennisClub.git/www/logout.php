<?php

    if (session_status() == PHP_SESSION_NONE) 
        session_start() ;
    
    unset($_SESSION["membername"]);  
    unset($_SESSION["memberid"]);  
    unset($_SESSION["employeename"]);  
    unset($_SESSION["employeeid"]);  
    session_destroy();
    header("Location: /Tennis/index.php");
?>

