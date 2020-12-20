<?php 
  include '../init.php';
  $loadFromUser->preventAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
if(is_post_request()){
  if(isset($_POST['unfollow']) && !empty($_POST['unfollow'])){
  	  $user_id=h($_POST['user_id']);
      $followID=h($_POST['unfollow']);
  	  $profileID=h($_POST['profile']);
      $loadFromFollow->unfollow($followID,$user_id,$profileID);
      $loadFromUser->delete('notification',array('notificationFrom'=>$user_id, 'notificationFor' =>$followID, 'postid' =>'0', 'type'=>'follow', 'status'=> '0', 'notificationCount'=>'0'));
  }

   if(isset($_POST['follow']) && !empty($_POST['follow'])){
  	  $user_id=h($_POST['user_id']);
  	  $followID=h($_POST['follow']);
      $profileID=h($_POST['profile']);
      $loadFromUser->create('notification',array('notificationFrom'=>$user_id, 'notificationFor' =>$followID, 'postid' =>'0', 'type'=>'follow', 'status'=> '0', 'notificationCount'=>'0'));
      $loadFromFollow->follow($followID,$user_id,$profileID);
  }
}

?>
