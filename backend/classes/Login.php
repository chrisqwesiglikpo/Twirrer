<?php
class Login{
    public static function isLoggedIn(){
        if(isset($_COOKIE['FBID']) || isset($_SESSION['userLoggedIn'])){
           return true;
        }else{
            return false;
        }
    }
}

?>