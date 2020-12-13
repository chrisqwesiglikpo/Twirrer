<?php
 require_once('../init.php');
 $loadFromUser->preventAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
 if(is_post_request()){
    if(isset($_POST['postId']) && !empty($_POST['postId'])){
        $postId=h($_POST['postId']);
        $userId=h($_POST['userId']);
    
        echo $loadFromPost->Likes($userId,$postId);
    }
   
 }
?>