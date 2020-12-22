<?php 
   require_once('../init.php');
   $loadFromUser->preventAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
   if(is_post_request()){
      if(isset($_POST['fetchGroup']) && !empty($_POST['fetchGroup'])){
         $userId=h($_POST['userid']);
         $chatId=h($_POST['chatid']);
         $limit=(int)trim($_POST['fetchGroup']);
         
         $loadFromPost->displayChatUsers($userId,$chatId,$limit); 
         
      }

      if(isset($_POST['fetchGroupP']) && !empty($_POST['fetchGroupP'])){
        $userId=h($_POST['userid']);
        $chatId=h($_POST['chatid']);
        $limit=(int)trim($_POST['fetchGroupP']);
       
         $loadFromPost->displayChatUsers($userId,$chatId,$limit); 
        
     }
   }


?>
