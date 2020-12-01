<?php
include 'backend/init.php';

if(Login::isLoggedIn()){
    $user_id=Login::isLoggedIn();

}else if(isset($_SESSION['userLoggedIn'])){
    $user_id=$_SESSION['userLoggedIn'];
}else{
    redirect_to(url_for("index.php"));
}
$user=$loadFromUser->userData($user_id);
$username=$user->username;
$userId=$loadFromUser->userIdByUsername($username);

?>
<?php require_once 'backend/shared/header.php'; ?>
<div class="u_p_id" data-uid="<?php echo $user->user_id; ?>"></div>
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
        </section>
        <aside role="complementary" class="follow">
            <h3 class="follow-heading">Who to follow</h3>
                <div class="follow-user">
                    <div class="follow-user-img">
                        <img src="frontend/assets/images/defaultProfilePic.png" alt="">
                    </div>
                    <div class="follow-user-info">
                        <h4>Ann Smith</h4>
                        <p>@annsmith</p>
                    </div>
                    <button type="button" class="follow-btn">Follow</button>
                </div>
                <div class="follow-user">
                    <div class="follow-user-img">
                        <img src="frontend/assets/images/ProfilePic.jpeg" alt="">
                    </div>
                    <div class="follow-user-info">
                        <h4>Jmaes Black</h4>
                        <p>@annsmith</p>
                    </div>
                    <button type="button" class="follow-btn">Follow</button>
                </div>
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
<?php require_once 'backend/shared/mainFooter.php'; ?>