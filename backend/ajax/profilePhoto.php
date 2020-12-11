<?php
 require_once('../init.php');

 if($_SERVER['REQUEST_METHOD'] === "POST"){
    // var_dump($_FILES['croppedImage']);
     if(!empty($_FILES['croppedImage'])){
      $userid=$_POST['userId'];
      $path_directory = $_SERVER['DOCUMENT_ROOT']."/Twirrer/frontend/profileImage/".$userid.'/';

        if(!file_exists($path_directory) && !is_dir($path_directory)){
            mkdir($path_directory, 0777, true);
        
        }
       $folder=$path_directory.$_FILES['croppedImage']['name'].'.png';
     
        move_uploaded_file($_FILES['croppedImage']['tmp_name'],$folder);
        $image_path="frontend/profileImage/".$userid.'/'.$_FILES['croppedImage']['name'].'.png';
        $loadFromUser->update("users",$userid,array('profilePic'=>$image_path));
        echo "frontend/profileImage/".$userid.'/'.$_FILES['croppedImage']['name'].'.png';

     }
      
 }  
    