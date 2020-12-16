<?php

require_once('../init.php');
$loadFromUser->preventAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
if(is_post_request()){
  
    if(isset($_POST['profileid']) && !empty($_POST['profileid'])){
       $profileIds=json_decode($_POST['profileid']);
       $userId=h($_POST['userId']);
       if(!empty($profileIds)){
           foreach($profileIds as $profileId){
               $lastInsertedId=$loadFromUser->create("chats",['isGroupChat'=>true,'chatFrom'=>$userId,'chatTo'=>$profileId]);
           }
           echo $lastInsertedId;
       }
    }
}