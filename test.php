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
$controls=$postControls->createControls(23,3,3);

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
                 <div class="retweet-content-container">
                       <div class="retweet-content-head-container">
                       <div class="image-content-wrapper">
                           <img src="frontend/assets/images/profilePic.jpeg" alt="">
                       </div>
                       <div class="retweet-content-header">
                          <div class="retweet-content-desc">
                              <div class="retweet-content-fullName">Christopher Glikpo</div>
                              <div class="retweet-content-username">@cglikpo</div>
                              <div class="retweet-date"><span class="dot-retweet-content">.</span>12h</div>
                          </div>
                          <div class="retweet-content-text">
                            Yeah
                          </div>
                       </div>
                       </div>
                       <div class="retweet-content-body">
                          <div class="retweet-content-body-header">
                                <div class="retweet-content-header-img-wrapper">
                                    <img src="frontend/assets/images/profilePic.jpeg" alt="">
                                </div>
                                <div class="retweet-content-body-header-fullName">
                                   Adrian Twarog
                                </div>
                                <div class="retweet-content-body-header-username">
                                   @adrian_twarog
                                </div>
                                <div class="retweet-content-body-header-date">
                                  <span class="dot-date-header">.</span>2h
                                </div>
                          </div>
                          <div class="retweet-content-body-post">
                           <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam neque quia magnam alias ipsam possimus iusto asperiores dolor aperiam voluptates officiis inventore mollitia amet quos perferendis, blanditiis vero cum labore.</div>
                          </div>
                          <?php echo $controls; ?>
                       </div>  

                  </div>
                  <!-- <div class="post">
                  
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
                   
                </div>  -->
                
        </section>
      
        </main>
</section>


<?php require_once 'backend/shared/mainFooter.php'; ?>