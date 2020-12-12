<?php
 require_once('../init.php');
 if(isset($_POST['post_id']) && !empty($_POST['post_id'])){
      $userId=h($_POST['postedBy']);
      $postId=(int)h($_POST['post_id']);
      
    $loadFromPost->delete("post",['post_id'=>$postId,'userId'=>$userId]);
 }