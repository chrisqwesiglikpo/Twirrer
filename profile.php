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
$notUserProfile=1;
$selectedTab='posts';
$selected=$selectedTab=='posts'? true : false; 
?>
<?php require_once 'backend/shared/header.php'; ?>
<div class="u_p_id" data-uid="<?php echo $user->user_id; ?>"></div>
<?php require_once 'backend/shared/mainNav.php'; ?>
<section class="mainSectionContainer">
                <div class="header-top">
                   <h4><?php echo $user->firstName." ".$user->lastName; ?></h4>
                </div>
                <div class="profileHeaderContainer">
                    <div class="coverPhotoContainer">
                        <div class="userImageContainer">
                            <img src="<?php echo $user->profilePic; ?>" alt="User's profile pic">
                            <button class="profilePictureButton" data-toggle="modal" data-target="">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="camera-img"><g><path d="M19.708 22H4.292C3.028 22 2 20.972 2 19.708V7.375C2 6.11 3.028 5.083 4.292 5.083h2.146C7.633 3.17 9.722 2 12 2c2.277 0 4.367 1.17 5.562 3.083h2.146C20.972 5.083 22 6.11 22 7.375v12.333C22 20.972 20.972 22 19.708 22zM4.292 6.583c-.437 0-.792.355-.792.792v12.333c0 .437.355.792.792.792h15.416c.437 0 .792-.355.792-.792V7.375c0-.437-.355-.792-.792-.792h-2.45c-.317.05-.632-.095-.782-.382-.88-1.665-2.594-2.7-4.476-2.7-1.883 0-3.598 1.035-4.476 2.702-.16.302-.502.46-.833.38H4.293z"/><path d="M12 8.167c-2.68 0-4.86 2.18-4.86 4.86s2.18 4.86 4.86 4.86 4.86-2.18 4.86-4.86-2.18-4.86-4.86-4.86zm2 5.583h-1.25V15c0 .414-.336.75-.75.75s-.75-.336-.75-.75v-1.25H10c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h1.25V11c0-.414.336-.75.75-.75s.75.336.75.75v1.25H14c.414 0 .75.336.75.75s-.336.75-.75.75z"/></g></svg>
                            </button>
                        </div>
                    </div>
                    <div class="profileButtonsContainer">
                        <?php if( $notUserProfile != 2)://Not on User ?>
                            <a href="<?php echo url_for('messages.php?id='.$user->user_id); ?>" class="profileButton">
                              <i class="fa fa-envelope"></i>
                            </a>
                            <button class="followButton" data-user="<?php echo $user->user_id; ?>">Follow</button>
                        <?php endif; ?>
                    </div>
                    <div class="userDetailsContainer">
                        <span class="displayName"><?php echo $user->firstName." ".$user->lastName; ?></span>
                        <span class="username">@<?php echo $user->username; ?></span>
                        <span class="description"></span>
                        <div class="followersContainer">
                            <a href="<?php echo url_for('profile/'.$user->username.'/following'); ?>">
                              <span class="value">0</span>
                              <span>Following</span>
                           </a>
                           <a href="<?php echo url_for('profile/'.$user->username.'/followers'); ?>">
                              <span class="value">0</span>
                              <span>Followers</span>
                           </a>
                        </div>
                    </div> 
                </div>
                <div class="tabsContainer">
                    <?php echo $loadFromPost->createTab("Posts",url_for('profile/'.$user->username),$selected == 'posts'); ?>
                    <?php echo $loadFromPost->createTab("Replies", url_for('profile/'.$user->username.'/replies'),$selected !='replies'); ?>
                </div>
                <div class="postsContainer">
                </div>
</section>
<?php require_once 'backend/shared/mainFooter.php'; ?>