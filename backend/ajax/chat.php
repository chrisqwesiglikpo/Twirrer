<?php

require_once('../init.php');
$loadFromUser->preventAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
if(is_post_request()){
  
    if(isset($_POST['profileid']) && !empty($_POST['profileid'])){
       $profileIds=$_POST['profileid'];
       $userId=h($_POST['userId']);
       $chatName=h($_POST['chatName']);
       $lastInsertedId=$loadFromUser->create("chats",['isGroupChat'=>true,'chatFrom'=>$userId,'chatTo'=>$profileIds,'chatTitle'=>$chatName]);
      echo $lastInsertedId;
    } 
    
    // if(isset($_POST['profileId']) && !empty($_POST['profileId'])){
    //     $profileIds=json_decode($_POST['profileId']);
    //     $userId=h($_POST['userId']);
    //     $chatName=h($_POST['chatName']);

    //     if(!empty($profileIds)){
    //        foreach($profileIds as $profileId){
    //            $lastInsertedId=$loadFromUser->create("chats",['isGroupChat'=>false,'chatFrom'=>$userId,'chatTo'=>$profileId,'chatTitle'=>$chatName]);
    //        }
    //        echo $lastInsertedId;
    //    }
        
    //  }  
    
}