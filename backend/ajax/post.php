<?php
 require_once('../init.php');
 $loadFromUser->preventAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
 if(is_post_request()){
  if(isset($_POST['onlyStatusText']) && !empty($_POST['onlyStatusText'])){
    $userid=h($_POST['userid']);
    $allowed_tags='<div><h1><h2><h3><h4><p><br/><strong><em><ul><li>';
    $statusText=strip_tags($_POST['onlyStatusText'],$allowed_tags);
    $loadFromUser->create('post',array('userId'=>$userid,'post'=>$statusText,'postBy'=>$userid,'postedOn'=>date('Y-m-d H:i:s')));
    preg_match_all("/#+([a-zA-Z0-9_]+)/i",$statusText,$hashtag);
    if(!empty($hashtag)){
      $loadFromPost->addTrend($statusText);
    }
    $loadFromPost->posts($userid,10);
  }

  if(!empty($_FILES['postImage']) && isset($_FILES['postImage'])){
    $userid=h($_POST['userid']);
    //  var_dump($_FILES['postImage']);
     $postImagePath=$loadFromUser->uploadPostImage($_FILES['postImage'],$userid);
     $lastInsertedId=$loadFromUser->create('post',array('userId'=>$userid,'postImage'=>$postImagePath,'postBy'=>$userid,'postedOn'=>date('Y-m-d H:i:s')));
     $loadFromUser->updatePost("post",$userid,array('imageId'=>$lastInsertedId));
     $loadFromPost->posts($userid,10);
    // $allowed_tags='<div><h1><h2><h3><h4><p><br/><strong><em><ul><li>';
    // $statusText=strip_tags($_POST['onlyStatusText'],$allowed_tags);
    // $loadFromUser->create('post',array('userId'=>$userid,'post'=>$statusText,'postBy'=>$userid,'postedOn'=>date('Y-m-d H:i:s')));
    // preg_match_all("/#+([a-zA-Z0-9_]+)/i",$statusText,$hashtag);
    // if(!empty($hashtag)){
    //   $loadFromPost->addTrend($statusText);
    // }
    // $loadFromPost->posts($userid,10);
  }
}


?>