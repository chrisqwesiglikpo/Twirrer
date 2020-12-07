<?php
  include '../init.php';
 
  if(isset($_POST['showPopup']) && !empty($_POST['showPopup'])){
     $postedBy=$_POST['postedBy'];
     $post_id=$_POST['showPopup'];
     $user_id=$_POST['user_id'];
     $post=$loadFromPost->getModalPost($post_id,$postedBy);
     $user=$loadFromUser->userData($user_id);
     ?>
     
     <div class="modal-content">
                      <div class="modal-header">
                        <span class="close" aria-label="Close" data-focusable="true" role="button" tabindex="0"><svg viewBox="0 0 24 24" class="close-icon"><g><path d="M13.414 12l5.793-5.793c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0L12 10.586 6.207 4.793c-.39-.39-1.023-.39-1.414 0s-.39 1.023 0 1.414L10.586 12l-5.793 5.793c-.39.39-.39 1.023 0 1.414.195.195.45.293.707.293s.512-.098.707-.293L12 13.414l5.793 5.793c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L13.414 12z"></path></g></svg></span>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body-header">
                                <div class="modal-image-wrapper">
                                    <img src="<?php echo url_for($user->profilePic); ?>" alt="">
                                </div>
                                <input type="text" placeholder="Add a comment" id="retweet-comment" autofocus>
                            </div>
                            <div class="modal-retweet-content">
                                <div class="modal-retweet-header">
                                    <div class="modal-user-img-wrapper">
                                      <img src="<?php echo url_for($post->profilePic); ?>" alt="" width="30px">
                                    </div>
                                    <div class="retweet-user-fullName">
                                        <h4><?php echo $post->firstName." ".$post->lastName; ?></h4>
                                    </div>
                                    <div class="retweet-username">
                                        @<?php echo $post->username; ?>
                                    </div>
                                    <div class="retweet-date-post">
                                    <?php echo $loadFromUser->timeAgo($post->postedOn); ?>
                                    </div>
                                </div>
                                <div class="modal-retweet-post-body">
                                    <p><?php echo $post->post; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="retweet-modal-footer">
                              <div class="retweet-btn" id="retweet-btn" role="button" data-focusable="true" tabindex="0">
                                 <span class="retweet-post-text">Retweet</span>
                              </div>
                        </div>
                       
                    </div>
     <?php
  }

   
  if(isset($_POST['retweet']) && !empty($_POST['retweet'])){
    $tweet_id=$_POST['retweet'];
    $user_id=$_POST['user_id'];
    $postedBy=$_POST['postedBy'];
    // $comment=h($_POST['comment']);
    // $loadFromPost->retweet($tweet_id,$user_id,$postedBy,$comment);
    echo $loadFromPost->retweetCount($user_id,$tweet_id);
  }

  if(isset($_POST['deretweet']) && !empty($_POST['deretweet'])){
      $deretweet=$_POST['deretweet'];
      $user_id=$_POST['user_id'];
      $loadFromPost->delete('retweet',['retweetBy'=>$user_id,'retweetFrom'=>$deretweet]);
     
  }

?>