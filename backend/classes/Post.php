<?php
require_once 'PostControls.php';
class Post extends User{
    protected $con;
    function __construct(){
        $this->con=Database::instance();
    }
    public function posts($user_id,$num){
        $userdata=$this->userData($user_id);
        $stmt=$this->con->prepare("SELECT * FROM post p LEFT JOIN users u ON p.userId = u.user_id   WHERE  p.userId =:user_id
        UNION
        SELECT * FROM post p LEFT JOIN users u ON p.userId = u.user_id  WHERE  p.userId IN (SELECT follow.receiver FROM follow WHERE follow.sender = :user_id ) ORDER BY postedOn DESC LIMIT :num");

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
                          <a href="'.url_for($retweetUserData->username).'" class="displayName">'.$retweetUserData->firstName." ".$retweetUserData->lastName.'</a>
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
               <a href="'.url_for($retweetUserData->username).'" role="link" data-focusable="true" class="retweet-link">
                            <span>'.$retweetUserData->firstName.' '.$retweetUserData->lastName.' Retweeted</span>
               </a>
            </div>
    </div>' : ' ' ).'
             <div class="mainContentContainer">
                  <div class="userImageContainer">
                      <img src="'.url_for($post->profilePic).'" alt="User Profile Pic">
                  </div>
                  <div class="postContentContainer">
                      <div class="post-header">
                          <a href="'.url_for($post->username).'" class="displayName">'.$post->firstName.' '.$post->lastName.'</a>
                          <span class="username">@'.$post->username.'</span>
                          <span class="date">'.$this->timeAgo($post->postedOn).'</span>
                         ' .(($post->postBy===$user_id) ? '<span class="dot">...</span>' : '' ).' 
                      </div>
                      <div class="post-body">
                            <div>'.$this->getTweetLinks($post->post).'</div>
                      </div>
                      '.$controls.'
                  </div>
             </div>
            
  </div>';
        }
         
       
            
        }
    }

    public function getTrendByHash($hashtag){
        $stmt=$this->con->prepare("SELECT * FROM `trends` WHERE `hashtag` LIKE :hashtag  LIMIT 5");
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
 

    public function createTab($name,$href,$isSelected){
        $className=$isSelected ? "tab active" : "tab";
        return "<a href='$href' class='$className'> 
                   <span>$name</span>
                </a>";

    }

    public function addTrend($hashtag){
		preg_match_all("/#+([a-zA-Z0-9_]+)/i",$hashtag,$matches);
		if($matches){
			$result=array_values($matches[1]);
		}
		$sql ="INSERT INTO `trends` (`hashtag`,`createdOn`) VALUES(:hashtag,CURRENT_TIMESTAMP)";
		foreach ($result as $trend) {
			if($stmt=$this->con->prepare($sql)){
				$stmt->execute([':hashtag'=>$trend]);
			}
		}
	}

    
    public function getTweetLinks($tweet){
        $tweet=preg_replace("/(https?:\/\/)([\w]+.)([\w\.]+)/","<a href='$0' target='_blank'>$0</a>",$tweet);
        $tweet=preg_replace("/#([\w]+)/","<a href='".url_for('hashtag/$1')."'>$0</a>",$tweet);
        $tweet=preg_replace("/@([\w]+)/","<a href='".url_for('$1')."'>$0</a>",$tweet);
        return $tweet;
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
  
}
?>