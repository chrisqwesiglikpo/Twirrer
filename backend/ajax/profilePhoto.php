<?php
 require_once('../init.php');
//  if(Login::isLoggedIn()){
//     $userid=Login::isLoggedIn();

// }else if(isset($_SESSION['userLoggedIn'])){
//     $userid=$_SESSION['userLoggedIn'];
// }

 if($_SERVER['REQUEST_METHOD'] === "POST"){
      $userid=(int)h($_POST['userId']);
 
        if(!empty($_FILES['file']['name'][0])){
            $image = $account->formSanitizer($loadFromUser->uploadImage($_FILES['file'],$userid));
            $loadFromUser->update("users",$userid,array('profilePic'=>$image));
            echo $image;
        }
  
    
      
        // if (!is_dir('frontend/content/1')) {
        //         mkdir('frontend/content/1/');
        //         echo "It worked!";
        //     }
    // }else{
    //     echo "error";
    // }
    // if(isset($_POST['file']) && !empty($_POST['file'])){
        // $image=$loadFromUser->uploadImage($_POST['file'])''
        // if(!empty($_FILES['file']['name'][0])){
        //     //upload image
        //     $image = $loadFromUser->uploadImage($_FILES['file']);
        //     // if(!$image){
        //     //     echo $userObj->imageError();
        //     //     exit;
        //     // }
           
        //         echo $image;
          
        // }else{
        //     $image = "frontend/assets/images/avatar.png";
        // }
        
    }  
    
    // if(isset($_POST['imgName'])){
    //     $imgName=$account->formSanitizer($_POST['imgName']);
    //     $userid=$account->formSanitizer($_POST['userid']);
    
    //     $loadFromUser->update("users",$userid,array('profilePic'=>$imgName));
    // }
    // // frontend/content/' + userid + '/profilePhoto/' + name + '';
    
    // if(0<$_FILES['file']['error']){
    //     echo 'Error: ' . $_FILES['file']['error'].'<br>';
    // }else{
    
    //     $path_directory = $_SERVER['DOCUMENT_ROOT']."/Twirrer/frontend/content/".$userid.'/profilePhoto/';
    
    //     if(!file_exists($path_directory) && !is_dir($path_directory)){
    //         mkdir($path_directory, 0777, true);
    //     }
    
    //     move_uploaded_file($_FILES['file']['tmp_name'], $path_directory.$_FILES['file']['name']);
    
    //     echo "/frontend/content/".$userid.'/profilePhoto/'.$_FILES['file']['name'];
    // }

//  }