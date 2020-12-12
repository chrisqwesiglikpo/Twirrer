<?php
 require_once('../init.php');


 if($_SERVER['REQUEST_METHOD'] === "POST"){
    // var_dump($_FILES['croppedImage']);
     if(!empty($_FILES['croppedImage'])){
      $userid=$_POST['userId'];
      $imagePath=$loadFromUser->cropImageUpload($_FILES['croppedImage'],$userid);
      $loadFromUser->update("users",$userid,array('profilePic'=>$imagePath));
      
     }
      
 }  
    