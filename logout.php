<?php
include 'backend/init.php';
// 
if(login::isLoggedIn()){
    $userid = login::isLoggedIn();
}else if(isset($_SESSION['userLoggedIn'])){
    log_out_user();
    redirect_to(url_for("index.php"));
}else{
    redirect_to(url_for("index.php"));
}

$loadFromUser->delete('token', array('user_id'=>$userid));

if(isset($_COOKIE['FBID'])){
    unset($_COOKIE['FBID']);
    header('Refresh:0');
}
