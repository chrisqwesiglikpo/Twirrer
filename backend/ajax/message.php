<?php

require_once('../init.php');
$loadFromUser->preventAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
if(is_post_request()){
  
    if(isset($_POST['msg']) && !empty($_POST['msg'])){
       $profileIds=$_POST['profileid'];
       $userId=h($_POST['userId']);
       $chatId=h($_POST['chatId']);
        echo $_POST['msg'];
       //$chatName=h($_POST['chatName']);
      // $lastInsertedId=$loadFromUser->create("chats",['isGroupChat'=>true,'chatFrom'=>$userId,'chatTo'=>$profileIds,'chatTitle'=>$chatName]);
     // echo $lastInsertedId;
    } 


}