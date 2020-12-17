<div class="header-top">
                 <div class="go-back-arrow-home">
                    <svg viewBox="0 0 24 24" class="color-blue"><g><path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z"></path></g></svg>
                 </div>
                   <h4><?php echo $profileData->firstName." ".$profileData->lastName; ?></h4>
                </div>
                <div class="profileHeaderContainer">
                    <div class="coverPhotoContainer">
                    <?php if(!empty($profileData->profileCover)): ?>
                      <img class="cover-photo-user-me" src="<?php echo url_for($profileData->profileCover); ?>" alt="User's Cover photo">
                    <?php endif; ?>
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
                        <span class="description">
                             <svg viewBox="0 0 24 24" class=""><g><path d="M19.708 2H4.292C3.028 2 2 3.028 2 4.292v15.416C2 20.972 3.028 22 4.292 22h15.416C20.972 22 22 20.972 22 19.708V4.292C22 3.028 20.972 2 19.708 2zm.792 17.708c0 .437-.355.792-.792.792H4.292c-.437 0-.792-.355-.792-.792V6.418c0-.437.354-.79.79-.792h15.42c.436 0 .79.355.79.79V19.71z"></path><circle cx="7.032" cy="8.75" r="1.285"></circle><circle cx="7.032" cy="13.156" r="1.285"></circle><circle cx="16.968" cy="8.75" r="1.285"></circle><circle cx="16.968" cy="13.156" r="1.285"></circle><circle cx="12" cy="8.75" r="1.285"></circle><circle cx="12" cy="13.156" r="1.285"></circle><circle cx="7.032" cy="17.486" r="1.285"></circle><circle cx="12" cy="17.486" r="1.285"></circle></g></svg>
                             <span class="join">Joined</span>
                             <span class="description__date"><?php echo date("F Y",$d); ?></span>
                        </span>
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