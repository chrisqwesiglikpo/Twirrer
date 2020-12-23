<?php

require_once('../init.php');
$loadFromUser->preventAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
if(is_post_request()){
  
    if(isset($_POST['msg']) && !empty($_POST['msg'])){
        $profileIds=json_decode($_POST['profileid']);
        $userId=h($_POST['userId']);
        $chatId=h($_POST['chatId']);
        $msg=h($_POST['msg']);
        if(!empty($profileIds)){
                 foreach($profileIds as $profileId){
                     $profileId=h($profileId);
                     $lastInsertedId=$loadFromUser->create("messages",['message'=>$msg,'messageFrom'=>$userId,'messageTo'=>$profileId,'chatID'=>$chatId]);
                   }
                    echo $msg;
          }
       
    } 


}