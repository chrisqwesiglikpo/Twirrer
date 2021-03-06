<?php
require_once 'backend/shared/mainHeader.php';
$profileData = $loadFromUser->userData($profileId);
$d=strtotime($user->signUpDate);
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
                <div class="commentPostsContainer">
                <?php $loadFromPost->replyPosts($user_id,$profileId,10); ?>
                </div>
</section>
</main>
</section>
<script src="<?php echo url_for('frontend/assets/js/reply.js'); ?>"></script>
<?php require_once 'backend/shared/mainFooter.php'; ?>