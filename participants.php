<?php
require_once 'backend/shared/mainHeader.php';

$profileData = $loadFromUser->userData($profileId);
$followCount=$loadFromFollow->displayFollowerCount($profileId);
$page_title="Direct Messages / Twitter";
if(isset($_GET['chatId']) && !empty($_GET['chatId'])){
    $chatId=h($_GET['chatId']);
}

?>
<?php require_once 'backend/shared/header.php'; ?>
<div class="u_p_id" data-uid="<?php echo $user_id; ?>"  data-pid="<?php echo $profileId ?>"></div>
<?php require_once 'backend/shared/mainNav.php'; ?>
<section class="mainSectionContainer">
    <div class="header-top">
            <h4>Messages</h4>
            <a href="<?php echo url_for('messages/compose'); ?>" aria-label="Compose a DM" role="button" data-focusable="true" data-testid="NewDM_Button" class="compose-inbox"><div class=""><svg viewBox="0 0 24 24" class="compose-stc"><g><path d="M23.25 3.25h-2.425V.825c0-.414-.336-.75-.75-.75s-.75.336-.75.75V3.25H16.9c-.414 0-.75.336-.75.75s.336.75.75.75h2.425v2.425c0 .414.336.75.75.75s.75-.336.75-.75V4.75h2.425c.414 0 .75-.336.75-.75s-.336-.75-.75-.75zm-3.175 6.876c-.414 0-.75.336-.75.75v8.078c0 .414-.337.75-.75.75H4.095c-.412 0-.75-.336-.75-.75V8.298l6.778 4.518c.368.246.79.37 1.213.37.422 0 .844-.124 1.212-.37l4.53-3.013c.336-.223.428-.676.204-1.012-.223-.332-.675-.425-1.012-.2l-4.53 3.014c-.246.162-.563.163-.808 0l-7.586-5.06V5.5c0-.414.337-.75.75-.75h9.094c.414 0 .75-.336.75-.75s-.336-.75-.75-.75H4.096c-1.24 0-2.25 1.01-2.25 2.25v13.455c0 1.24 1.01 2.25 2.25 2.25h14.48c1.24 0 2.25-1.01 2.25-2.25v-8.078c0-.415-.337-.75-.75-.75z"></path></g></svg></div></a>
    </div>
    <div class="resultsContainer resultsContainer__part" aria-label="Timeline:Inbox" data-chat="<?php echo $chatId; ?>">
      <?php  echo $loadFromPost->displayChatUsers($user_id,$chatId,7); ?>
    </div>
</section>
<section class="participants-chats">
    <div class="header-top">
            <div class="chats__parts" aria-label="back" role="button" data-focusable="true" tabindex="0">
                  <svg viewBox="0 0 24 24" class="color-blue"><g><path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z"></path></g></svg>
            </div>
            <h2>People</h2>
    </div>
    <?php $loadFromFollow->displayParticipant($user_id,$chatId); ?>
</section>
</main>

<script src="<?php echo url_for('frontend/assets/js/partScroll.js'); ?>"></script>
<script src="<?php echo url_for('frontend/assets/js/inboxPage.js'); ?>"></script>
<script src="<?php echo url_for('frontend/assets/js/toggleFollow.js'); ?>"></script>
<?php require_once 'backend/shared/mainFooter.php'; ?>