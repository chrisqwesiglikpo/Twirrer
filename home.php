<?php
include 'backend/init.php';
// unset($_SESSION['userLoggedIn']);
if(!isset($_SESSION['userLoggedIn'])){
    redirect_to(url_for("index.php"));
}else{
   echo $username=$_SESSION['userLoggedIn'];
}

?>