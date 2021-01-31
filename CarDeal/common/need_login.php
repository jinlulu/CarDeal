<?php
include_once __DIR__.'/init.php';

if(!check_login()){
    echo "<script>alert('Please login first!'); window.history.go(-1);</script>";
    exit();
}

