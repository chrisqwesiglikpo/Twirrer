<?php
include 'backend/init.php';
// 
if(isset($_SESSION['userLoggedIn'])){
    session_destroy();
    unset($_SESSION['userLoggedIn']);
    redirect_to(url_for("index.php"));
}