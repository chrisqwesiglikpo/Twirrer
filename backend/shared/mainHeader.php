<?php
include 'backend/init.php';

if(Login::isLoggedIn()){
    $user_id=Login::isLoggedIn();

}else if(isset($_SESSION['userLoggedIn'])){
    $user_id=$_SESSION['userLoggedIn'];
}else{
    redirect_to(url_for("index"));
}
if(isset($_GET['username']) == true && empty($_GET['username']) === false){
    $username =h($_GET['username']);
    $profileId = $loadFromUser->userIdByUsername($username);
}
else{
$profileId =$user_id;
}
$user=$loadFromUser->userData($user_id);
$notificationCount=$loadFromPost->notificationCount($user_id);

?>