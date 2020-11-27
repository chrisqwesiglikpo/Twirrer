<?php
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

function h($string=""){
    return htmlspecialchars($string);
}

function redirect_to($location){
    header("Location: ".$location);
    exit;
}

function is_post_request(){
    return $_SERVER['REQUEST_METHOD']=='POST';
}

function is_get_request(){
    return $_SERVER['REQUEST_METHOD']=='GET';
}
?>