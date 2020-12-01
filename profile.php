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
                    <?php echo $loadFromPost->createTab("Posts",url_for('profile/'.$user->username),true); ?>
                    <?php echo $loadFromPost->createTab("Replies", url_for('profile/'.$user->username.'/replies'),false); ?>
                </div>
</section>
<?php require_once 'backend/shared/mainFooter.php'; ?>