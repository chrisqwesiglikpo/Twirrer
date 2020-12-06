<?php
  include '../init.php';
 
  if(isset($_POST['showPopup']) && !empty($_POST['showPopup'])){
     $postedBy=$_POST['postedBy'];
     $post_id=$_POST['showPopup'];
     $user_id=$_POST['user_id'];
     $post=$loadFromPost->getModalPost($post_id,$postedBy);
     ?>
     
     <?php
  }

?>