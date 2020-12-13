<?php 
  include '../init.php';
  $loadFromUser->preventAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
if(is_post_request()){
  if(isset($_POST['unfollow']) && !empty($_POST['unfollow'])){
  	  $user_id=$_POST['user_id'];
      $followID=$_POST['unfollow'];
  	  $profileID=$_POST['profile'];
  	  $loadFromFollow->unfollow($followID,$user_id,$profileID);
  }

   if(isset($_POST['follow']) && !empty($_POST['follow'])){
  	  $user_id=$_POST['user_id'];
  	  $followID=$_POST['follow'];
      $profileID=$_POST['profile'];
      $loadFromFollow->follow($followID,$user_id,$profileID);
  }
}

?>
