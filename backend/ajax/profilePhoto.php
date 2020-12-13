<?php
 require_once('../init.php');


 if(is_post_request()){
    // var_dump($_FILES['croppedImage']);
     if(!empty($_FILES['croppedImage'])){
      $userid=$_POST['userId'];
      $imagePath=$loadFromUser->cropProfileImageUpload($_FILES['croppedImage'],$userid);
      $loadFromUser->update("users",$userid,array('profilePic'=>$imagePath));
      
     }
      
     if(!empty($_FILES['croppedCoverImage'])){
      $userid=$_POST['userId'];
      $imagePath=$loadFromUser->cropCoverImageUpload($_FILES['croppedCoverImage'],$userid);
      $loadFromUser->update("users",$userid,array('profileCover'=>$imagePath));
      echo $imagePath;
     }
      
 }  
    