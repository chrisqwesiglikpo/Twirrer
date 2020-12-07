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
   <?php require_once 'backend/shared/mainNav.php'; ?>
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
                   <?php $loadFromPost->posts($userId,10); ?>
                </div>
                <div id="popUpModal" class="retweet-modal-container">
                   
                    <div class="modal-content">
                        <div class="modal-header">
                        <span class="close" aria-label="Close" data-focusable="true" role="button" tabindex="0"><svg viewBox="0 0 24 24" class="close-icon"><g><path d="M13.414 12l5.793-5.793c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0L12 10.586 6.207 4.793c-.39-.39-1.023-.39-1.414 0s-.39 1.023 0 1.414L10.586 12l-5.793 5.793c-.39.39-.39 1.023 0 1.414.195.195.45.293.707.293s.512-.098.707-.293L12 13.414l5.793 5.793c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L13.414 12z"></path></g></svg></span>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body-header">
                                <div class="modal-image-wrapper">
                                    <img src="frontend/assets/images/defaultProfilePic.png" alt="">
                                </div>
                                <input type="text" placeholder="Add a comment" id="retweet-comment" autofocus>
                            </div>
                            <div class="modal-retweet-content">
                                <div class="modal-retweet-header">
                                    <div class="modal-user-img-wrapper">
                                      <img src="frontend/assets/images/defaultProfilePic.png" alt="" width="30px">
                                    </div>
                                    <div class="retweet-user-fullName">
                                        <h4>Florin Pop</h4>
                                    </div>
                                    <div class="retweet-username">
                                        @florinpop175
                                    </div>
                                    <div class="retweet-date-post">
                                        16m
                                    </div>
                                </div>
                                <div class="modal-retweet-post-body">
                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis rem temporibus iusto. Quis veniam odio quas dolores. Adipisci quam tempora sint voluptatum, doloribus corporis deleniti laborum dolores! Neque, sed libero!</p>
                                </div>
                            </div>
                        </div>
                        <div class="retweet-modal-footer">
                              <div class="retweet-btn" id="retweet-btn" role="button" data-focusable="true" tabindex="0">
                                 <span class="retweet-post-text">Retweet</span>
                              </div>
                        </div>
                       
                    </div>
                </div> 
                
        </section>
        <aside role="complementary">
            <div id="search-area">
               <form id="search-form" aria-label="Search Twitter" role="search">
                   <input type="text" name="main-search" id="main-search" placeholder="Search Twitter" role="searchbox"/>
                   <svg viewBox="0 0 24 24" class="search-icon"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
               </form>
               <div id="search-show">
                    <div class="search-result">
                        <div class="search-title">
                            <div class="search-header">
                                <h3>Try searching for people, topics, or keywords</h3>
                            </div>
                        </div>
                         
                    </div>
               </div>
            </div>
            <div class="follow">
            <h3 class="follow-heading">Who to follow</h3>
               <?php $loadFromFollow->whoToFollow($user_id,$profileId); ?>
            <div class="follow-link">
                <a href="#">Show more</a>
            </div>
            <footer class="follow-footer">
                <ul>
                    <li><a href="#">Terms</a></li>
                    <li><a href="#">Privacy policy</a></li>
                    <li><a href="#">Cookies</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">More</a></li>
                </ul>
            </footer>
            
            </div>
        </aside>
        </main>
</section>

<script src="<?php echo url_for('frontend/assets/js/liveSearch.js'); ?>"></script>
<script src="<?php echo url_for('frontend/assets/js/retweet.js'); ?>"></script>
<script src="<?php echo url_for('frontend/assets/js/fetch.js'); ?>"></script>
<script src="<?php echo url_for('frontend/assets/js/toggleFollow.js'); ?>"></script>
<?php require_once 'backend/shared/mainFooter.php'; ?>