<?php
require_once 'backend/shared/mainHeader.php';

$profileData = $loadFromUser->userData($profileId);
$followCount=$loadFromFollow->displayFollowerCount($profileId);
$page_title="Chat Messages / Twitter";
if(isset($_GET['chatId']) && !empty($_GET['chatId'])){
    $chatId=h($_GET['chatId']);
}

?>
<?php require_once 'backend/shared/header.php'; ?>
<div class="u_p_id" data-uid="<?php echo $user_id; ?>"  data-pid="<?php echo $profileId ?>"></div>
<?php require_once 'backend/shared/mainNav.php'; ?>
<section class="mainSectionContainer">
    <div class="header-top">
                <div class="chats__parts" aria-label="back" role="button" data-focusable="true" tabindex="0">
                    <svg viewBox="0 0 24 24" class="color-blue"><g><path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z"></path></g></svg>
                </div>
                <h2>Chat</h2>
    </div>
    <div class="resultsContainer resultsContainer__part" aria-label="Timeline:Inbox" data-chat="<?php echo $chatId; ?>">
      
    </div>
</section>

</main>


<script src="<?php echo url_for('frontend/assets/js/inboxPage.js'); ?>"></script>
<script src="<?php echo url_for('frontend/assets/js/toggleFollow.js'); ?>"></script>
<?php require_once 'backend/shared/mainFooter.php'; ?>