<?php
 include '../init.php';
 if(Login::isLoggedIn()){
    $user_id=Login::isLoggedIn();

}else if(isset($_SESSION['userLoggedIn'])){
    $user_id=$_SESSION['userLoggedIn'];
}
 if (isset($_POST['like']) && !empty($_POST['like'])) {
       $tweet_id=$_POST['like'];
       $get_id=$_POST['user_id'];
       $loadFromPost->addLike($user_id,$tweet_id,$get_id);
 }

  if (isset($_POST['unlike']) && !empty($_POST['unlike'])) {
       $tweet_id=$_POST['unlike'];
       $get_id=$_POST['user_id'];
       $loadFromPost->unLike($user_id,$tweet_id,$get_id);
 }
?>