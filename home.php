<?php
require_once 'backend/shared/mainHeader.php';
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
                        <textarea  id="postTextarea" placeholder="What's happening?" aria-label="What's happening?" autofocus></textarea>
                        <div class="hash-box">
                           <ul></ul>
                        </div>
                        <div aria-label="Media" role="group" class="postImageContainer">
                                <div class="postImageContainer__wrapper">
                                    <img src="" draggable="false" alt="" id="postImageItem">
                                </div>
                        </div>
                        <div class="blank-hr"></div>
                        <div aria-label="Add photo" role="button" data-focusable="true" tabindex="0" class="add-photo">
                            <label for="addPhoto" title="Upload Photo">
                                <svg viewBox="0 0 24 24" class="photo-icon"><g><path d="M19.75 2H4.25C3.01 2 2 3.01 2 4.25v15.5C2 20.99 3.01 22 4.25 22h15.5c1.24 0 2.25-1.01 2.25-2.25V4.25C22 3.01 20.99 2 19.75 2zM4.25 3.5h15.5c.413 0 .75.337.75.75v9.676l-3.858-3.858c-.14-.14-.33-.22-.53-.22h-.003c-.2 0-.393.08-.532.224l-4.317 4.384-1.813-1.806c-.14-.14-.33-.22-.53-.22-.193-.03-.395.08-.535.227L3.5 17.642V4.25c0-.413.337-.75.75-.75zm-.744 16.28l5.418-5.534 6.282 6.254H4.25c-.402 0-.727-.322-.744-.72zm16.244.72h-2.42l-5.007-4.987 3.792-3.85 4.385 4.384v3.703c0 .413-.337.75-.75.75z"></path><circle cx="8.868" cy="8.309" r="1.542"></circle></g></svg>
                            </label>
                            <input type="file" name="addPhoto" id="addPhoto">
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
                   
                </div> 
                <div class="reply-wrapper">
                </div>
                <div class="d-wrapper-container">
                   
                </div>
                <div class="del-post-wrapper-container">
                   
                </div>
                <div class="pin-post-wrapper-container">
                   
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
            <div class="aside-fixed">
                <section class="trends" aria-labelledby="accessible-list-0" role="region">
                <div class="trends-container">
                    <div class="trends-container__header">
                        <h1 aria-level="1" role="heading">Trends for you</h1>
                    </div>
                    <div class="trends-body" aria-label="Timeline: Trending now">
                    <?php $loadFromPost->trends(); ?>
                    
                    </div>
                </div>
    
                </section>
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
            </div>
        </aside>
        </main>
</section>
<script src="<?php echo url_for('frontend/assets/js/reply.js'); ?>"></script>
<script src="<?php echo url_for('frontend/assets/js/liveSearch.js'); ?>"></script>
<script src="<?php echo url_for('frontend/assets/js/fetch.js'); ?>"></script>
<script src="<?php echo url_for('frontend/assets/js/toggleFollow.js'); ?>"></script>
<?php require_once 'backend/shared/mainFooter.php'; ?>