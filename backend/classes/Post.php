<?php

class Post extends User{
    protected $con;
    function __construct(){
        $this->con=Database::instance();
    }
    public function posts($user_id,$num){
        $userdata=$this->userData($user_id);
        $stmt=$this->con->prepare("SELECT * FROM users LEFT JOIN post ON post.userId=users.user_id WHERE post.userId=:user_id ORDER BY post.postedOn DESC LIMIT :num");

        $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
        $stmt->bindParam(":num",$num,PDO::PARAM_INT);
        $stmt->execute();
        $posts=$stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($posts as $post){
        $likes=$this->likes($user_id,$post->post_id);
            
          echo  '<div class="post">
                       <div class="mainContentContainer">
                            <div class="userImageContainer">
                                <img src="'.url_for($post->profilePic).'" alt="User Profile Pic">
                            </div>
                            <div class="postContentContainer">
                                <div class="post-header">
                                    <a href="'.url_for($post->username).'" class="displayName">'.$post->firstName.' '.$post->lastName.'</a>
                                    <span class="username">@'.$post->username.'</span>
                                    <span class="date">'.$this->timeAgo($post->postedOn).'</span>
                                </div>
                                <div class="post-body">
                                      <div>'.$this->getTweetLinks($post->post).'</div>
                                </div>
                                <div class="post-footer">
                                    <div class="postButtonContainer">
                                        <button data-toggle="modal" data-target="#exampleModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path d="M14.046 2.242l-4.148-.01h-.002c-4.374 0-7.8 3.427-7.8 7.802 0 4.098 3.186 7.206 7.465 7.37v3.828c0 .108.044.286.12.403.142.225.384.347.632.347.138 0 .277-.038.402-.118.264-.168 6.473-4.14 8.088-5.506 1.902-1.61 3.04-3.97 3.043-6.312v-.017c-.006-4.367-3.43-7.787-7.8-7.788zm3.787 12.972c-1.134.96-4.862 3.405-6.772 4.643V16.67c0-.414-.335-.75-.75-.75h-.396c-3.66 0-6.318-2.476-6.318-5.886 0-3.534 2.768-6.302 6.3-6.302l4.147.01h.002c3.532 0 6.3 2.766 6.302 6.296-.003 1.91-.942 3.844-2.514 5.176z"/></g></svg>
                                        </button>
                                    </div>
                                    <div class="postButtonContainer">
                                        <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path d="M23.615 15.477c-.47-.47-1.23-.47-1.697 0l-1.326 1.326V7.4c0-2.178-1.772-3.95-3.95-3.95h-5.2c-.663 0-1.2.538-1.2 1.2s.537 1.2 1.2 1.2h5.2c.854 0 1.55.695 1.55 1.55v9.403l-1.326-1.326c-.47-.47-1.23-.47-1.697 0s-.47 1.23 0 1.697l3.374 3.375c.234.233.542.35.85.35s.613-.116.848-.35l3.375-3.376c.467-.47.467-1.23-.002-1.697zM12.562 18.5h-5.2c-.854 0-1.55-.695-1.55-1.55V7.547l1.326 1.326c.234.235.542.352.848.352s.614-.117.85-.352c.468-.47.468-1.23 0-1.697L5.46 3.8c-.47-.468-1.23-.468-1.697 0L.388 7.177c-.47.47-.47 1.23 0 1.697s1.23.47 1.697 0L3.41 7.547v9.403c0 2.178 1.773 3.95 3.95 3.95h5.2c.664 0 1.2-.538 1.2-1.2s-.535-1.2-1.198-1.2z"/></g></svg>
                                        </button>
                                    </div>
                                    <div class="postButtonContainer">
                                    '.((!empty($likes['likeOn'])===$post->post_id) ? '<button class="unlike-btn" data-post="<?php echo $post->post_id; ?>" data-user="<?php echo $post->postBy; ?>">
                                    <i class="fa fa-heart"></i>
                                    <span class="likesCounter">'.$post->likesCount.'</span>
                                    </button>' : '<button class="like-btn" data-post="'.$post->post_id.'" data-user="'.$post->postBy.'">
                                    '.((!empty($likes['likeOn'])===$post->post_id && $likes['likeBy']===$post->user_id ) ? '<i class="fa fa-heart"></i>' :'<i class="fa fa-heart-o"></i>' ).'
                                    <span class="likesCounter">'.(($post->likesCount > 0) ? $post->likesCount : '').'</span>
                                    </button>').'
                                    </div>
                                </div>
                            </div>
                       </div>
            </div>';
       
            
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
    public function createFollowButton($user,$isFollowing){
        $text=$isFollowing ? "Following" :"Follow";
        $buttonClass=$isFollowing ? "followButton follow" : "followButton";
        return "<button class='$buttonClass' data-user='$user->user_id'>$text</button>";
    }

    public function addLike($user_id,$tweet_id,$get_id){
		$stmt=$this->con->prepare("UPDATE `post` SET `likesCount` =likesCount+1 WHERE `post_id`=:tweet_id");
		$stmt->bindParam(":tweet_id",$tweet_id,PDO::PARAM_INT);
        $stmt->execute();

        $stmt=$this->con->prepare("SELECT * FROM `likes` WHERE `likeBy`=:user_id AND `likeOn`=:tweet_id");
        $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
        $stmt->bindParam(":tweet_id",$tweet_id,PDO::PARAM_INT);

        $stmt->execute();
        if($stmt->rowCount() >0){
            $stmt=$this->con->prepare("UPDATE `post` SET `likesCount` =`likesCount` -1 WHERE `post_id`=:tweet_id");
		    $stmt->bindParam(":tweet_id",$tweet_id,PDO::PARAM_INT);
		    $stmt->execute();
            $this->delete('likes',array('likeBy'=>$user_id,'likeOn'=>$tweet_id));
        }else{
            $this->create('likes',array('likeBy'=>$user_id,'likeOn'=>$tweet_id));
        }
		
	}
    
    public function unlike($user_id,$tweet_id,$get_id){
        $stmt=$this->con->prepare("SELECT * FROM `likes` WHERE `likeBy`=:user_id AND `likeOn`=:tweet_id");
        $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
        $stmt->bindParam(":tweet_id",$tweet_id,PDO::PARAM_INT);

        $stmt->execute();
        if($stmt->rowCount() >0){
		$stmt=$this->con->prepare("UPDATE `post` SET `likesCount` =likesCount -1 WHERE `post_id`=:tweet_id");
		$stmt->bindParam(":tweet_id",$tweet_id,PDO::PARAM_INT);
        $stmt->execute();
        }
		$stmt=$this->con->prepare("DELETE FROM `likes` WHERE `likeBy` =:user_id AND `likeOn`=:tweet_id");
		$stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
		$stmt->bindParam(":tweet_id",$tweet_id,PDO::PARAM_INT);
		$stmt->execute();
	}
    public function delete($table,$array){
    	$sql="DELETE FROM `{$table}`";
    	$where=" WHERE ";
    	foreach ($array as $name => $value) {
    		$sql .="{$where} `{$name}` = :{$name}";
    		$where = " AND ";
    	}
    	if($stmt=$this->con->prepare($sql)){
    		foreach ($array as $name => $value) {
    		$stmt->bindValue(':'.$name,$value);
    		}
    		$stmt->execute();
    	}
    }
	public function likes($user_id,$tweet_id){
		 $stmt=$this->con->prepare("SELECT * FROM `likes` WHERE `likeBy`=:user_id AND `likeOn`=:tweet_id");
		 $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
		 $stmt->bindParam(":tweet_id",$tweet_id,PDO::PARAM_INT);

         $stmt->execute();
         if($stmt->rowCount() > 0){
            return $stmt->fetch(PDO::FETCH_ASSOC);
         }
		 
	}
  
}
?>