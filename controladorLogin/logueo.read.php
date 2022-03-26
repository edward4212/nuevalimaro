<?php
session_start();
 if(!$_SESSION){
    session_unset();
    session_destroy();
    echo "<script> window.location.href = '../login/login.php'</script>";
   } 
 ?> 