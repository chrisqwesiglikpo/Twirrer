<?php
include 'backend/init.php';

if(Login::isLoggedIn()){
    $user_id=Login::isLoggedIn();

}else if(isset($_SESSION['userLoggedIn'])){
    $user_id=$_SESSION['userLoggedIn'];
}else{
    redirect_to(url_for("index.php"));
}
if(isset($_GET['username']) == true && empty($_GET['username']) === false){
        $username =h($_GET['username']);
        $profileId = $loadFromUser->userIdByUsername($username);
}
else{
    $profileId =$user_id;
}

$profileData = $loadFromUser->userData($profileId);
$user = $loadFromUser->userData($user_id);
$followCount=$loadFromFollow->displayFollowerCount($profileId);
$page_title="Tweets with replies by ".$profileData->firstName." ".$profileData->lastName ." (@".$profileData->username.") / Twitter";


?>
<?php require_once 'backend/shared/header.php'; ?>
<div class="u_p_id" data-uid="<?php echo $user_id; ?>"  data-pid="<?php echo $profileId ?>"></div>
<?php require_once 'backend/shared/mainNav.php'; ?>
<section class="mainSectionContainer">
                <?php require_once 'backend/shared/profileContainer.php'; ?>
                <div class="tabsContainer">
                    <?php echo $loadFromPost->createTab("Posts",url_for($profileData->username),false); ?>
                    <?php echo $loadFromPost->createTab("Replies", url_for($profileData->username.'/replies'),true); ?>
                </div>
                <div class="postsContainer">
                   
                </div>
</section>
</main>
</section>
<?php require_once 'backend/shared/mainFooter.php'; ?>