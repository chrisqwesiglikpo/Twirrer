<?php
require_once 'PostControls.php';
class Post extends User{
    protected $con;
    function __construct(){
        $this->con=Database::instance();
    }
    public function posts($user_id,$num){
        $userdata=$this->userData($user_id);
        $stmt=$this->con->prepare("SELECT * FROM post p LEFT JOIN users u ON p.userId = u.user_id  WHERE  p.userId =:user_id
        UNION
    SELECT * FROM post p LEFT JOIN users u ON p.userId = u.user_id  WHERE p.userId IN (SELECT follow.receiver FROM follow WHERE follow.sender =:user_id ) ORDER BY postedOn DESC LIMIT :num");

        $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
        $stmt->bindParam(":num",$num,PDO::PARAM_INT);
        $stmt->execute();
        $posts=$stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($posts as $post){   
        $postControls=new PostControls;
        $controls=$postControls->createControls($post->post_id,$post->postBy,$user_id);
        $retweet=$this->checkRetweet($user_id,$post->post_id);
       
        if(!empty($retweet)){
            $retweetUserData=$this->userData($retweet["retweetBy"]); 
        }
        if((!empty($retweet['retweetBy']))==$user_id && $retweet['status'] != ""){
      echo '<div class="post">
             <div class="retweet-text-reply mainContentContainer">
                  <div class="userImageContainer">
                      <img src="'.url_for($retweetUserData->profilePic).'" alt="User Profile Pic">
                  </div>
                  <div class="postContentContainer">
                      <div class="post-header">
                          <a href="'.url_for(h(u($retweetUserData->username))).'" class="displayName">'.$retweetUserData->firstName." ".$retweetUserData->lastName.'</a>
                          <span class="username">@'.$retweetUserData->username.'</span>
                          <span class="date"><span class="dot-retweet">.</span>'.$this->timeAgo($retweet['tweetedOn']).'</span> 
                      </div>
                      <div class="post-body">
                            <div class="retweet-text-content">'.$this->getTweetLinks($retweet['status']).'</div>
                            <div class="retweet-content-post-container">
                                <div class="retweet-content-body-header">
                                    <div class="retweet-content-header-img-wrapper">
                                        <img src="'.url_for($post->profilePic).'" alt="">
                                    </div>
                                    <div class="retweet-content-body-header-fullName">
                                    '.$post->firstName.' '.$post->lastName.'
                                    </div>
                                    <div class="retweet-content-body-header-username">
                                        @'.$post->username.'
                                    </div>
                                    <div class="retweet-content-body-header-date">
                                        <span class="dot-date-header">.</span>'.$this->timeAgo($post->postedOn).'
                                    </div>
                                </div>
                                <div class="retweet-content-body-post">
                                   <div>'.$this->getTweetLinks($post->post).'</div>
                               </div>
                            </div>
                      </div>
                      '.$controls.'
                  </div>
             </div>
            
  </div>';
        }else{
            echo  '<div class="post">
            '.(((!empty($retweet['retweetBy']))==$user_id) ? '<div class="retweet-header"><div class="retweet-image">
                <svg viewBox="0 0 24 24"><g><path d="M23.615 15.477c-.47-.47-1.23-.47-1.697 0l-1.326 1.326V7.4c0-2.178-1.772-3.95-3.95-3.95h-5.2c-.663 0-1.2.538-1.2 1.2s.537 1.2 1.2 1.2h5.2c.854 0 1.55.695 1.55 1.55v9.403l-1.326-1.326c-.47-.47-1.23-.47-1.697 0s-.47 1.23 0 1.697l3.374 3.375c.234.233.542.35.85.35s.613-.116.848-.35l3.375-3.376c.467-.47.467-1.23-.002-1.697zM12.562 18.5h-5.2c-.854 0-1.55-.695-1.55-1.55V7.547l1.326 1.326c.234.235.542.352.848.352s.614-.117.85-.352c.468-.47.468-1.23 0-1.697L5.46 3.8c-.47-.468-1.23-.468-1.697 0L.388 7.177c-.47.47-.47 1.23 0 1.697s1.23.47 1.697 0L3.41 7.547v9.403c0 2.178 1.773 3.95 3.95 3.95h5.2c.664 0 1.2-.538 1.2-1.2s-.535-1.2-1.198-1.2z"></path></g></svg></div>
                <div class="retweet-user-link">
               <a href="'.url_for(h(u($retweetUserData->username))).'" role="link" data-focusable="true" class="retweet-link">
                            <span>'.$retweetUserData->firstName.' '.$retweetUserData->lastName.' Retweeted</span>
               </a>
            </div>
    </div>' : '' ).'
             <div class="mainContentContainer">
                  <div class="userImageContainer">
                      <img src="'.url_for($post->profilePic).'" alt="User Profile Pic">
                  </div>
                  <div class="postContentContainer">
                      <div class="post-header">
                          <div class="post-header-featured-left">
                                <a href="'.url_for(h(u($post->username))).'" class="displayName">'.$post->firstName.' '.$post->lastName.'</a>
                                <span class="username">@'.$post->username.'</span>
                                <span class="date">'.$this->timeAgo($post->postedOn).'</span>
                          </div>
                         ' .(($post->postBy===$user_id) ? '<span class="dot deletePostButton" id="deletePostModal" data-post="'.$post->post_id.'" data-postedby="'.$post->postBy.'" data-user="'.$user_id.'"><svg viewBox="0 0 24 24" class="dot-icon"><g><path d="M19.39 14.882c-1.58 0-2.862-1.283-2.862-2.86s1.283-2.862 2.86-2.862 2.862 1.283 2.862 2.86-1.284 2.862-2.86 2.862zm0-4.223c-.75 0-1.362.61-1.362 1.36s.61 1.36 1.36 1.36 1.362-.61 1.362-1.36-.61-1.36-1.36-1.36zM12 14.882c-1.578 0-2.86-1.283-2.86-2.86S10.42 9.158 12 9.158s2.86 1.282 2.86 2.86S13.578 14.88 12 14.88zm0-4.223c-.75 0-1.36.61-1.36 1.36s.61 1.362 1.36 1.362 1.36-.61 1.36-1.36-.61-1.363-1.36-1.363zm-7.39 4.223c-1.577 0-2.86-1.283-2.86-2.86S3.034 9.16 4.61 9.16s2.862 1.283 2.862 2.86-1.283 2.862-2.86 2.862zm0-4.223c-.75 0-1.36.61-1.36 1.36s.61 1.36 1.36 1.36 1.362-.61 1.362-1.36-.61-1.36-1.36-1.36z"></path></g></svg></span>' : '' ).' 
                      </div>
                      <div class="post-body" data-post="'.$post->post_id.'" data-postedBy="'.$post->postBy.'">
                          <div>'.$this->getTweetLinks($post->post).'</div>
                          '.((!empty($post->postImage)) ? '<div class="postContentContainer__postImage" araia-label="PostImage">
                          <img src="'.url_for($post->postImage).'" alt="image"/>
                              </div>' : '').'
                      </div>
                      '.$controls.'
                  </div>
             </div>
            
  </div>';
        }
         
       
            
        }
    }
    public function getHashTag($hashtag,$user_id){
        // echo $hashtag;
        $stmt=$this->con->prepare("SELECT * FROM post p INNER JOIN trends t ON p.post_id=t.postId WHERE hashtag=:hashtag");
        $stmt->bindParam(":hashtag",$hashtag,PDO::PARAM_STR);
        $stmt->execute();
        $getHashTag=$stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($getHashTag as $post){
            $userdata = $this->userData($post->postBy);
            $postControls=new PostControls;
           $controls=$postControls->createControls($post->post_id,$post->postBy,$user_id);
           $retweet=$this->checkRetweet($user_id,$post->post_id);
          //var_dump($retweet);
           if(!empty($retweet)){
            $retweetUserData=$this->userData($retweet["retweetBy"]); 
           }
                 echo  '<div class="post">
                  '.(((!empty($retweet['retweetBy']))==$user_id) ? '<div class="retweet-header"><div class="retweet-image">
                      <svg viewBox="0 0 24 24"><g><path d="M23.615 15.477c-.47-.47-1.23-.47-1.697 0l-1.326 1.326V7.4c0-2.178-1.772-3.95-3.95-3.95h-5.2c-.663 0-1.2.538-1.2 1.2s.537 1.2 1.2 1.2h5.2c.854 0 1.55.695 1.55 1.55v9.403l-1.326-1.326c-.47-.47-1.23-.47-1.697 0s-.47 1.23 0 1.697l3.374 3.375c.234.233.542.35.85.35s.613-.116.848-.35l3.375-3.376c.467-.47.467-1.23-.002-1.697zM12.562 18.5h-5.2c-.854 0-1.55-.695-1.55-1.55V7.547l1.326 1.326c.234.235.542.352.848.352s.614-.117.85-.352c.468-.47.468-1.23 0-1.697L5.46 3.8c-.47-.468-1.23-.468-1.697 0L.388 7.177c-.47.47-.47 1.23 0 1.697s1.23.47 1.697 0L3.41 7.547v9.403c0 2.178 1.773 3.95 3.95 3.95h5.2c.664 0 1.2-.538 1.2-1.2s-.535-1.2-1.198-1.2z"></path></g></svg></div>
                      <div class="retweet-user-link">
                     <a href="'.url_for(h(u($retweetUserData->username))).'" role="link" data-focusable="true" class="retweet-link">
                                  <span>'.$retweetUserData->firstName.' '.$retweetUserData->lastName.' Retweeted</span>
                     </a>
                  </div>
          </div>' : '' ).'
                   <div class="mainContentContainer">
                        <div class="userImageContainer">
                            <img src="'.url_for($userdata->profilePic).'" alt="User Profile Pic">
                        </div>
                        <div class="postContentContainer">
                            <div class="post-header">
                                <div class="post-header-featured-left">
                                      <a href="'.url_for(h(u($userdata->username))).'" class="displayName">'.$userdata->firstName.' '.$userdata->lastName.'</a>
                                      <span class="username">@'.$userdata->username.'</span>
                                      <span class="date">'.$this->timeAgo($post->postedOn).'</span>
                                </div>
                               ' .(($post->postBy===$user_id) ? '<span class="dot deletePostButton" id="deletePostModal" data-post="'.$post->post_id.'" data-postedby="'.$post->postBy.'" data-user="'.$user_id.'"><svg viewBox="0 0 24 24" class="dot-icon"><g><path d="M19.39 14.882c-1.58 0-2.862-1.283-2.862-2.86s1.283-2.862 2.86-2.862 2.862 1.283 2.862 2.86-1.284 2.862-2.86 2.862zm0-4.223c-.75 0-1.362.61-1.362 1.36s.61 1.36 1.36 1.36 1.362-.61 1.362-1.36-.61-1.36-1.36-1.36zM12 14.882c-1.578 0-2.86-1.283-2.86-2.86S10.42 9.158 12 9.158s2.86 1.282 2.86 2.86S13.578 14.88 12 14.88zm0-4.223c-.75 0-1.36.61-1.36 1.36s.61 1.362 1.36 1.362 1.36-.61 1.36-1.36-.61-1.363-1.36-1.363zm-7.39 4.223c-1.577 0-2.86-1.283-2.86-2.86S3.034 9.16 4.61 9.16s2.862 1.283 2.862 2.86-1.283 2.862-2.86 2.862zm0-4.223c-.75 0-1.36.61-1.36 1.36s.61 1.36 1.36 1.36 1.362-.61 1.362-1.36-.61-1.36-1.36-1.36z"></path></g></svg></span>' : '' ).' 
                            </div>
                            <div class="post-body" data-post="'.$post->post_id.'" data-postedBy="'.$post->postBy.'">
                                <div>'.$this->getTweetLinks($post->post).'</div>
                                '.((!empty($post->postImage)) ? '<div class="postContentContainer__postImage" araia-label="PostImage">
                                <img src="'.url_for($post->postImage).'" alt="image"/>
                                    </div>' : '').'
                            </div>
                            '.$controls.'
                        </div>
                   </div>
                  
        </div>';
              
            
        }
        // $userdata=$this->userData($user_id);
        // $stmt=$this->con->prepare("SELECT * FROM trends t INNER JOIN post p On p.post_id=t.postId WHERE hashtag=:hashtag ORDER BY postedOn DESC");

        // $stmt->bindParam(":hashtag",$hashtag,PDO::PARAM_INT);
        // // $stmt->bindParam(":num",$num,PDO::PARAM_INT);
        // $stmt->execute();
        // $posts=$stmt->fetchAll(PDO::FETCH_OBJ);
        // var_dump($posts);
    }
    public function profilePosts($user_id, $profileId, $num){
        $userdata = $this->userData($user_id);

        $stmt= $this->con->prepare("SELECT * FROM users  LEFT JOIN post ON post.userId = users.user_id WHERE post.userId = :user_id ORDER BY post.postedOn DESC LIMIT :num");

        $stmt->bindParam(":user_id", $profileId, PDO::PARAM_INT);
        $stmt->bindParam(":num", $num, PDO::PARAM_INT);
        $stmt->execute();
        $posts=$stmt->fetchAll(PDO::FETCH_OBJ);

        foreach($posts as $post){
            $postControls=new PostControls;
            $controls=$postControls->createControls($post->post_id,$post->postBy,$user_id);
            $retweet=$this->checkRetweet($user_id,$post->post_id);
            if(!empty($retweet)){
                $retweetUserData=$this->userData($retweet["retweetBy"]); 
            }
            if((!empty($retweet['retweetBy']))==$user_id && $retweet['status'] != ""){
          echo '<div class="post">
                 <div class="retweet-text-reply mainContentContainer">
                      <div class="userImageContainer">
                          <img src="'.url_for($retweetUserData->profilePic).'" alt="User Profile Pic">
                      </div>
                      <div class="postContentContainer">
                          <div class="post-header">
                              <a href="'.url_for(h(u($retweetUserData->username))).'" class="displayName">'.$retweetUserData->firstName." ".$retweetUserData->lastName.'</a>
                              <span class="username">@'.$retweetUserData->username.'</span>
                              <span class="date"><span class="dot-retweet">.</span>'.$this->timeAgo($retweet['tweetedOn']).'</span> 
                          </div>
                          <div class="post-body">
                                <div class="retweet-text-content">'.$this->getTweetLinks($retweet['status']).'</div>
                                <div class="retweet-content-post-container">
                                    <div class="retweet-content-body-header">
                                        <div class="retweet-content-header-img-wrapper">
                                            <img src="'.url_for($post->profilePic).'" alt="">
                                        </div>
                                        <div class="retweet-content-body-header-fullName">
                                        '.$post->firstName.' '.$post->lastName.'
                                        </div>
                                        <div class="retweet-content-body-header-username">
                                            @'.$post->username.'
                                        </div>
                                        <div class="retweet-content-body-header-date">
                                            <span class="dot-date-header">.</span>'.$this->timeAgo($post->postedOn).'
                                        </div>
                                    </div>
                                    <div class="retweet-content-body-post">
                                       <div>'.$this->getTweetLinks($post->post).'</div>
                                       '.((!empty($post->postImage)) ? '<div class="postContentContainer__postImage" araia-label="PostImage">
                                       <img src="'.url_for($post->postImage).'" alt="image"/>
                                           </div>' : '').'
                                   </div>
                                </div>
                          </div>
                          '.$controls.'
                      </div>
                 </div>
                
      </div>';
            }else{
                echo  '<div class="post">
                '.(((!empty($retweet['retweetBy']))==$user_id) ? '<div class="retweet-header"><div class="retweet-image">
                    <svg viewBox="0 0 24 24"><g><path d="M23.615 15.477c-.47-.47-1.23-.47-1.697 0l-1.326 1.326V7.4c0-2.178-1.772-3.95-3.95-3.95h-5.2c-.663 0-1.2.538-1.2 1.2s.537 1.2 1.2 1.2h5.2c.854 0 1.55.695 1.55 1.55v9.403l-1.326-1.326c-.47-.47-1.23-.47-1.697 0s-.47 1.23 0 1.697l3.374 3.375c.234.233.542.35.85.35s.613-.116.848-.35l3.375-3.376c.467-.47.467-1.23-.002-1.697zM12.562 18.5h-5.2c-.854 0-1.55-.695-1.55-1.55V7.547l1.326 1.326c.234.235.542.352.848.352s.614-.117.85-.352c.468-.47.468-1.23 0-1.697L5.46 3.8c-.47-.468-1.23-.468-1.697 0L.388 7.177c-.47.47-.47 1.23 0 1.697s1.23.47 1.697 0L3.41 7.547v9.403c0 2.178 1.773 3.95 3.95 3.95h5.2c.664 0 1.2-.538 1.2-1.2s-.535-1.2-1.198-1.2z"></path></g></svg></div>
                    <div class="retweet-user-link">
                   <a href="'.url_for(h(u($retweetUserData->username))).'" role="link" data-focusable="true" class="retweet-link">
                                <span>'.$retweetUserData->firstName.' '.$retweetUserData->lastName.' Retweeted</span>
                   </a>
                </div>
        </div>' : '' ).'
                 <div class="mainContentContainer">
                      <div class="userImageContainer">
                          <img src="'.url_for($post->profilePic).'" alt="User Profile Pic">
                      </div>
                      <div class="postContentContainer">
                          <div class="post-header">
                              <div class="post-header-featured-left">
                                    <a href="'.url_for(h(u($post->username))).'" class="displayName">'.$post->firstName.' '.$post->lastName.'</a>
                                    <span class="username">@'.$post->username.'</span>
                                    <span class="date">'.$this->timeAgo($post->postedOn).'</span>
                              </div>
                             ' .(($post->postBy===$user_id) ? '<span class="dot deletePostButton" id="deletePostModal" data-post="'.$post->post_id.'" data-postedby="'.$post->postBy.'" data-user="'.$user_id.'"><svg viewBox="0 0 24 24" class="dot-icon"><g><path d="M19.39 14.882c-1.58 0-2.862-1.283-2.862-2.86s1.283-2.862 2.86-2.862 2.862 1.283 2.862 2.86-1.284 2.862-2.86 2.862zm0-4.223c-.75 0-1.362.61-1.362 1.36s.61 1.36 1.36 1.36 1.362-.61 1.362-1.36-.61-1.36-1.36-1.36zM12 14.882c-1.578 0-2.86-1.283-2.86-2.86S10.42 9.158 12 9.158s2.86 1.282 2.86 2.86S13.578 14.88 12 14.88zm0-4.223c-.75 0-1.36.61-1.36 1.36s.61 1.362 1.36 1.362 1.36-.61 1.36-1.36-.61-1.363-1.36-1.363zm-7.39 4.223c-1.577 0-2.86-1.283-2.86-2.86S3.034 9.16 4.61 9.16s2.862 1.283 2.862 2.86-1.283 2.862-2.86 2.862zm0-4.223c-.75 0-1.36.61-1.36 1.36s.61 1.36 1.36 1.36 1.362-.61 1.362-1.36-.61-1.36-1.36-1.36z"></path></g></svg></span>' : '' ).' 
                          </div>
                          <div class="post-body" data-post="'.$post->post_id.'" data-postedBy="'.$post->postBy.'">
                                <div>'.$this->getTweetLinks($post->post).'</div>
                                '.((!empty($post->postImage)) ? '<div class="postContentContainer__postImage" araia-label="PostImage">
                                <img src="'.url_for($post->postImage).'" alt="image"/>
                                    </div>' : '').'
                          </div>
                          '.$controls.'
                      </div>
                 </div>
                
      </div>';
            }
             
        }
    }
    public function replyPosts($user_id,$profileId,$num){
        $userdata = $this->userData($user_id);

        $stmt= $this->con->prepare("SELECT * FROM users  LEFT JOIN comment ON comment.commentBy = users.user_id WHERE comment.commentBy= :user_id ORDER BY comment.commentAt DESC LIMIT :num");

        $stmt->bindParam(":user_id", $profileId, PDO::PARAM_INT);
        $stmt->bindParam(":num", $num, PDO::PARAM_INT);
        $stmt->execute();
        $posts=$stmt->fetchAll(PDO::FETCH_OBJ);

        foreach($posts as $post){
            $postControls=new PostControls;
            $controls=$postControls->createControls($post->commentID,$post->commentBy,$user_id);     
                echo  '<div class="post">
                 <div class="mainContentContainer">
                      <div class="userImageContainer">
                          <img src="'.url_for($post->profilePic).'" alt="User Profile Pic">
                      </div>
                      <div class="postContentContainer">
                          <div class="post-header">
                              <div class="post-header-featured-left">
                                    <a href="'.url_for(h(u($post->username))).'" class="displayName">'.$post->firstName.' '.$post->lastName.'</a>
                                    <span class="username">@'.$post->username.'</span>
                                    <span class="date">'.$this->timeAgo($post->commentAt).'</span>
                              </div>
                             ' .(($post->commentBy===$user_id) ? '<span class="dot deletePostButton" id="deletePostModal" data-post="'.$post->commentID.'" data-postedby="'.$post->commentBy.'" data-user="'.$user_id.'"><svg viewBox="0 0 24 24" class="dot-icon"><g><path d="M19.39 14.882c-1.58 0-2.862-1.283-2.862-2.86s1.283-2.862 2.86-2.862 2.862 1.283 2.862 2.86-1.284 2.862-2.86 2.862zm0-4.223c-.75 0-1.362.61-1.362 1.36s.61 1.36 1.36 1.36 1.362-.61 1.362-1.36-.61-1.36-1.36-1.36zM12 14.882c-1.578 0-2.86-1.283-2.86-2.86S10.42 9.158 12 9.158s2.86 1.282 2.86 2.86S13.578 14.88 12 14.88zm0-4.223c-.75 0-1.36.61-1.36 1.36s.61 1.362 1.36 1.362 1.36-.61 1.36-1.36-.61-1.363-1.36-1.363zm-7.39 4.223c-1.577 0-2.86-1.283-2.86-2.86S3.034 9.16 4.61 9.16s2.862 1.283 2.862 2.86-1.283 2.862-2.86 2.862zm0-4.223c-.75 0-1.36.61-1.36 1.36s.61 1.36 1.36 1.36 1.362-.61 1.362-1.36-.61-1.36-1.36-1.36z"></path></g></svg></span>' : '' ).' 
                          </div>
                          <div class="post-body" data-post="'.$post->commentID.'" data-postedBy="'.$post->commentBy.'">
                                <div>'.$this->getTweetLinks($post->comment).'</div>
                          </div>
                          '.$controls.'
                      </div>
                 </div>
                
      </div>';
            
             
        }
    }
    public function singlePost($postedby,$postId){
        $userId=$this->userIdByUsername($postedby);
        $stmt=$this->con->prepare("SELECT * FROM post p LEFT JOIN users u ON p.userId = u.user_id  WHERE  p.userId =:user_id AND p.post_id=:postId");

        $stmt->bindParam(":user_id",$userId,PDO::PARAM_INT);
        $stmt->bindParam(":postId",$postId,PDO::PARAM_INT);
        $stmt->execute();
        $posts=$stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($posts as $post){   
        $postControls=new PostControls;
        $controls=$postControls->createControls($postId,$post->postBy,$userId);
        $retweet=$this->checkRetweet($userId,$post->post_id);
        if(!empty($retweet)){
            $retweetUserData=$this->userData($retweet["retweetBy"]); 
        }
        if((!empty($retweet['retweetBy']))==$userId && $retweet['status'] != ""){
      echo '<div class="post">
             <div class="retweet-text-reply mainContentContainer">
                  <div class="userImageContainer">
                      <img src="'.url_for($retweetUserData->profilePic).'" alt="User Profile Pic">
                  </div>
                  <div class="postContentContainer">
                      <div class="post-header">
                          <a href="'.url_for(h(u($retweetUserData->username))).'" class="displayName">'.$retweetUserData->firstName." ".$retweetUserData->lastName.'</a>
                          <span class="username">@'.$retweetUserData->username.'</span>
                          <span class="date"><span class="dot-retweet">.</span>'.$this->timeAgo($retweet['tweetedOn']).'</span> 
                      </div>
                      <div class="post-body">
                            <div class="retweet-text-content">'.$this->getTweetLinks($retweet['status']).'</div>
                            <div class="retweet-content-post-container">
                                <div class="retweet-content-body-header">
                                    <div class="retweet-content-header-img-wrapper">
                                        <img src="'.url_for($post->profilePic).'" alt="">
                                    </div>
                                    <div class="retweet-content-body-header-fullName">
                                    '.$post->firstName.' '.$post->lastName.'
                                    </div>
                                    <div class="retweet-content-body-header-username">
                                        @'.$post->username.'
                                    </div>
                                    <div class="retweet-content-body-header-date">
                                        <span class="dot-date-header">.</span>'.$this->timeAgo($post->postedOn).'
                                    </div>
                                </div>
                                <div class="retweet-content-body-post">
                                   <div>'.$this->getTweetLinks($post->post).'</div>
                               </div>
                            </div>
                      </div>
                      '.$controls.'
                  </div>
             </div>
            
  </div>';
        }else{
            echo  '<div class="post">
            '.(((!empty($retweet['retweetBy']))==$userId) ? '<div class="retweet-header"><div class="retweet-image">
                <svg viewBox="0 0 24 24"><g><path d="M23.615 15.477c-.47-.47-1.23-.47-1.697 0l-1.326 1.326V7.4c0-2.178-1.772-3.95-3.95-3.95h-5.2c-.663 0-1.2.538-1.2 1.2s.537 1.2 1.2 1.2h5.2c.854 0 1.55.695 1.55 1.55v9.403l-1.326-1.326c-.47-.47-1.23-.47-1.697 0s-.47 1.23 0 1.697l3.374 3.375c.234.233.542.35.85.35s.613-.116.848-.35l3.375-3.376c.467-.47.467-1.23-.002-1.697zM12.562 18.5h-5.2c-.854 0-1.55-.695-1.55-1.55V7.547l1.326 1.326c.234.235.542.352.848.352s.614-.117.85-.352c.468-.47.468-1.23 0-1.697L5.46 3.8c-.47-.468-1.23-.468-1.697 0L.388 7.177c-.47.47-.47 1.23 0 1.697s1.23.47 1.697 0L3.41 7.547v9.403c0 2.178 1.773 3.95 3.95 3.95h5.2c.664 0 1.2-.538 1.2-1.2s-.535-1.2-1.198-1.2z"></path></g></svg></div>
                <div class="retweet-user-link">
               <a href="'.url_for(h(u($retweetUserData->username))).'" role="link" data-focusable="true" class="retweet-link">
                            <span>'.$retweetUserData->firstName.' '.$retweetUserData->lastName.' Retweeted</span>
               </a>
            </div>
    </div>' : '' ).'
             <div class="mainContentContainer">
                  <div class="userImageContainer">
                      <img src="'.url_for($post->profilePic).'" alt="User Profile Pic">
                  </div>
                  <div class="postContentContainer">
                      <div class="post-header">
                          <div class="post-header-featured-left">
                                <a href="'.url_for(h(u($post->username))).'" class="displayName">'.$post->firstName.' '.$post->lastName.'</a>
                                <span class="username">@'.$post->username.'</span>
                          </div>
                         ' .(($post->postBy===$userId) ? '<span class="dot deletePostButton" id="deletePostModal" data-post="'.$post->post_id.'" data-postedby="'.$post->postBy.'" data-user="'.$userId.'"><svg viewBox="0 0 24 24" class="dot-icon"><g><path d="M19.39 14.882c-1.58 0-2.862-1.283-2.862-2.86s1.283-2.862 2.86-2.862 2.862 1.283 2.862 2.86-1.284 2.862-2.86 2.862zm0-4.223c-.75 0-1.362.61-1.362 1.36s.61 1.36 1.36 1.36 1.362-.61 1.362-1.36-.61-1.36-1.36-1.36zM12 14.882c-1.578 0-2.86-1.283-2.86-2.86S10.42 9.158 12 9.158s2.86 1.282 2.86 2.86S13.578 14.88 12 14.88zm0-4.223c-.75 0-1.36.61-1.36 1.36s.61 1.362 1.36 1.362 1.36-.61 1.36-1.36-.61-1.363-1.36-1.363zm-7.39 4.223c-1.577 0-2.86-1.283-2.86-2.86S3.034 9.16 4.61 9.16s2.862 1.283 2.862 2.86-1.283 2.862-2.86 2.862zm0-4.223c-.75 0-1.36.61-1.36 1.36s.61 1.36 1.36 1.36 1.362-.61 1.362-1.36-.61-1.36-1.36-1.36z"></path></g></svg></span>' : '' ).' 
                      </div>
                      <div class="post-body" data-post="'.$post->post_id.'" data-postedBy="'.$post->postBy.'">
                            <div>'.$this->getTweetLinks($post->post).'</div>
                            '.((!empty($post->postImage)) ? '<div class="postContentContainer__postImage" araia-label="PostImage">
                            <img src="'.url_for($post->postImage).'" alt="image"/>
                                </div>' : '').'
                      </div>
                      '.$controls.'
                  </div>
             </div>
            
  </div>';
        }

        }
        
        
    }

   
    
    // public function replyPost($postId,$userId){
           
    //     $stmt=$this->con->prepare("SELECT * FROM `comment` LEFT JOIN `users` ON `commentBy`=`user_id` WHERE `commentOn` =:postId");

    //     // $stmt->bindParam(":user_id",$userId,PDO::PARAM_INT);
   
    //     $stmt->bindParam(":postId",$postId,PDO::PARAM_INT);
    //     $stmt->execute();
    //     $posts=$stmt->fetchAll(PDO::FETCH_OBJ);
    //     foreach($posts as $post){   
    //     $postControls=new PostControls;
    //     $controls=$postControls->createControls($post->commentOn,$post->commentBy,$userId);
    //     $retweet=$this->checkRetweet($userId,$post->commentOn);
    //     // $retweet=$this->checkRetweet($post->user_id,$postId);
    //     // if(!empty($retweet)){
    //     //     $retweetUserData=$this->userData($retweet["retweetBy"]); 
    //     // }
      
    //     echo  '<div class="post">
    //             '.(((!empty($retweet['retweetBy']))==$userId) ? '<div class="retweet-header"><div class="retweet-image">
    //                 <svg viewBox="0 0 24 24"><g><path d="M23.615 15.477c-.47-.47-1.23-.47-1.697 0l-1.326 1.326V7.4c0-2.178-1.772-3.95-3.95-3.95h-5.2c-.663 0-1.2.538-1.2 1.2s.537 1.2 1.2 1.2h5.2c.854 0 1.55.695 1.55 1.55v9.403l-1.326-1.326c-.47-.47-1.23-.47-1.697 0s-.47 1.23 0 1.697l3.374 3.375c.234.233.542.35.85.35s.613-.116.848-.35l3.375-3.376c.467-.47.467-1.23-.002-1.697zM12.562 18.5h-5.2c-.854 0-1.55-.695-1.55-1.55V7.547l1.326 1.326c.234.235.542.352.848.352s.614-.117.85-.352c.468-.47.468-1.23 0-1.697L5.46 3.8c-.47-.468-1.23-.468-1.697 0L.388 7.177c-.47.47-.47 1.23 0 1.697s1.23.47 1.697 0L3.41 7.547v9.403c0 2.178 1.773 3.95 3.95 3.95h5.2c.664 0 1.2-.538 1.2-1.2s-.535-1.2-1.198-1.2z"></path></g></svg></div>
    //                 <div class="retweet-user-link">
    //             <a href="'.url_for(h(u($retweetUserData->username))).'" role="link" data-focusable="true" class="retweet-link">
    //                             <span>'.$retweetUserData->firstName.' '.$retweetUserData->lastName.' Retweeted</span>
    //             </a>
    //             </div>
    //     </div>' : '' ).'
    //             <div class="mainContentContainer">
    //                 <div class="userImageContainer">
    //                     <img src="'.url_for($post->profilePic).'" alt="User Profile Pic">
    //                 </div>
    //                 <div class="postContentContainer">
    //                     <div class="post-header">
    //                         <div class="post-header-featured-left">
    //                                 <a href="'.url_for(h(u($post->username))).'" class="displayName">'.$post->firstName.' '.$post->lastName.'</a>
    //                                 <span class="username">@'.$post->username.'</span>
    //                         </div>
    //                         ' .(($post->commentBy===$userId) ? '<span class="dot deletePostButton" id="deletePostModal" data-post="'.$post->commentOn.'" data-postedby="'.$post->commentBy.'" data-user="'.$userId.'"><svg viewBox="0 0 24 24" class="dot-icon"><g><path d="M19.39 14.882c-1.58 0-2.862-1.283-2.862-2.86s1.283-2.862 2.86-2.862 2.862 1.283 2.862 2.86-1.284 2.862-2.86 2.862zm0-4.223c-.75 0-1.362.61-1.362 1.36s.61 1.36 1.36 1.36 1.362-.61 1.362-1.36-.61-1.36-1.36-1.36zM12 14.882c-1.578 0-2.86-1.283-2.86-2.86S10.42 9.158 12 9.158s2.86 1.282 2.86 2.86S13.578 14.88 12 14.88zm0-4.223c-.75 0-1.36.61-1.36 1.36s.61 1.362 1.36 1.362 1.36-.61 1.36-1.36-.61-1.363-1.36-1.363zm-7.39 4.223c-1.577 0-2.86-1.283-2.86-2.86S3.034 9.16 4.61 9.16s2.862 1.283 2.862 2.86-1.283 2.862-2.86 2.862zm0-4.223c-.75 0-1.36.61-1.36 1.36s.61 1.36 1.36 1.36 1.362-.61 1.362-1.36-.61-1.36-1.36-1.36z"></path></g></svg></span>' : '' ).' 
    //                     </div>
    //                     <div class="post-body" data-post="'.$post->commentOn.'" data-postedBy="'.$post->commentBy.'">
    //                             <div>'.$this->getTweetLinks($post->comment).'</div>
    //                     </div>
    //                     '.$controls.'
    //                 </div>
    //             </div>
                
    //     </div>';
        

    //     }
        
        
    // }

    public function comments($tweetId,$user_id){
        $stmt=$this->con->prepare("SELECT * FROM `comment` LEFT JOIN `users` ON `commentBy`=`user_id` WHERE `commentOn`=:tweetId");
        $stmt->bindParam(":tweetId",$tweetId,PDO::PARAM_INT);
        $stmt->execute();
        $comments=$stmt->fetchAll(PDO::FETCH_OBJ);
        // var_dump($comments);
        foreach($comments as $comment){
            $postControls=new PostControls;
            $controls=$postControls->createControls($tweetId,$comment->commentBy,$user_id);
            echo  '<div class="post">
              <div class="mainContentContainer">
                  <div class="userImageContainer">
                      <img src="'.url_for($comment->profilePic).'" alt="User Profile Pic">
                  </div>
                  <div class="postContentContainer">
                      <div class="post-header">
                          <div class="post-header-featured-left">
                                <a href="'.url_for(h(u($comment->username))).'" class="displayName">'.$comment->firstName.' '.$comment->lastName.'</a>
                                <span class="username">@'.$comment->username.'</span>
                                <span class="date">'.$this->timeAgo($comment->commentAt).'</span>
                          </div>
                         ' .(($comment->commentBy===$user_id) ? '<span class="dot deletePostButton" id="deletePostModal" data-comment="'.$comment->commentID.'" data-commentBy="'.$comment->commentBy.'" data-user="'.$user_id.'"><svg viewBox="0 0 24 24" class="dot-icon"><g><path d="M19.39 14.882c-1.58 0-2.862-1.283-2.862-2.86s1.283-2.862 2.86-2.862 2.862 1.283 2.862 2.86-1.284 2.862-2.86 2.862zm0-4.223c-.75 0-1.362.61-1.362 1.36s.61 1.36 1.36 1.36 1.362-.61 1.362-1.36-.61-1.36-1.36-1.36zM12 14.882c-1.578 0-2.86-1.283-2.86-2.86S10.42 9.158 12 9.158s2.86 1.282 2.86 2.86S13.578 14.88 12 14.88zm0-4.223c-.75 0-1.36.61-1.36 1.36s.61 1.362 1.36 1.362 1.36-.61 1.36-1.36-.61-1.363-1.36-1.363zm-7.39 4.223c-1.577 0-2.86-1.283-2.86-2.86S3.034 9.16 4.61 9.16s2.862 1.283 2.862 2.86-1.283 2.862-2.86 2.862zm0-4.223c-.75 0-1.36.61-1.36 1.36s.61 1.36 1.36 1.36 1.362-.61 1.362-1.36-.61-1.36-1.36-1.36z"></path></g></svg></span>' : '' ).' 
                      </div>
                      <div class="post-body" data-commentID="'.$comment->commentOn.'" data-commentBy="'.$comment->commentBy.'">
                            <div>'.$this->getTweetLinks($comment->comment).'</div>
                      </div>
                      '.$controls.'
                  </div>
             </div>
        </div>';
        }
    }
  
    public function trends(){
    	$stmt=$this->con->prepare("SELECT *,COUNT(`post_id`) AS `tweetsCount` FROM trends t LEFT JOIN post p ON p.post_id=t.postId AND post  LIKE CONCAT('%#',`hashtag`,'%') GROUP BY `hashtag` ORDER BY `tweetsCount` DESC  LIMIT 4");
    	$stmt->execute();
    	$trends=$stmt->fetchAll(PDO::FETCH_OBJ);
        if(!empty($trends)){
            foreach ($trends as $trend) {
            echo '<div class="trends-content" data-trend="'.$trend->trendID.'">
            <h2 aria-level="2" role="heading">#'.$trend->hashtag.'</h2>
            <div class="trends-text"><span class="trends-count">'.$trend->tweetsCount.'</span> Tweets</div>
            </div>';
            }
            echo '<div class="trends-footer">
                <a href="#">Show more</a>
            </div>';
       }
    	
    }
    public function getTrendNameById($trendID){
        $stmt=$this->con->prepare("SELECT  * FROM `trends` WHERE trendID=:trendID");
        $stmt->bindParam(':trendID',$trendID,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function getTrendByHash($hashtag){
        $stmt=$this->con->prepare("SELECT DISTINCT `hashtag` FROM `trends` WHERE `hashtag` LIKE :hashtag  LIMIT 5");
        $stmt->bindValue(':hashtag',$hashtag.'%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
     }

     public function getMention($mention){
		$stmt=$this->con->prepare("SELECT `user_id`,`username`,`screenName`,`profilePic` FROM `users` WHERE `username` LIKE :mention OR `screenName` LIKE :mention LIMIT 5");
		$stmt->bindValue(':mention',$mention.'%');
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
 
    public function notification($userid){
        $stmt = $this->con->prepare("SELECT * FROM notification LEFT JOIN users ON notification.notificationFrom = users.user_id WHERE notification.notificationFor = :userid  AND  notification.`notificationFrom` !=:userid ORDER BY notification.notificationOn DESC");
        $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
         $stmt->execute();
         $notification=$stmt->fetchAll(PDO::FETCH_OBJ);         
         if(!empty($notification)){
            foreach($notification as $notify){
                $profileid=$notify->notificationFrom;
                $userdata = $this->userData($profileid);
                if($notify->type=='follow'){
              echo '<div class="notify-container '.(($notify->status=='0')? 'unread-notification': 'read-notification').'" data-profileid="'.$profileid.'" data-post="'.$notify->postId.'">
                        <div class="notify-user-wrapper">
                            <svg viewBox="0 0 24 24" class="r-13gxpu9 r-4qtqp9 r-yyyyoo r-yucp9h r-dnmrzs r-bnwqim r-1plcrui r-lrvibr"><g><path d="M12.225 12.165c-1.356 0-2.872-.15-3.84-1.256-.814-.93-1.077-2.368-.805-4.392.38-2.826 2.116-4.513 4.646-4.513s4.267 1.687 4.646 4.513c.272 2.024.008 3.46-.806 4.392-.97 1.106-2.485 1.255-3.84 1.255zm5.849 9.85H6.376c-.663 0-1.25-.28-1.65-.786-.422-.534-.576-1.27-.41-1.968.834-3.53 4.086-5.997 7.908-5.997s7.074 2.466 7.91 5.997c.164.698.01 1.434-.412 1.967-.4.505-.985.785-1.648.785z"></path></g></svg>
                        </div>
                       <div class=notify-wrapper-content">
                            <div class="notify-wrapper-user">
                                    <a href="'.url_for(h(u($userdata->username))).'">
                                        <img src="'.url_for($userdata->profilePic).'"/>
                                    </a>
                            </div>
                            <div class="notify-content">
                                <a href="'.url_for(h(u($userdata->username))).'" class="notify-content__name">
                                    '.$userdata->firstName." ".$userdata->lastName.'
                                </a>
                                <div class="notify-content__text">
                                Followed you
                                </div>
                            </div>
                        </div>
                   </div>';
                }else  if($notify->type=='like'){
                    echo '<div class="liked-container '.(($notify->status=='0')? 'unread-notification': 'read-notification').'" data-profileid="'.$notify->notificationFor.'" data-post="'.$notify->postId.'">
                              <div class="liked-user-wrapper">
                              <svg viewBox="0 0 24 24" ><g><path d="M12 21.638h-.014C9.403 21.59 1.95 14.856 1.95 8.478c0-3.064 2.525-5.754 5.403-5.754 2.29 0 3.83 1.58 4.646 2.73.814-1.148 2.354-2.73 4.645-2.73 2.88 0 5.404 2.69 5.404 5.755 0 6.376-7.454 13.11-10.037 13.157H12z"></path></g></svg>
                              </div>
                             <div class=notify-wrapper-content">
                                  <div class="liked-wrapper-user">
                                          <a href="'.url_for(h(u($userdata->username))).'">
                                              <img src="'.url_for($userdata->profilePic).'"/>
                                          </a>
                                          <div class="liked-post">
                                         
                                          </div>
                                  </div>
                                  <div class="liked-content">
                                      <a href="'.url_for(h(u($userdata->username))).'" class="notify-content__name">
                                          '.$userdata->firstName." ".$userdata->lastName.'
                                      </a>
                                      <div class="notify-content__text">
                                       Liked your tweet
                                      </div>
                                  </div>
                              </div>
                         </div>';
                      }
            }
         }
         
    }

    public function notificationCount($userid){
        $stmt = $this->con->prepare("SELECT * FROM notification LEFT JOIN users ON notification.notificationFrom = users.user_id WHERE notification.notificationFor = :userid AND notification.notificationCount='0' AND notification.`notificationFrom` !=:userid ORDER BY notification.notificationOn DESC");
        $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
         $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    private function getChatUsers($userid,$num){
        $stmt = $this->con->prepare("SELECT * FROM chats WHERE chatFrom=:userid ORDER BY createdAt DESC LIMIT :num");
        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $stmt->bindParam(':num', $num, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
       
    }

    public function displayChatUsers($userid,$chatId,$num){
        $getChats=$this->getChatUsers($userid,$num);
        //echo $chatId;
        if(!empty($getChats)){
            foreach ($getChats as $getChat){
                $chats=json_decode($getChat->chatTo);

                $chatCount=count((array)$chats);
                if($chatCount ==1){
                   foreach($chats as $chatTo){
                    $chat_id=$getChat->chat_id;
                    $c_id=$chat_id==$chatId ? "c_id" : "";
                    $chatActive= $chat_id==$chatId ? "chatActive" : "";
                    $userdata=$this->userData($chatTo);
                    echo '<div class="resultsContainer__resultsListItem  '.$chatActive.'" data-chatid="'.$getChat->chat_id.'">
                            <a href="'.url_for($userdata->username).'" class="resultsContainerImage">
                                <img src="'.url_for($userdata->profilePic).'" alt="User profile pic" data-profileid="'.$userdata->user_id.'" class="'.$c_id.'">
                            </a>
                            <div class="resultsDetailsContainer ellipsis" data-chatid="'.$getChat->chat_id.'">
                                <span class="chat__heading ellipsis">'.$getChat->chatTitle.'</span>
                                <span class="chat__subtext ellipsis"></span>
                            </div>
                        </div>';
                    }
                }else if($chatCount ==2){
                    $chat_id=$getChat->chat_id;
                    $c_id=$chat_id==$chatId ? "c_id" : "";
                    $chatActive= $chat_id==$chatId ? "chatActive" : "";
                    echo '<div class="resultsContainer__resultsListItem  '.$chatActive.'" data-chatid="'.$getChat->chat_id.'">
                    <a  href="'.url_for('messages/'.$getChat->chat_id.'/participants').'"  class="resultsContainerImage groupChatMessage">';
                    foreach($chats as $chatTo){
                        $userdata=$this->userData($chatTo);
                            echo '<img src="'.url_for($userdata->profilePic).'" alt="User profile pic" data-profileid="'.$userdata->user_id.'" class="'. $c_id.'">';
                        }
                    echo '</a>
                    <div class="resultsDetailsContainer ellipsis" data-chatid="'.$getChat->chat_id.'">
                      <span class="chat__heading ellipsis">'.$getChat->chatTitle.'</span>
                      <span class="chat__subtext ellipsis"></span>
                    </div>
                  </div>';
                }else if($chatCount ==3){
                    $chat_id=$getChat->chat_id;
                    $c_id=$chat_id==$chatId ? "c_id" : "";
                    $chatActive= $chat_id==$chatId ? "chatActive" : "";
                    echo '<div class="resultsContainer__resultsListItem  '.$chatActive.'" data-chatid="'.$getChat->chat_id.'">
                    <a href="'.url_for('messages/'.$getChat->chat_id.'/participants').'"  class="resultsContainerImage groupChatMessage-three">';
                    foreach($chats as $chatTo){
                        $userdata=$this->userData($chatTo);
                            echo '<img src="'.url_for($userdata->profilePic).'" alt="User profile pic" data-profileid="'.$userdata->user_id.'" class="'.$c_id.'">';
                        }
                    echo '</a>
                    <div class="resultsDetailsContainer ellipsis" data-chatid="'.$getChat->chat_id.'">
                      <span class="chat__heading ellipsis">'.$getChat->chatTitle.'</span>
                      <span class="chat__subtext ellipsis"></span>
                    </div>
                  </div>';
                }
                else if($chatCount > 3){
                    $chat_id=$getChat->chat_id;
                    $c_id=$chat_id==$chatId ? "c_id" : "";
                    $chatActive= $chat_id==$chatId ? "chatActive" : "";
                    echo '<div class="resultsContainer__resultsListItem '.$chatActive.'" data-chatid="'.$getChat->chat_id.'">
                    <a href="'.url_for('messages/'.$getChat->chat_id.'/participants').'"  class="resultsContainerImage groupChatMessage-more">';
                    foreach($chats as $chatTo){
                        $userdata=$this->userData($chatTo);
                            echo '<img src="'.url_for($userdata->profilePic).'" alt="User profile pic" data-profileid="'.$userdata->user_id.'" class="'.$c_id.'">';
                        }
                    echo '</a>
                    <div class="resultsDetailsContainer ellipsis" data-chatid="'.$getChat->chat_id.'">
                      <span class="chat__heading ellipsis">'.$getChat->chatTitle.'</span>
                      <span class="chat__subtext ellipsis"></span>
                    </div>
                  </div>';
                }

                
            }
            
        }
    }
    
    public function getChatData($chatId,$userid){
        $stmt=$this->con->prepare("SELECT * FROM chats WHERE chatFrom=:userid AND chat_id=:chatID");
        $stmt->bindParam(":userid",$userid,PDO::PARAM_INT);
        $stmt->bindParam(":chatID",$chatId,PDO::PARAM_INT);
        $stmt->execute();
        if($stmt->rowCount() != 0){
             return $stmt->fetch(PDO::FETCH_OBJ);
        }
    }
    public function getUserChatName($userid){
        $stmt=$this->con->prepare("SELECT * FROM chats c LEFT JOIN users u ON c.chatTo=u.user_id WHERE chatFrom=:userid");
        $stmt->bindValue(":userid",$userid,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function notificationCountReset($userid){
        $stmt = $this->con->prepare("UPDATE notification SET notificationCount='1' WHERE notificationFor=:userid AND status='0'");
        $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
         $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function notificationStatusUpdate($userid,$postid,$profileId){
        $stmt = $this->con->prepare("UPDATE notification SET status='1' WHERE notificationFor=:userid AND postid=:postid AND notificationFrom=:profileid");
        $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
        $stmt->bindValue(':posrid', $postid, PDO::PARAM_INT);
        $stmt->bindValue(':profileid', $userid, PDO::PARAM_INT);
         $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function createTab($name,$href,$isSelected){
        $className=$isSelected ? "tab active" : "tab";
        return "<a href='$href' class='$className'> 
                   <span>$name</span>
                </a>";

    }

    // public function addTrend($hashtag){
	// 	preg_match_all("/#+([a-zA-Z0-9_]+)/i",$hashtag,$matches);
	// 	if($matches){
	// 		$result=array_values($matches[1]);
	// 	}
	// 	$sql ="INSERT INTO `trends` (`hashtag`,`createdOn`) VALUES (:hashtag,CURRENT_TIMESTAMP)";
	// 	// foreach ($result as $trend) {
	// 	// 	if($stmt=$this->con->prepare($sql)){
	// 	// 		$stmt->execute([':hashtag'=>$trend]);
	// 	// 	}
    //     // }
    //     if($stmt = $this->con->prepare($sql)){
    //         foreach($result as $trend){
    //             $stmt->bindValue(':hashtag', $trend);
    //         }
    //          $stmt->execute();
    //     }
    // }
    public function addTrend($hashtag,$postId,$userId){
		preg_match_all("/#+([a-zA-Z0-9_]+)/i",$hashtag,$matches);
		if($matches){
			$result=array_values($matches[1]);
		}
		$sql ="INSERT INTO `trends` (`hashtag`,`postId`,`userId`,`createdOn`) VALUES(:hashtag,:postId,:userId,CURRENT_TIMESTAMP)";
		foreach ($result as $trend) {
			if($stmt=$this->con->prepare($sql)){
				$stmt->execute(array(':hashtag'=>$trend,':postId'=>$postId,':userId'=>$userId));
			}
		}
	}

    
    public function getTweetLinks($tweet){
        $tweet=preg_replace("/(https?:\/\/)([\w]+.)([\w\.]+)/","<a href='$0' target='_blank'>$0</a>",$tweet);
        $tweet=preg_replace("/#([\w]+)/","<a href='".url_for('hashtag/$1')."'>$0</a>",$tweet);
        $tweet=preg_replace("/@([\w]+)/","<a href='".url_for('$1')."'>$0</a>",$tweet);
        return $tweet;
   }
   public function getMessageTo($user_id,$chatId){
        $stmt=$this->con->prepare("SELECT `messageTo` FROM `messages` WHERE messageFrom=:userID AND chatID=:chatId LIMIT 1");
        $stmt->bindParam(":userID",$user_id,PDO::PARAM_INT);
        $stmt->bindParam(":chatId",$chatId,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
   }

   public function getMessages($user_id,$chatId){
    //    $messageTos=$this->getUserMessage($user_id,$chatId);
    //TODO:FIX BUG
      $msgTo=$this->getMessageTo($user_id,$chatId);
      if(!empty($msgTo)){
        $msgToF=$msgTo->messageTo;
        $stmt=$this->con->prepare("SELECT * FROM `messages` LEFT JOIN `users` ON `messageFrom` =`user_id` WHERE `messageFrom`=:messageFrom AND `messageTo` =:user_id AND chatID=:chatId OR `messageTo`=:messageFrom AND `messageFrom`=:user_id AND chatID=:chatId ORDER BY messageOn");
        $stmt->bindParam(":messageFrom",$msgToF,PDO::PARAM_INT);
         $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
         $stmt->bindParam(":chatId",$chatId,PDO::PARAM_INT);
         $stmt->execute();
         $messages=$stmt->fetchAll(PDO::FETCH_OBJ);
         foreach ($messages as $message) {
             if($message->messageFrom===$user_id){
                 echo '<div class="rightChatMsg user-loggedIn-chat">
                 <div class="rightChat__wrapper" aria-expanded="false" role="button" data-focusable="true" tabindex="0">
                         <div class="rightChat__msg-wrapper">
                             <div class="chat__icons">
                                <div class="chat__wrapper">
                                    
                                </div>
                             </div>
                             <div class="chatText__you">
                               '.$message->message.'
                             </div>
                         </div>
                 </div>
              </div>';
             }else{
                 echo '<div class="leftChatMsg">
                 <div class="leftChat__wrapper" aria-expanded="false" role="button" data-focusable="true" tabindex="0">
                           <div class="leftChat__msg-wrapper">
                               <div class="chat__icons">
                               <div class="chat__wrapper">
                                   
                               </div>
                               </div>
                               <div class="chatLeftText__you">
                               '.$message->message.'
                               </div>
                           </div>
                   </div>
            </div>';
             }
         }

      }
      
    // $stmt=$this->con->prepare("SELECT * FROM `messages` WHERE messageFrom=:userID AND chatID=:chatId");
    // $stmt->bindParam(":userID",$user_id,PDO::PARAM_INT);
    // $stmt->bindParam(":chatId",$chatId,PDO::PARAM_INT);
    // $stmt->execute();
    // $data=$stmt->fetchAll(PDO::FETCH_OBJ);
    // foreach($data as $message){
    //     echo $message->messageTo;
    // }
    
    //     $stmt=$this->con->prepare("SELECT * FROM `messages` LEFT JOIN `users` ON `messageFrom` =`user_id` WHERE `messageFrom`=:messageFrom AND `messageTo` =:user_id AND `chatID`=:chatID OR `messageTo`=:messageFrom AND `messageFrom`=:user_id AND `chatID`=:chatID");
    //     foreach($messageTos as $messageTo){
           
    //     }
        // $stmt->bindParam(":messageFrom",$messageFrom,PDO::PARAM_INT);
        // $stmt->bindParam(":chatID",$chatId,PDO::PARAM_INT);
        // $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
        // $stmt->execute();
        // $messages=$stmt->fetchAll(PDO::FETCH_OBJ);
        // var_dump($messages);
   }

   private function getUserMessage($user_id,$chatId){
     $stmt=$this->con->prepare("SELECT `messageTo` FROM `messages` WHERE chatID=:chatId AND messageFrom=:userId");
     $stmt->bindParam(":chatId",$chatId,PDO::PARAM_INT);
     $stmt->bindParam(":userId",$user_id,PDO::PARAM_INT);
     $stmt->execute();
     if($stmt->rowCount() !=0){
        return $stmt->fetchAll(PDO::FETCH_OBJ);
        //$stmt=$this->con->prepare("SELECT * FROM `messages` LEFT JOIN `users` ON `messageFrom` =`user_id` WHERE `messageFrom`=:messageFrom AND `messageTo` =:user_id AND `chatID`=:chatID OR `messageTo`=:messageFrom AND `messageFrom`=:user_id AND `chatID`=:chatID");
        //foreach($message as $messageID){
        // echo $messageID->messageTo;
         
       // } 
     }
    
   } 
   public function lastPersonWithAllUserMSG($userid){
    $stmt = $this->pdo->prepare("SELECT * FROM messages  LEFT JOIN users ON messages.messageFrom = users.user_id WHERE (messages.messageTo = :userid OR messages.messageFrom = :userid) AND messages.chatID IN (SELECT MAX(messages.messageID) FROM messages GROUP BY messages.messageTo, messages.messageFrom ORDER BY messages.messageID DESC)  ORDER BY messages.messageOn DESC;");
    $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}


public function lastPersonMsg($userid){
    $stmt = $this->pdo->prepare("SELECT * FROM profile LEFT JOIN messages ON profile.userId = (SELECT IF(messages.messageTo =:userid, messages.messageFrom, messages.messageTo)) WHERE (messages.messageFrom = :userid OR messages.messageTo = :userid) ORDER BY messages.messageOn DESC LIMIT 0, 1");
    $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
}
   public function messageData($userid, $lastpersonid){
    $stmt = $this->pdo->prepare("SELECT * FROM messages LEFT JOIN profile ON profile.userId = messages.messageFrom WHERE (messageTo = :userid and messageFrom=:otherid) OR (messageTo = :otherid and messageFrom=:userid) ORDER BY messageOn ASC");
    $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
    $stmt->bindParam(":otherid", $lastpersonid, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

   public function getModalPost($post_id,$postedby){
       $stmt=$this->con->prepare("SELECT * FROM `post` LEFT JOIN `users` ON users.user_id=post.userId WHERE post_id=:post_id AND `postBy`=:postedBy");
       $stmt->bindParam(":post_id",$post_id,PDO::PARAM_INT);
       $stmt->bindParam(":postedBy",$postedby,PDO::PARAM_INT);
       $stmt->execute();
       return $stmt->fetch(PDO::FETCH_OBJ);
   }
    public function createFollowButton($user,$isFollowing){
        $text=$isFollowing ? "Following" :"Follow";
        $buttonClass=$isFollowing ? "followButton follow" : "followButton";
        return "<button class='$buttonClass' data-user='$user->user_id'>$text</button>";
    }

    public function checkRetweet($user_id,$post_id) {
        $stmt=$this->con->prepare("SELECT * FROM `retweet` WHERE `retweetBy`=:user_id AND `retweetFrom`=:tweet_id");
        $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
        $stmt->bindParam(":tweet_id",$post_id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        // $stmt->errorInfo();
        // echo "<pre>";
        // $stmt->debugDumpParams();
        // echo "</pre>";
    }  
 
    public function getRetweet($postId){
        $stmt=$this->con->prepare("SELECT count(*) as 'count' FROM `retweet` WHERE `retweetFrom`=:postId");
        $stmt->bindParam(":postId",$postId,PDO::PARAM_INT);
        $stmt->execute();

        $data=$stmt->fetch(PDO::FETCH_ASSOC);
       if($data["count"] > 0){
           return $data["count"];
       }

        
    }
    public function retweetCount($user_id,$postId,$comment){
        
        if($this->wasRetweetBy($user_id,$postId)){
            //User has already like
            $this->delete('retweet',['retweetBy'=>$user_id,'retweetFrom'=>$postId,'status'=>$comment]);
            $result=array("retweet"=>-1);
            return json_encode($result);
        }else{
            //User has not like
            $this->create('retweet',array('retweetBy'=>$user_id,'retweetFrom'=>$postId,'status'=>$comment));
           
            $result=array("retweet"=>1);
            return json_encode($result);
            
        }
   }

//    public function deleteRetweet($user_id,$postId){

//    }

   public function wasRetweetBy($user_id,$postId){
    $stmt=$this->con->prepare("SELECT * FROM retweet WHERE retweetBy=:user_id AND retweetFrom=:postId");
    $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
    $stmt->bindParam(":postId",$postId,PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->rowCount() > 0;  

}
    public function delete($table, $array){
        $sql = "DELETE FROM `{$table}`";
        $where = " WHERE ";
        foreach($array as $name=>$value){
            $sql .= "{$where} `{$name}` = :{$name}";
            $where = " AND ";
        }
        if($stmt = $this->con->prepare($sql)){
            foreach($array as $name=>$value){
                $stmt->bindValue(':'.$name, $value);
            }
             $stmt->execute();
        }

    }

    public function getLikes($postId){
        $stmt=$this->con->prepare("SELECT count(*) as 'count' FROM `likes` WHERE `likeOn`=:postId");
        $stmt->bindParam(":postId",$postId,PDO::PARAM_INT);
        $stmt->execute();

        $data=$stmt->fetch(PDO::FETCH_ASSOC);
       if($data["count"] > 0){
           return $data["count"];
       }

        
    }

    public function Likes($user_id,$postId){
        
         if($this->wasLikedBy($user_id,$postId)){
             //User has already like
             $this->delete('likes',['likeBy'=>$user_id,'likeOn'=>$postId]);
             $result=array("likes"=>-1);
             return json_encode($result);
         }else{
             //User has not like
             $this->create('likes',array('likeBy'=>$user_id,'likeOn'=>$postId));
             $result=array("likes"=>1);
             return json_encode($result);
             
         }
    }

    public function wasLikedBy($user_id,$postId){
        $stmt=$this->con->prepare("SELECT * FROM likes WHERE likeBy=:user_id AND likeOn=:postId");
        $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
        $stmt->bindParam(":postId",$postId,PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;  

    }

    public function comment($commentBy,$commentOn,$comment){
        
        if($this->wasCommentBy($commentBy,$commentOn)){
            //User has already like
            $this->delete('comment',['commentBy'=>$commentBy,'commentOn'=>$commentOn]);
            $result=array("comment"=>-1);
            return json_encode($result);
        }else{
            //User has not like
            $this->create('comment',array('commentBy'=>$commentBy,'commentOn'=>$commentOn,'comment'=>$comment));
            $result=array("comment"=>1);
            return json_encode($result);
            
        }
   }
   public function removeRetweet($user_id,$deretweet){
        if($this->wasRetweetBy($user_id,$deretweet)){
            //User has already like
            $this->delete('retweet',['retweetBy'=>$user_id,'retweetFrom'=>$deretweet]);
            $result=array("deleteretweet"=>-1);
            return json_encode($result);
        }
   }
   public function removeComment($deleteCommentBy,$deleteCommentOn){
    if($this->wasCommentBy($deleteCommentBy,$deleteCommentOn)){
        //User has already like
        $this->delete('comment',['commentBy'=>$deleteCommentBy,'commentOn'=>$deleteCommentOn]);
        $result=array("deletecomment"=>-1);
        return json_encode($result);
    }
   }
   public function wasCommentBy($commentBy,$commentOn){
        $stmt=$this->con->prepare("SELECT * FROM comment WHERE commentBy=:user_id AND commentOn=:postId");
        $stmt->bindParam(":user_id",$commentBy,PDO::PARAM_INT);
        $stmt->bindParam(":postId",$commentOn,PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;  
   }
   public function getComments($postId){
    $stmt=$this->con->prepare("SELECT count(*) as 'count' FROM `comment` WHERE `commentOn`=:postId");
    $stmt->bindParam(":postId",$postId,PDO::PARAM_INT);
    $stmt->execute();

    $data=$stmt->fetch(PDO::FETCH_ASSOC);
   if($data["count"] > 0){
       return $data["count"];
   }

    
}
}
?>