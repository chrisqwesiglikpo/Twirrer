<?php
include 'backend/init.php';
// 
if(isset($_SESSION['userLoggedIn'])){
    log_out_user();
    redirect_to(url_for("index.php"));
}