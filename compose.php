<?php
require_once 'backend/shared/mainHeader.php';
$profileData = $loadFromUser->userData($profileId);

$followCount=$loadFromFollow->displayFollowerCount($profileId);
$page_title="Messages / Twitter";

?>
<?php require_once 'backend/shared/header.php'; ?>
<div class="u_p_id" data-uid="<?php echo $user_id; ?>"  data-pid="<?php echo $profileId ?>"></div>
<?php require_once 'backend/shared/mainNav.php'; ?>
<section class="mainSectionContainer">
    <div class="header-top">
            <h4>New message</h4>
           
    </div>
    <div class="chatPageContainer">
        <div class="chatTitleBar">
           <label for="userSearchTextbox">To:</label>
           <div id="selectedUsers">
                <input type="text" id="userSearchTextbox" placeholder="Type the name of the person" autofocus>
           </div>
        </div>
        <div class="resultsContainer" aria-label="Timeline:Inbox">
               
        </div>
        <button id="createChatButton" type="button" disabled="true">Create Chat</button>
    </div>
    
</section>
</main>

<script src="<?php echo url_for('frontend/assets/js/chat.js'); ?>"></script>
<?php require_once 'backend/shared/mainFooter.php'; ?>