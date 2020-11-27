<?php

include '../connection/db.php';

// if(isset($_POST['checkEmail'])){
// //    json_encode()
// }

function checkEmail(){
   GLOBAL $db;
   if(isset($_POST['checkEmail'])){
        $email=$_POST['checkEmail'];
        $stmt=$db->prepare('SELECT `email` FROM `users` WHERE email=:email');
        $stmt->bindParam(":email",$email);
        $stmt->execute();
        if($stmt->rowCount() ==0 ){
          echo json_encode(array('error'=>'email_success'));
        }else{
          echo json_encode(array('error'=>'email_fail','message'=>'Email already exist!'));
        }
     }
}
checkEmail();

function signupSubmit(){
  GLOBAL $db;
  if(isset($_GET['signup']) && $_GET['signup']=='true'){
      $firstName=$_POST['firstName'];
      $lastName=$_POST['lastName'];
      $email=$_POST['email'];
      $password=password_hash($_POST['new-password'],PASSWORD_DEFAULT);
      $username=strtolower($firstName+""+$lastName);
      $stmt=$db->prepare("INSERT INTO `users` (firstName,lastName,email,password,profilePic,username) VALUES(:fname,:lname,:email,:password,'assets/images/profilePic.jpeg',:username)");
      $stmt->bindParam(":fname",$firstName,PDO::PARAM_STR);
      $stmt->bindParam(":lname",$lastName,PDO::PARAM_STR);
      $stmt->bindParam(":email",$email,PDO::PARAM_STR);
      $stmt->bindParam(":password",$password,PDO::PARAM_STR);
      $stmt->bindParam(":username",$username,PDO::PARAM_STR);
      $stmt->execute();
      if($stmt){
        $_SESSION['username']=$username;
        echo json_encode(['error'=>'success','msg'=>'success.php']);
      }
  }
}

signupSubmit();

?>