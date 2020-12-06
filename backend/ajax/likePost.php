<?php
 require_once('../init.php');
 $postId=$_POST['postId'];
 $userId=$_POST['userId'];

 echo $loadFromPost->Likes($userId,$postId);

?>