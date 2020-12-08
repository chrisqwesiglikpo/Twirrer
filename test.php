<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply Modal</title>
    <style>
    
    </style>
</head>
<body>
    <button id="replyModal">Reply</button>
    <div class="reply-wrapper">
       <div class="reply-modal-content">
           <div class="reply-modal-header">
               <span class="close" aria-label="Close" data-focusable="true" role="button" tabindex="0"><svg viewBox="0 0 24 24" class="close-icon"><g><path d="M13.414 12l5.793-5.793c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0L12 10.586 6.207 4.793c-.39-.39-1.023-.39-1.414 0s-.39 1.023 0 1.414L10.586 12l-5.793 5.793c-.39.39-.39 1.023 0 1.414.195.195.45.293.707.293s.512-.098.707-.293L12 13.414l5.793 5.793c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L13.414 12z"></path></g></svg></span>
           </div>
           <div class="reply-modal-body">
               <div class="reply-container">
                   <div class="reply-wrapper-image">
                       <img src="frontend/assets/images/profilePic.jpeg" alt="">
                   </div>
                  <div class="reply-content-wrapper">
                        <div class="reply-content-desc">
                            <div class="reply-user-fullName">
                                Florin Pop
                            </div>
                            <div class="reply-username">
                                @florinpop175
                            </div>
                            <div class="reply-desc-date">
                                <span class="reply-date-time">.</span> 1h
                            </div>
                        </div>
                        <div class="reply-desc-text">
                            My first year on Youtube.Video incoming!
                        </div>
                        <div class="reply-to-desc">
                            <span class="reply-to">Reply to</span> <a href="#" class="reply-username-link">@florinpop175</a>
                        </div>
                  </div>
               </div>
               <div class="vertical-pip"></div>
               <div class="reply-user-msg">
                    <div class="reply-wrapper-image">
                            <img src="frontend/assets/images/profilePic.jpeg" alt="">
                    </div>
                    <textarea id="reply-input" placeholder="Tweet your reply" autofocus></textarea>
               </div>
           </div>
           <div class="reply-modal-footer">
                <div class="reply-btn" id="reply-btn" role="button" data-focusable="true" tabindex="0">
                             <span class="reply-post-text">Reply</span>
                </div>
           </div>
       </div>
    </div>
</body>
</html>