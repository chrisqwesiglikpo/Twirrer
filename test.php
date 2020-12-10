



<?php
require_once('backend/init.php');

if($_SERVER['REQUEST_METHOD'] === "POST"){
    // if (!is_dir('frontend/content/1')) {
    //             mkdir('frontend/content/1');
    //             echo "It worked!";
    //         }
    $userid=$_POST['userId'];
//    if(!empty($_FILES['file']['name'][0])){
//        $image = $loadFromUser->uploadImage($_FILES['file'],1);
//        if (!is_dir('frontend/content/1')) {
//         mkdir('frontend/content/1');
//         echo "It worked!";
//     }

  
}

 function uploadImage($file,$user_id){
    // $fileInfo     = getimagesize($file['tmp_name']);
    // $fileTmp      = $file['tmp_name'];
    // $fileName     = $file['name'];
    // $fileSize     = $file['size'];
    // $errors       = $file['error'];
    // mkdirs('frontend/content/1');
    // // mkdirs("/path/to/my/dir", 0700);
    // function mkdirs($dir, $mode = 0777, $recursive = true) {
    //     if( is_null($dir) || $dir === "" ){
    //       return FALSE;
    //     }
    //     if( is_dir($dir) || $dir === "/" ){
    //       return TRUE;
    //     }
    //     if( mkdirs(dirname($dir), $mode, $recursive) ){
    //       return mkdir($dir, $mode);
    //     }
    //     return FALSE;
    //   }
    // //get extenion
    // $ext   = explode('.', $fileName);
    // $ext   = strtolower(end($ext));

    // //extenions types 
    // $allowed  = array('image/png', 'image/jpeg', 'image/jpg');

    // if(in_array($fileInfo['mime'], $allowed)){
    //     $folder = 'frontend/content/'.$user_id.'/profilePic/';
        // if(!file_exists($folder)){
        //      mkdir($folder, 0777, true);
        // }
        // if(is_dir($folder) === false )
        // {
        //   mkdir($folder);
          
        // }
     
        // $file   = $folder.substr(md5(time().mt_rand()), 2,25).'.'.$ext;
        

        // if($errors === 0){
        
        //         move_uploaded_file($fileTmp,$file);
        //         return $file;
            
        // }
    }
    //image-name.png
}

?>

