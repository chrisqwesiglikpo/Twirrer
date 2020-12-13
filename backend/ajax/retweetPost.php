<?php
  include '../init.php';
 
if(is_post_request()){  
  if(isset($_POST['retweet']) && !empty($_POST['retweet'])){
    $tweet_id=$_POST['retweet'];
    $user_id=$_POST['user_id'];

     $retweet=$loadFromPost->checkRetweet($user_id,$tweet_id);
     
        if(!empty($retweet)){
            $retweetUserData=$loadFromPost->userData($retweet["retweetBy"]); 
            
            $user_id=$retweetUserData->user_id;
            $loadFromPost->posts($user_id,10);
          
        }
      
       
          
    
    

  }
}


?>