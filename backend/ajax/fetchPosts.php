<?php 
   require_once('../init.php');
   $loadFromUser->preventAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
   if(is_post_request()){
      if(isset($_POST['fetchPosts']) && !empty($_POST['fetchPosts'])){
         $userId=$_POST['userid'];
         $limit=(int)trim($_POST['fetchPosts']);
         $loadFromPost->posts($userId,$limit);
      }

      if(isset($_POST['fetchPost']) && !empty($_POST['fetchPost'])){
         $userId=$_POST['userid'];
         $profileId=$_POST['profileId'];
         $limit=(int)trim($_POST['fetchPost']);
         $loadFromPost->profilePosts($userId,$profileId,$limit);
      }
}

  
?>