<?php
require_once 'backend/shared/mainHeader.php';
$profileData = $loadFromUser->userData($profileId);
$followCount=$loadFromFollow->displayFollowerCount($profileId);
if(isset($_GET['hashtag']) && !empty($_GET['hashtag'])){
    $hashtag=h($_GET['hashtag']);
}else{
    redirect_to("home");
}
$page_title="#".$hashtag." - Twitter Search / Twitter";

?>
<?php require_once 'backend/shared/header.php'; ?>
<div class="u_p_id" data-uid="<?php echo $user_id; ?>"  data-pid="<?php echo $profileId ?>"></div>
<?php require_once 'backend/shared/mainNav.php'; ?>
<section class="mainSectionContainer">
    <div class="go-back-container">
       <div class="go-back-arrow-home">
          <svg viewBox="0 0 24 24" class="color-blue"><g><path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z"></path></g></svg>
       </div>
       <div class="go-back-name">
          
       </div>
    </div>
    <div class="tabsContainer">
                    <?php echo $loadFromPost->createTab("Top", url_for('hashtag/'.$hashtag),true); ?>
                    <?php echo $loadFromPost->createTab("Latest",url_for($profileData->username.'/following'),false); ?>
                    <?php echo $loadFromPost->createTab("People", url_for($profileData->username.'/suggested'),false); ?>
                    <?php echo $loadFromPost->createTab("Photos", url_for($profileData->username.'/suggested'),false); ?>
    </div>
    <div class="postsContainer" aria-label="Timeline:Hashtag">
       <?php $loadFromPost->getHashTag($hashtag,$user_id); ?>
    </div>
</section>
</main>
<script src="<?php echo url_for('frontend/assets/js/following.js'); ?>"></script>
<?php require_once 'backend/shared/mainFooter.php'; ?>