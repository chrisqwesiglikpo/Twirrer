<?php 
  include '../init.php';

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

?>
