<?php

session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 3){
    echo "<script>window.location.href='../login.php';</script>";
    exit();
}
