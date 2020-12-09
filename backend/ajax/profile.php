<?php
 require_once('../init.php');
if(isset($_POST['imgName']) && !empty($_POST['imgName'])){
$imgName=$account->formSanitizer($_POST['imgName']);
$userId=$account->formSanitizer($_POST['userId']);

$loadFromUser->update("users",$userId,array('profilePic'=>$imgName));

}



?>