<?php
include 'backend/init.php';
// if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__)==realpath($_SERVER['SCRIPT_FILENAME'])){
//   header('Location:'.url_for('index.php'));
// }
$page_title="Login on Twitter / Twitter";
if(is_post_request()){
  if(isset($_POST['LoginButton'])){
      $username=FormSanitizer::sanitizeFormUsername($_POST['username']);
      $password=FormSanitizer::sanitizeFormPassword($_POST['password']);

      $wasSuccessful=$account->login($username,$password);
     
      if($wasSuccessful){
        $user_id=$account->getUserId($username);
        if(isset($_POST['check'])){
              $check=$_POST['check'];
              if($check==1){
                $tstrong = true;
                $token = bin2hex(openssl_random_pseudo_bytes(64, $tstrong));
                $loadFromUser->create('token', array('token'=>sha1($token), 'user_id'=>$user_id));
                setcookie('FBID', $token, time()+60*60*24*7, '/', NULL, NULL, true);
              }  
              session_regenerate_id();
              $_SESSION["userLoggedIn"]=$user_id;
              redirect_to(url_for("home"));
        }  
      }
  
  }

}



?>
<?php require_once 'backend/shared/header.php'; ?>
    <section class="login-page">
      <?php require_once 'backend/shared/loginHeader.php'; ?>
       <div class="login">
         <div class="login-content">
           <div class="header-content">
            <h2>Log in to Twitter</h2>
           </div>
           <form  class="login-form" action="<?php echo h($_SERVER["PHP_SELF"]);?>" method="POST">
            <div class="form-group">
             <?php echo $account->getError(Constants::$loginUsernameFailed); ?>
                <label for="username">Username or Email</label>
                 <input type="text" placeholder="Email or username" value="<?php getInputValue('username'); ?>" name="username" id="username" autofocus>
             </div>
             <div class="form-group">
               <?php echo $account->getError(Constants::$loginPasswordFailed); ?>
                <label for="password">Password</label>
                <input type="password" placeholder="Password" name="password" id="password">
             </div>
             <div>
               <button type="submit" class="login-form-btn" name="LoginButton">Log In</button>
               <input type="hidden" class="login-form-checkbox" name="check" value="0">
               <input type="checkbox" class="login-form-checkbox" name="check" value="1" id="check">
               <label for="check">Remember me</label>
               <a href="#">Forgot Password?</a>
             </div>
           </form>
         </div>
         <footer class="login-footer">
           <p>New to Twitter? <a href="<?php echo url_for('signup.php'); ?>">Sign up for Twitter</a></p>
         </footer>
       </div>
    </section>
</body>
</html>