<?php
 require_once('../init.php');
if(isset($_POST['onlyStatusText'])){
  $userid=$_POST['userid'];
  $allowed_tags='<div><h1><h2><h3><h4><p><br/><strong><em><ul><li>';
  $statusText=strip_tags($_POST['onlyStatusText'],$allowed_tags);
  $loadFromUser->create('post',array('userId'=>$userid,'post'=>$statusText,'postBy'=>$userid,'postedOn'=>date('Y-m-d H:i:s')));
  preg_match_all("/#+([a-zA-Z0-9_]+)/i",$statusText,$hashtag);
  if(!empty($hashtag)){
    $loadFromPost->addTrend($statusText);
  }
  $loadFromPost->posts($userid,10);
}


?>