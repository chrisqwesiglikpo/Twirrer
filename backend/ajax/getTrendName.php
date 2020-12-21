<?php
 require_once('../init.php');
 $loadFromUser->preventAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
 if(is_post_request()){
  if(isset($_POST['trendID']) && !empty($_POST['trendID'])){
     $trendID=h($_POST['trendID']);
     $hashtag=$loadFromPost->getTrendNameById($trendID);
   echo  $hashtag->hashtag;
  }
}
?>