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
$user=$loadFromUser->userData($user_id);
$userId=$user->user_id;

?>
<?php require_once 'backend/shared/header.php'; ?>
<div class="u_p_id" data-uid="<?php echo $user_id; ?>"  data-pid="<?php echo $profileId ?>"></div>
   
        <section class="mainSectionContainer">
                <div class="header-top">
                   <h4>Home</h4>
                   <img src="frontend/assets/images/star.svg" alt="">
                </div>
                <div class="header-post">
               
                   <div class="userImageContainer">
                      <img src="<?php echo $user->profilePic; ?>" alt="User Profile Pic">
                   </div>
                   <form class="textareaContainer"> 
                        <textarea  id="postTextarea" placeholder="What's happening?" aria-label="What's happening?"></textarea>
                        <div class="hash-box">
                           <ul></ul>
                        </div>
                        <div class="buttonsContainer">
                        <input id="submitPostButton" type="submit" disabled="true" role="button" value="Post">
                        </div>
                   </form>
                </div>
                <div class="postsContainer">
                
                  <div class="post">
                  
                       <div class="mainContentContainer">
                       
                            <div class="userImageContainer">
                                <img src="frontend/assets/images/profilePic.jpeg" alt="User Profile Pic">
                            </div>
                            <div class="postContentContainer">
                                <div class="post-header">
                                    <a href="'.url_for($post->username).'" class="displayName">Christopher Glikpo</a>
                                    <span class="username">@cglikpo</span>
                                    <span class="date">2h</span>
                                  
                                </div>
                                <div class="post-body">
                                      <div>I am </div>
                                </div>
                               
                            </div>
                       </div>
                   </div>
                </div>
                <div id="popUpModal" class="retweet-modal-container">
                   
                </div> 
                
        </section>
      
        </main>
</section>

<script src="<?php echo url_for('frontend/assets/js/liveSearch.js'); ?>"></script>
<script src="<?php echo url_for('frontend/assets/js/fetch.js'); ?>"></script>
<script src="<?php echo url_for('frontend/assets/js/toggleFollow.js'); ?>"></script>
<?php require_once 'backend/shared/mainFooter.php'; ?>