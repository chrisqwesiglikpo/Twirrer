<?php
require_once 'backend/shared/mainHeader.php';

if(isset($_GET['chatId']) && !empty($_GET['chatId'])){
    $chatId=h($_GET['chatId']);
    $chatData=$loadFromPost->getChatData($chatId,$user_id);
    if(!empty($chatData)){
       $chatTitle=$chatData->chatTitle;
    }else{
        redirect_to(url_for("messages"));
    }
    
    
}else{
    redirect_to(url_for("messages"));
}
$profileData = $loadFromUser->userData($profileId);
$followCount=$loadFromFollow->displayFollowerCount($profileId);
$page_title=$chatTitle." / Twitter";
?>

<?php require_once 'backend/shared/header.php'; ?>
<div class="u_p_id" data-uid="<?php echo $user_id; ?>"  data-pid="<?php echo $profileId ?>" data-cid="<?php echo $chatId; ?>"></div>
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
<section class="chatsMessageContainer">
    <div class="header-top">
            <div class="chats__parts" aria-label="back" role="button" data-focusable="true" tabindex="0">
                  <svg viewBox="0 0 24 24" class="color-blue"><g><path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z"></path></g></svg>
            </div>
            <h2><?php echo $chatTitle; ?></h2>
    </div>
    <div class="chatPageContainer">
        <!-- <div class="chatTitleBarContainer">
            <span id="chatName">This is the chat</span>
        </div> -->
        <div class="mainChatContentContainer">
            <div class="chatContainer">
                <div class="chatMessages__chatContainer">
                   <div class="chatmsg__container">
                    
                     <?php $loadFromPost->getMessages($user_id,$chatId); ?>
                   </div>
                   
                </div>
                <div class="chatFooter">
                    <textarea name="messageInput" id="statusEmoji" placeholder="Start a new message" aria-label="Start a new messsage"></textarea> 
                    <button class="sendMessageButton" id="sendMsgBtn" aria-label="Send">
                        <svg viewBox="0 0 24 24" class="msg-send"><g><path d="M21.13 11.358L3.614 2.108c-.29-.152-.64-.102-.873.126-.23.226-.293.577-.15.868l4.362 8.92-4.362 8.92c-.143.292-.08.643.15.868.145.14.333.212.523.212.12 0 .24-.028.35-.087l17.517-9.25c.245-.13.4-.386.4-.664s-.155-.532-.4-.662zM4.948 4.51l12.804 6.762H8.255l-3.307-6.76zm3.307 8.26h9.498L4.948 19.535l3.307-6.763z"></path></g></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
</section>
</main>

<!-- <script>

$(document).on("keyup","#statusEmoji",function(e){
        var statusText = $('.emojionearea-editor').html();
    
      
        // let isModal=textbox.parents(".reply-wrapper").length==1;
        
        
        
        let submitButton= $("#sendMsgBtn") ;
        // if(submitButton.length ==0) return alert("No submit button not found");
            
        if(statusText ==""){
            submitButton.prop("disabled",true);
            return;
          }
          submitButton.prop("disabled",false);
       
    })
</script> -->
<script src="<?php echo url_for('frontend/assets/dist/emojionearea.min.js'); ?>"></script>
<script src="<?php echo url_for('frontend/assets/js/chatPage.js'); ?>"></script>
<script src="<?php echo url_for('frontend/assets/js/partScroll.js'); ?>"></script>
<script src="<?php echo url_for('frontend/assets/js/inboxPage.js'); ?>"></script>
<script src="<?php echo url_for('frontend/assets/js/toggleFollow.js'); ?>"></script>
<?php require_once 'backend/shared/mainFooter.php'; ?>