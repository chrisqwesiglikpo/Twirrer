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
                       <div class="add__wrapper"> 
                            <div aria-label="Add photo" role="button" data-focusable="true" tabindex="0" class="add-photo">
                                <label for="addPhoto" title="Upload Photo">
                                    <svg viewBox="0 0 24 24" class="photo-icon"><g><path d="M19.75 2H4.25C3.01 2 2 3.01 2 4.25v15.5C2 20.99 3.01 22 4.25 22h15.5c1.24 0 2.25-1.01 2.25-2.25V4.25C22 3.01 20.99 2 19.75 2zM4.25 3.5h15.5c.413 0 .75.337.75.75v9.676l-3.858-3.858c-.14-.14-.33-.22-.53-.22h-.003c-.2 0-.393.08-.532.224l-4.317 4.384-1.813-1.806c-.14-.14-.33-.22-.53-.22-.193-.03-.395.08-.535.227L3.5 17.642V4.25c0-.413.337-.75.75-.75zm-.744 16.28l5.418-5.534 6.282 6.254H4.25c-.402 0-.727-.322-.744-.72zm16.244.72h-2.42l-5.007-4.987 3.792-3.85 4.385 4.384v3.703c0 .413-.337.75-.75.75z"></path><circle cx="8.868" cy="8.309" r="1.542"></circle></g></svg>
                                </label>
                                <input type="file" name="addPhoto" id="addPhoto">
                            </div>
                            <div class="add__gif" id="gifBtn" aria-label="Add a GIF" role="button" data-fucsable="true" tabindex="0">
                                  <svg viewBox="0 0 24 24" class="gif__image"><g><path d="M19 10.5V8.8h-4.4v6.4h1.7v-2h2v-1.7h-2v-1H19zm-7.3-1.7h1.7v6.4h-1.7V8.8zm-3.6 1.6c.4 0 .9.2 1.2.5l1.2-1C9.9 9.2 9 8.8 8.1 8.8c-1.8 0-3.2 1.4-3.2 3.2s1.4 3.2 3.2 3.2c1 0 1.8-.4 2.4-1.1v-2.5H7.7v1.2h1.2v.6c-.2.1-.5.2-.8.2-.9 0-1.6-.7-1.6-1.6 0-.8.7-1.6 1.6-1.6z"></path><path d="M20.5 2.02h-17c-1.24 0-2.25 1.007-2.25 2.247v15.507c0 1.238 1.01 2.246 2.25 2.246h17c1.24 0 2.25-1.008 2.25-2.246V4.267c0-1.24-1.01-2.247-2.25-2.247zm.75 17.754c0 .41-.336.746-.75.746h-17c-.414 0-.75-.336-.75-.746V4.267c0-.412.336-.747.75-.747h17c.414 0 .75.335.75.747v15.507z"></path></g></svg>
                            </div>
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
                <div id="popUpGif" class="gif-modal-container">
                        <div class="modal-content gif__content">
                            <div class="modal-header gif__header">
                                <span class="closeGif" aria-label="Close" data-focusable="true" role="button" tabindex="0"><svg viewBox="0 0 24 24" class="close-icon"><g><path d="M13.414 12l5.793-5.793c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0L12 10.586 6.207 4.793c-.39-.39-1.023-.39-1.414 0s-.39 1.023 0 1.414L10.586 12l-5.793 5.793c-.39.39-.39 1.023 0 1.414.195.195.45.293.707.293s.512-.098.707-.293L12 13.414l5.793 5.793c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L13.414 12z"></path></g></svg></span>
                                <div class="gif__search-container">
                                    <input type="text" placeholder="Search for Gifs" class="gif__input">
                                    <svg viewBox="0 0 24 24" class="search-icon__gif"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
                                </div>
                            </div>
                            <div class="gif__body">
                             
                            </div> 
                            
                        
                        
                        </div>
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
<script src="<?php echo url_for('frontend/assets/js/gif.js'); ?>"></script>
<script src="<?php echo url_for('frontend/assets/js/liveSearch.js'); ?>"></script>
<script src="<?php echo url_for('frontend/assets/js/fetch.js'); ?>"></script>
<script src="<?php echo url_for('frontend/assets/js/toggleFollow.js'); ?>"></script>
<?php require_once 'backend/shared/mainFooter.php'; ?>