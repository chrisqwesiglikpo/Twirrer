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
$page_title="People following by ".$profileData->firstName." ".$profileData->lastName ." (@".$profileData->username.") /Twitter";

?>
<?php require_once 'backend/shared/header.php'; ?>
<div class="u_p_id" data-uid="<?php echo $user_id; ?>"  data-pid="<?php echo $profileId ?>"></div>
<?php require_once 'backend/shared/mainNav.php'; ?>
<section class="mainSectionContainer">
    <div class="go-back-container">
       <div class="go-back-arrow">
          <svg viewBox="0 0 24 24" class="color-blue"><g><path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z"></path></g></svg>
       </div>
       <div class="go-back-name">
          <h2 role="heading" aria-label="2"><?php echo $profileData->firstName." ".$profileData->lastName; ?></h2>
          <span class="username-following">@<?php echo $profileData->username; ?></span>
       </div>
    </div>
    <div class="tabsContainer">
                    <?php echo $loadFromPost->createTab("Followers", url_for($profileData->username.'/followers'),true); ?>
                    <?php echo $loadFromPost->createTab("Following",url_for($profileData->username.'/following'),false); ?>
                    <?php echo $loadFromPost->createTab("Suggested", url_for($profileData->username.'/suggested'),false); ?>
    </div>
    <div class="resultsContainer" aria-label="Timeline: Following">
       <?php   $loadFromFollow->followersList($profileId,$user_id); ?>
    </div>
</section>
</main>
<script src="<?php echo url_for('frontend/assets/js/following.js'); ?>"></script>
<?php require_once 'backend/shared/mainFooter.php'; ?>