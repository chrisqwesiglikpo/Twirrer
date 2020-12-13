<?php
  include '../init.php';
  if(is_post_request()){
  if(isset($_POST['showPopup']) && !empty($_POST['showPopup'])){
     $postedBy=$_POST['postedBy'];
     $post_id=$_POST['showPopup'];
     $user_id=$_POST['user_id'];
     $post=$loadFromPost->getModalPost($post_id,$postedBy);
     $user=$loadFromUser->userData($user_id);
     ?>
      <div class="reply-modal-content">
           <div class="reply-modal-header">
               <span class="close" aria-label="Close" data-focusable="true" role="button" tabindex="0"><svg viewBox="0 0 24 24" class="close-icon"><g><path d="M13.414 12l5.793-5.793c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0L12 10.586 6.207 4.793c-.39-.39-1.023-.39-1.414 0s-.39 1.023 0 1.414L10.586 12l-5.793 5.793c-.39.39-.39 1.023 0 1.414.195.195.45.293.707.293s.512-.098.707-.293L12 13.414l5.793 5.793c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L13.414 12z"></path></g></svg></span>
           </div>
           <div class="reply-modal-body">
               <div class="reply-container">
                   <div class="reply-wrapper-image">
                       <img src="<?php echo url_for($post->profilePic); ?>" alt="">
                   </div>
                  <div class="reply-content-wrapper">
                        <div class="reply-content-desc">
                            <div class="reply-user-fullName">
                               <?php echo $post->firstName." ".$post->lastName; ?>
                            </div>
                            <div class="reply-username">
                                @<?php echo $post->username; ?>
                            </div>
                            <div class="reply-desc-date">
                                <span class="reply-date-time">.</span><?php echo $loadFromUser->timeAgo($post->postedOn); ?>
                            </div>
                        </div>
                        <div class="reply-desc-text">
                        <?php echo $post->post; ?>
                        </div>
                        <div class="reply-to-desc">
                            <span class="reply-to">Reply to</span> <a href="<?php echo url_for($post->username); ?>" class="reply-username-link">@<?php echo $post->username; ?></a>
                        </div>
                  </div>
               </div>
               <div class="vertical-pip"></div>
               <div class="reply-user-msg">
                    <div class="reply-wrapper-image">
                            <img src="<?php echo url_for($user->profilePic); ?>" alt="">
                    </div>
                    <textarea id="replyInput" placeholder="Tweet your reply" autofocus></textarea>
               </div>
           </div>
           <div class="reply-modal-footer">
                <button class="reply-btn" id="replyBtn" role="button" data-focusable="true" tabindex="0" disabled="true">
                             Reply
                </button>
           </div>
       </div>
    
     <?php
  }

  if(isset($_POST['comment']) && !empty($_POST['comment'])){
     $comment=h($_POST['comment']);
     $commentBy=$_POST['commentBy'];
     $commentOn=$_POST['commentOn'];

     echo $loadFromPost->comment($commentBy,$commentOn,$comment);
  }

  if(isset($_POST['deleteCommentOn']) && !empty($_POST['deleteCommentOn'])){
    $deleteCommentBy=$_POST['deleteCommentBy'];
    $deleteCommentOn=$_POST['deleteCommentOn'];

    echo $loadFromPost->removeComment($deleteCommentBy,$deleteCommentOn);
 }

}
  ?>