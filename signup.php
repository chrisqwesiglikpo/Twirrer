<?php
include 'backend/init.php';

// if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__)==realpath($_SERVER['SCRIPT_FILENAME'])){
//   header('Location:'.url_for('index.php'));
// }
$page_title="Sign up for Twitter / Twitter"; 
if(is_post_request()){
  if(isset($_POST['submitButton'])){
    $firstName=FormSanitizer::sanitizeFormString($_POST['firstName']);
    $lastName=FormSanitizer::sanitizeFormString($_POST['lastName']);

    $email=FormSanitizer::sanitizeFormEmail($_POST['email']);

    $password=FormSanitizer::sanitizeFormPassword($_POST['new-password']);
    $password2=FormSanitizer::sanitizeFormPassword($_POST['cpassword']);

    $username=$account->generateUsername($firstName,$lastName);
     $wasSuccessful=$account->register($firstName,$lastName,$username,$email,$password,$password2);
      if($wasSuccessful){
        session_regenerate_id();
        $user_id=$account->getUserId($email);
        $_SESSION["userLoggedIn"]=$user_id;
        redirect_to(url_for("home.php"));
      }
  
  }

}
?>
<?php require_once 'backend/shared/header.php'; ?>
    <section class="login-page">
       <?php require_once 'backend/shared/loginHeader.php'; ?>
       <div class="login">
         <div class="login-content">
          <div class="header-container">
              <h2>Create your account</h2>
           </div>
           <form  class="login-form" id="formData" action="<?php echo h($_SERVER["PHP_SELF"]);?>" method="POST">
             <div class="form-group">
                  <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                  <label for="fname">First name</label>
                  <input type="text" placeholder="First name" name="firstName" value="<?php getInputValue('firstName'); ?>" autocomplete="off" autofocus required>    
             </div>
             <div class="form-group">
                  <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                  <label for="lname">Last name</label>
                  <input type="text" placeholder="Last name" name="lastName" value="<?php getInputValue('lastName'); ?>" autocomplete="off" required>
             </div>
             <div class="form-group">
               <?php echo $account->getError(Constants::$emailTaken); ?>   
               <?php echo $account->getError(Constants::$emailInvalid); ?>   
                  <label for="email">Email</label>
                  <input type="email" placeholder="Email" name="email" value="<?php getInputValue('email'); ?>" autocomplete="off" required>
             </div>
             <div class="form-group">
                   <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>  
                   <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>  
                   <?php echo $account->getError(Constants::$passwordLength); ?>  
                   <label for="password">Password</label>
                   <input type="password" placeholder="Password" name="new-password" autocomplete="off" required>
             </div>
             <div class="form-group">
                 <label for="cpassword">Confirm Password</label>
                 <input type="password" placeholder="Confirm Password" name="cpassword" autocomplete="off" required>
             </div>
             <div class="spacing">
               <button type="submit" class="login-form-btn" name="submitButton">Signup</button>
               <input type="checkbox" class="login-form-checkbox" id="check">
               <label for="check">Remember me</label>
               <a href="#">Forgot Password?</a>
             </div>
           </form>
         </div>
         <footer class="login-footer">
           <p>Already have  an account? <a href="<?php echo url_for('login.php'); ?>">Login now</a></p>
         </footer>
       </div>
    </section>

  
</body>
</html>