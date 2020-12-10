<?php
 require_once('../init.php');

 if($_SERVER['REQUEST_METHOD'] === "POST"){
    //  if(!empty($_POST['file'])){
    //      echo "Hi";
    //  }
      $userid=(int)h($_POST['userId']);
 
        // if(!empty($_FILES['file']['name'][0])){
            $image = $account->formSanitizer($loadFromUser->uploadImage($_FILES['file'],$userid));
            $loadFromUser->update("users",$userid,array('profilePic'=>$image));
            echo $image;
        // }

        
    }  
    