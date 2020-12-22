<?php

if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__)==realpath($_SERVER['SCRIPT_FILENAME'])){
  header('Location:http://localhost/twirrer/index.php');
}
function url_for($script_path){
    if($script_path[0] !='/'){
        $script_path ="/".$script_path;
    }

    return BASE_URL.$script_path;
}

function u($string=""){
    return urlencode($string);
}

function raw_u($string=""){
    return rawurlencode($string);
}
// session_regenerate_id()
function h($string=""){
    return htmlspecialchars($string);
}

function redirect_to($location){
    header("Location:http://localhost/twirrer/".$location);
    exit;
}
function lyn_copyright($startYear){
   $currentYear=date('Y');
   if($startYear < $currentYear){
       $currentYear=date('y');
       return "&copy; $startYear&ndash;$currentYear";
   }else{
    return "&copy; $startYear";
   }
}
function log_out_user(){
    unset($_SESSION['userLoggedIn']);
    session_destroy();
    return true;
}

function is_post_request(){
    return $_SERVER['REQUEST_METHOD']=='POST';
}

function is_get_request(){
    return $_SERVER['REQUEST_METHOD']=='GET';
}
function getInputValue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}
?>