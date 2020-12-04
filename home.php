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
                   <form class="textareaContainer" > 
                        <textarea  id="postTextarea" placeholder="What's happening?"></textarea>
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
                <div id="myModal" class="modal">
                   
                    <div class="modal-content">
                        <div class="modal-header">
                        <span class="close">&times;</span>
                        <h2>Modal Header</h2>
                        </div>
                        <div class="modal-body">
                        <p>Some text in the Modal Body</p>
                        <p>Some other text...</p>
                        </div>
                        <div class="modal-footer">
                        <h3>Modal Footer</h3>
                        </div>
                    </div>
                </div> 
                
        </section>
        <aside role="complementary" class="follow">
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
        </aside>
        </main>
</section>
<script src="<?php echo url_for('frontend/assets/js/fetch.js'); ?>"></script>
<script src="<?php echo url_for('frontend/assets/js/common.js'); ?>"></script>
<?php require_once 'backend/shared/mainFooter.php'; ?>