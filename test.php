<?php
class Follow extends User{
    protected $con;

    public function __construct(){
      $this->con = Database::instance();
    }
    public function checkFollow($followerID,$user_id){
        $stmt=$this->con->prepare("SELECT * FROM `follow` WHERE `sender`=:user_id AND `receiver`=:followerID");
        $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
        $stmt->bindParam(":followerID",$followerID,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function followBtn($profileID,$user_id){
        $data=$this->checkFollow($profileID,$user_id);
        if($profileID != $user_id){
             if(!empty($data['receiver'])==$profileID){
                 //Following btn
                
                 echo  "<a href='".url_for('messages.php?id='.$profileID)."' class='profileButton'>
                       <i class='fa fa-envelope'></i></a>
                       <button class='followButton follow-btn' data-follow='".$profileID."'>Following</button>";
             }else{
                 //follow btn
                echo  "<a href='".url_for('messages.php?id='.$profileID)."' class='profileButton'><i class='fa fa-envelope'></i></a>
                      <button class='followButton unfollow-btn' data-follow='".$profileID."'>Follow</button>";
             }
        }else{
            //edit button
            echo "<button class='followButton' onclick=location.href='profileEdit.php'>Edit Profile</button>";
        }
    }

    public function follow($followID,$user_id,$profileID){
        $this->create('follow', array('sender'=> $user_id ,'receiver' => $followID));
        $this->addFollowCount($followID,$user_id);
        $stmt=$this->con->prepare('SELECT `user_id`,`following`,`followers` FROM `users` LEFT JOIN `follow` ON `sender`=:user_id AND CASE WHEN `receiver`=:user_id THEN `sender` =`user_id` END WHERE `user_id` =:profileID');
        $stmt->execute(array("user_id"=>$user_id,"profileID"=>$profileID));
        $data=$stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);
     }
 
     public function unfollow($followID,$user_id,$profileID){
        $this->delete('follow', array('sender'=> $user_id ,'receiver' => $followID));
        $this->removeFollowCount($followID,$user_id);
        $stmt=$this->con->prepare('SELECT `user_id`,`following`,`followers` FROM `users` LEFT JOIN `follow` ON `sender`=:user_id AND CASE WHEN `receiver`=:user_id THEN `sender` =`user_id` END WHERE `user_id` =:profileID');
        $stmt->execute(array("user_id"=>$user_id,"profileID"=>$profileID));
        $data=$stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);
     }
     public function addFollowCount($followID,$user_id){
         $stmt=$this->con->prepare("UPDATE `users` SET `following` = `following` + 1 WHERE `user_id` =:user_id;UPDATE `users` SET `followers` =`followers` + 1 WHERE `user_id` =:followID");
         $stmt->execute(array("user_id"=>$user_id,"followID" =>$followID));
     }
     public function removeFollowCount($followID,$user_id){
         $stmt=$this->con->prepare("UPDATE `users` SET `following` = `following` - 1 WHERE `user_id` =:user_id;UPDATE `users` SET `followers` =`followers` - 1 WHERE `user_id` =:followID");
         $stmt->execute(array("user_id"=>$user_id,"followID" =>$followID));
     }
     public function displayFollowerCount($profileId){
        $stmt=$this->con->prepare('SELECT `followers`,`following` FROM `users` WHERE `user_id` =:profileID');
        $stmt->bindParam(":profileID",$profileId,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
     }
     

     public function whoToFollow($user_id,$profileID){
        $stmt=$this->con->prepare("SELECT * FROM `users` WHERE `user_id` !=:user_id AND `user_id` NOT IN (SELECT `receiver` FROM `follow` WHERE `sender` =:user_id) ORDER BY rand() LIMIT 3");
        $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
        $stmt->execute();
        $data=$stmt->fetchAll(PDO::FETCH_OBJ);

     
         foreach ($data as $user) {
         	echo'<div class="follow-user">
                <div class="follow-user-img">
                 <img src="'.url_for($user->profilePic).'" alt="">
                </div>
             <div class="follow-user-info">
                 <h4><a href="'.url_for($user->username).'">'.$user->firstName." ".$user->lastName.'</a></h4>
                 <p>@'.$user->username.'</p>
             </div>
             '.$this->homeFollow($user->user_id,$user_id,$profileID).'
             
         </div>';
         }
       
    }
    
    public function homeFollow($profileID,$user_id,$followID){
        $data=$this->checkFollow($profileID,$user_id);
        if(!empty($data['receiver'])==$profileID){
            //Following btn
            echo  "<button class='follow-btn unfollow-home' data-follow='".$profileID."' data-profileId='".$profileID."'>Following</button>";
        }else{
            //follow btn
            echo  "<button class='follow-btn follow-home' data-follow='".$profileID."' data-profileId='".$profileID."'>Follow</button>";
        }
     }
}


?>
