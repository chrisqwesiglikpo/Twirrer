<?php
include 'backend/init.php';

if(Login::isLoggedIn()){
    $user_id=Login::isLoggedIn();

}else if(isset($_SESSION['userLoggedIn'])){
    $user_id=$_SESSION['userLoggedIn'];
}else{
    redirect_to(url_for("index.php"));
}
$user=$loadFromUser->userData($user_id);
$username=$user->username;
$userId=$loadFromUser->userIdByUsername($username);

?>
<?php require_once 'backend/shared/header.php'; ?>
<div class="u_p_id" data-uid="<?php echo $user->user_id; ?>"></div>
<?php require_once 'backend/shared/mainNav.php'; ?>
<section class="mainSectionContainer">
</section>
<?php require_once 'backend/shared/mainFooter.php'; ?>