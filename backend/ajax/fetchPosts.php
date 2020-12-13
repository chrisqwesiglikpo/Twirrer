<?php 
   require_once('../init.php');
   if(is_post_request()){
      if(isset($_POST['fetchPosts']) && !empty($_POST['fetchPosts'])){
         $userId=$_POST['userid'];
         $limit=(int)trim($_POST['fetchPosts']);
         $loadFromPost->posts($userId,$limit);
      }
}

  
?>