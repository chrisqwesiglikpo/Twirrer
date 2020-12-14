<?php
 require_once('../init.php');
 $loadFromUser->preventAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
 if(is_post_request()){
    if(isset($_POST['post_id']) && !empty($_POST['post_id'])){
        $postId=(int)h($_POST['post_id']);
      echo  $loadFromUser->getUsernameById($postId);
      
   }

   if(isset($_POST['postedBy']) && !empty($_POST['postedBy'])){
    $postId=(int)h($_POST['postedBy']);
    echo  $loadFromUser->getUsernameById($postId);

  }


 }