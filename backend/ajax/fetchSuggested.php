<?php 
   require_once('../init.php');
   $loadFromUser->preventAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
   if(is_post_request()){
      if(isset($_POST['fetchSuggest']) && !empty($_POST['fetchSuggest'])){
         $userId=h($_POST['userid']);
         $profileId=h($_POST['profileid']);
         $limit=(int)trim(h($_POST['fetchSuggest']));
         $loadFromFollow->suggestedLists($profileId,$userId,$limit); 
      }

      if(isset($_POST['fetchFollowing']) && !empty($_POST['fetchFollowing'])){
         $userId=h($_POST['userid']);
         $profileId=h($_POST['profileid']);
         $limit=(int)trim(h($_POST['fetchFollowing']));
         $loadFromFollow->followingLists($profileId,$userId,$limit); 
      }

     
}
?>