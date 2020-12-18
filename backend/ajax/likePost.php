<?php
 require_once('../init.php');
 $loadFromUser->preventAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
 if(is_post_request()){
    if(isset($_POST['postId']) && !empty($_POST['postId'])){
        $postId=h($_POST['postId']);
        $userId=h($_POST['userId']);
        $postedBy=h($_POST['postedBy']);
        $loadFromUser->create('notification',array('notificationFrom'=>$userId, 'notificationFor' =>$postedBy, 'postid' => $postId, 'type'=>'like', 'status'=> '0', 'notificationCount'=>'0'));
        echo $loadFromPost->Likes($userId,$postId);
        
 
    }
   
 }
?>