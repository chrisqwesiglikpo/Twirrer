<?php
 require_once('../init.php');

 if($_SERVER['REQUEST_METHOD'] === "POST"){
    
      $userid=(int)h($_POST['userId']);
    
      $image = $account->formSanitizer($loadFromUser->uploadImage($_FILES['file'],$userid));
      $loadFromUser->update("users",$userid,array('profilePic'=>$image));
       echo $image;
        
 }  
    