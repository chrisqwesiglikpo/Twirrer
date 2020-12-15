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
if(isset($_GET['post_id']) && !empty($_GET['post_id'])){
    
     $pageUrl=$_SERVER['REQUEST_URI'];
     $link_array=explode('/',$pageUrl);
     $postId=h($link_array[4]);
     $postedBy=h($_GET['post_id']);
     
   
}

$profileData = $loadFromUser->userData($profileId);
$user = $loadFromUser->userData($user_id);
$followCount=$loadFromFollow->displayFollowerCount($profileId);
$page_title=$profileData->firstName." ".$profileData->lastName ." on Twitter";

?>
<?php require_once 'backend/shared/header.php'; ?>
<div class="u_p_id" data-uid="<?php echo $user_id; ?>"  data-pid="<?php echo $profileId ?>"></div>
<?php require_once 'backend/shared/mainNav.php'; ?>
<section class="mainSectionContainer">
    <div class="header-top">
            <div class="go-back-arrow-home">
                <svg viewBox="0 0 24 24" class="color-blue"><g><path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z"></path></g></svg>
            </div>
            <h4>View tweet</h4>
    </div>
    <div class="resultsContainer" aria-label="Timeline:View tweet">
                <div class="postsContainer">
                    <?php $loadFromPost->singlePost($postedBy,$postId); ?>
                </div>
    </div>
    <div class="replyContainer">
                <div class="postsContainer">
                     <?php $loadFromPost->replyPost($postId,$profileId); ?> 
                </div>
    </div>
    <div id="popUpModal" class="retweet-modal-container"></div> 
    <div class="reply-wrapper"></div>
    <div class="d-wrapper-container"></div>
    <div class="del-post-wrapper-container"></div>
    <div class="pin-post-wrapper-container"></div>
</section>
</main>

<script src="<?php echo url_for('frontend/assets/js/postPage.js'); ?>"></script>
<?php require_once 'backend/shared/mainFooter.php'; ?>