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

$profileData = $loadFromUser->userData($profileId);
$user = $loadFromUser->userData($user_id);
$followCount=$loadFromFollow->displayFollowerCount($profileId);
$page_title=$profileData->firstName." ".$profileData->lastName ." (@".$profileData->username.") / Twitter";

?>
<?php require_once 'backend/shared/header.php'; ?>
<div class="u_p_id" data-uid="<?php echo $user_id; ?>"  data-pid="<?php echo $profileId ?>"></div>
<?php require_once 'backend/shared/mainNav.php'; ?>
<section class="mainSectionContainer">
                <?php require_once 'backend/shared/profileContainer.php'; ?>
                <div class="tabsContainer">
                    <?php echo $loadFromPost->createTab("Posts",url_for($profileData->username),true); ?>
                    <?php echo $loadFromPost->createTab("Replies", url_for($profileData->username.'/replies'),false); ?>
                </div>
                <div class="postsContainer">
                   <?php $loadFromPost->posts($profileId,10); ?>
                </div>
                <div id="popUpModal" class="retweet-modal-container">
                   
                </div> 
                <div id="profileModal" class="retweet-modal-container">
                <div class="profile-modal-content">
                           <div class="upload-profilePic-modal-step">
                           <div class="modal-header-profile">
                                        <div class="site-logo-wrapper">
                                            <i class="fa fa-twitter"></i>
                                        </div>
                                       <div class="skip-for-now">Skip for now</div>
                            </div>
                                    <div class="modal-body-profile">
                                         <h3>Pick a profile picture</h2>
                                         <p>Have a favorite selfie? Upload it now.</p>
                                         <!-- <input type="file" id="filePhoto" class="displayFileInput" name="filePhoto"> -->
                                         <div class="modal-body-profile-wrapper">
                                                <div class="image-profile-container">
                                                  <img src="frontend/assets/images/defaultProfilePic.png" alt="" width="40px">
                                                </div>
                                                <div class="image-btn-upload-icon">
                                                   <label for="filePhoto">
                                                   <svg viewBox="0 0 24 24" class="camera-profile-icon"><g><path d="M19.708 22H4.292C3.028 22 2 20.972 2 19.708V7.375C2 6.11 3.028 5.083 4.292 5.083h2.146C7.633 3.17 9.722 2 12 2c2.277 0 4.367 1.17 5.562 3.083h2.146C20.972 5.083 22 6.11 22 7.375v12.333C22 20.972 20.972 22 19.708 22zM4.292 6.583c-.437 0-.792.355-.792.792v12.333c0 .437.355.792.792.792h15.416c.437 0 .792-.355.792-.792V7.375c0-.437-.355-.792-.792-.792h-2.45c-.317.05-.632-.095-.782-.382-.88-1.665-2.594-2.7-4.476-2.7-1.883 0-3.598 1.035-4.476 2.702-.16.302-.502.46-.833.38H4.293z"></path><path d="M12 8.167c-2.68 0-4.86 2.18-4.86 4.86s2.18 4.86 4.86 4.86 4.86-2.18 4.86-4.86-2.18-4.86-4.86-4.86zm2 5.583h-1.25V15c0 .414-.336.75-.75.75s-.75-.336-.75-.75v-1.25H10c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h1.25V11c0-.414.336-.75.75-.75s.75.336.75.75v1.25H14c.414 0 .75.336.75.75s-.336.75-.75.75z"></path></g></svg>
                                                   </label>
                                                   <input type="file" id="filePhoto" class="fileInputPhoto" name="filePhoto">
                                                </div>
                                         </div>
                                         
                                         
                                    </div>
                           
                           </div>
                           <div class="display-modal-preview-container">
                           <div class="modal-header-profile-preview">
                                        <div class="modal-header-profile-edit">
                                            <div class="profile-edit-back">
                                               <svg viewBox="0 0 24 24" class="color-blue"><g><path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z"></path></g></svg>
                                            </div>
                                            <h2>Edit Media</h2>
                                        </div>
                                        <span class="submitProfileChange" id="imageUploadButton">Apply</span>
                            </div>
                                    <div class="modal-body-profile">

                                         <!-- <input type="file" id="filePhoto" class="displayFileInput" name="filePhoto"> -->
                                         <div class="modal-body-profile-wrapper">
                                                <div class="imagePreviewContainer">
                                                        <img src="" alt=" " id="imagePreview">
                                                </div>
                                         </div>
                                        
                                         
                                    </div>
                           
                           </div>
                                        <!-- <div class="modal-footer-profile">
                                            <div class="edit-btn-profile" id="editProfile" role="button" data-focusable="true" tabindex="0">
                                                <span class="profile-edit-post-text">Save</span>
                                            </div>
                                        </div> -->
                                    
                     </div>
                </div> 
                <div class="reply-wrapper"></div>
</section>
</main>
</section>
<script src="<?php echo url_for('frontend/assets/js/profile.js'); ?>"></script>
<?php require_once 'backend/shared/mainFooter.php'; ?>