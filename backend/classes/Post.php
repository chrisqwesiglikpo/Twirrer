<?php
require_once 'PostControls.php';
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
        $postControls=new PostControls;
        $controls=$postControls->createControls($post->post_id,$post->postBy,$user_id);    
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
                                '.$controls.'
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