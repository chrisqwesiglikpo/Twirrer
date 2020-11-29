<?php

ob_start();
date_default_timezone_set("Africa/Accra");

session_start();



spl_autoload_register(function($class){
    include 'classes/'.$class.'.php';
});

define("DB_HOST", "localhost");
define("DB_NAME", "twitter");
define("DB_USER", "root");
define("DB_PASS", "");
define("BASE_URL", "http://localhost/twirrer");

$account=new Account;
$userObj=new User;

require_once('functions.php');

