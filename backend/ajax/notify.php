<?php

require_once('../init.php');
$loadFromUser->preventAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
if(is_post_request()){
  
    if(isset($_POST['notificationUpdate']) && !empty($_POST['notificationUpdate'])){
      $userid=h($_POST['notificationUpdate']);
      $notification=$loadFromPost->notificationCount($userid);
      echo count((array)$notification);
    }
    
    if(isset($_POST['notify']) && !empty($_POST['notify'])){
        $userid=h($_POST['notify']);
        $loadFromPost->notificationCountReset($userid);
        
     }

     if(isset($_POST['statusUpdate']) && !empty($_POST['statusUpdate'])){
        $userid=h($_POST['statusUpdate']);
        $profileid=h($_POST['profileid']);
        $postid=h($_POST['postid']);
        $loadFromPost->notificationStatusUpdate($userid,$postid,$profileid);
        
     }
}

?>