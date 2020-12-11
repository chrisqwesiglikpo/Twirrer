<?php
 require_once('../init.php');

 if($_SERVER['REQUEST_METHOD'] === "POST"){
    
      var_dump($_FILES['croppedImage']['tmp_name']);
      // var_dump(explode("",$_FILES['croppedImage']));
     //  $file=$account->formSanitizer($_POST['croppedImage']);
     // $_FILES['croppedImage']);
   //   if(isset($_POST['croppedImage'])){
   //       $userid=(int)h($_POST['userId']);
         // $image= $account->formSanitizer($_POST['croppedImage']);
         // // var_dump($image);
         // var_dump($image);
         // $image_array_1=explode(";",$image);
         // var_dump($image_array_1);
         // echo $image_array_1;
         // $image_array_2=explode(";",$image_array_1[1]);
         // $data=base64_decode($image_array_2[0]);
         // $path_directory = $_SERVER['DOCUMENT_ROOT']."/Twirrer/frontend/profileImage/".$userid.'/';

         // if(!file_exists($path_directory) && !is_dir($path_directory)){
         //     mkdir($path_directory, 0777, true);
         
         // }
         // $file=$path_directory.$data.'.png';
         // $image_name="Twirrer/frontend/profileImage/".$userid.'/'.$data.'.png';
         // move_uploaded_file($data,$file);
         // echo $image_name;
         // var_dump($image_array_2);
         // $image_array_2=explode(";",$image_array_1[1]);
         // 
         // $image_upload = $account->formSanitizer($loadFromUser->uploadImage($data,$userid));
         // echo $image_upload;
      
   //   }
   //    if(!empty($_FILES['croppedImage'])){
   //      $image = $account->formSanitizer($loadFromUser->uploadImage($_FILES['croppedImage'],$userid));
   //   //    $loadFromUser->update("users",$userid,array('profilePic'=>$image));
   //       echo $image;
          
   //    }
      
 }  
    