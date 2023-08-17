<?php

session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 0){
    echo "<script>window.location.href='../../landlord-login.php';</script>";
    exit();
}
