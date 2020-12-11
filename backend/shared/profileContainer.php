<div class="header-top">
                   <h4><?php echo $profileData->firstName." ".$profileData->lastName; ?></h4>
                </div>
                <div class="profileHeaderContainer">
                    <div class="coverPhotoContainer">
                        <div class="userImageContainer">
                            <img class="profile-pic-me" src="<?php echo url_for($profileData->profilePic); ?>" alt="User's profile pic">
                            <?php if($user_id===$profileId): ?>
                            <!-- <div class="profilePictureButton">
                                <label for="editProfile">
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="camera-img"  id="profilePictureButton"><g><path d="M19.708 22H4.292C3.028 22 2 20.972 2 19.708V7.375C2 6.11 3.028 5.083 4.292 5.083h2.146C7.633 3.17 9.722 2 12 2c2.277 0 4.367 1.17 5.562 3.083h2.146C20.972 5.083 22 6.11 22 7.375v12.333C22 20.972 20.972 22 19.708 22zM4.292 6.583c-.437 0-.792.355-.792.792v12.333c0 .437.355.792.792.792h15.416c.437 0 .792-.355.792-.792V7.375c0-.437-.355-.792-.792-.792h-2.45c-.317.05-.632-.095-.782-.382-.88-1.665-2.594-2.7-4.476-2.7-1.883 0-3.598 1.035-4.476 2.702-.16.302-.502.46-.833.38H4.293z"/><path d="M12 8.167c-2.68 0-4.86 2.18-4.86 4.86s2.18 4.86 4.86 4.86 4.86-2.18 4.86-4.86-2.18-4.86-4.86-4.86zm2 5.583h-1.25V15c0 .414-.336.75-.75.75s-.75-.336-.75-.75v-1.25H10c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h1.25V11c0-.414.336-.75.75-.75s.75.336.75.75v1.25H14c.414 0 .75.336.75.75s-.336.75-.75.75z"/></g></svg>
                                </label>
                                 <input type="file" name="file-upload" id="editProfile" class="file-upload-input"> -->
                            <!-- </div> -->
                            <?php endif; ?>
                            
                        </div>
                    </div>
                    <div class="profileButtonsContainer">
                        <?php $loadFromFollow->followBtn($profileId,$user_id); ?>
                    </div>
                    <div class="userDetailsContainer">
                        <span class="displayName"><?php echo $profileData->firstName." ".$profileData->lastName; ?></span>
                        <span class="username">@<?php echo $profileData->username; ?></span>
                        <span class="description"></span>
                        <div class="followersContainer">
                            <a href="<?php echo url_for($profileData->username.'/following'); ?>">

                              <span class="value count-following"><?php echo $followCount->following; ?></span>
                              <span>Following</span>
                           </a>
                           <a href="<?php echo url_for($profileData->username.'/followers'); ?>">
                              <span class="value count-followers"><?php echo $followCount->followers; ?></span>
                              <span>Followers</span>
                           </a>
                        </div>
                    </div> 
                </div>