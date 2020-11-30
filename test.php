<?php
include 'backend/init.php';
// $arr=array("Hello","World");

// echo implode(',',$arr);
// $loadFromUser->create('users',array('firstName'=>'Christopher','lastName'=>'Attoh'));
  $user=$loadFromUser->userData(1);
  echo $user->firstName;

?>