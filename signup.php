<?php $page_title="Sign up for Twitter / Twitter"; ?>
<?php require_once 'backend/shared/header.php'; ?>
    <section class="login-page">
       <?php require_once 'backend/shared/loginHeader.php'; ?>
       <div class="login">
         <div class="login-content">
          <div class="header-container">
              <h2>Create your account</h2>
           </div>
           <form  class="login-form" id="formData">
             <div class="form-group">
                  <div class='fname-error error'></div>
                  <label for="fname">First name</label>
                  <input type="text" placeholder="First name" name="firstName" id="fname" autofocus required>    
             </div>
             <div class="form-group">
                  <div class='lname-error error'></div>
                  <label for="lname">Last name</label>
                  <input type="text" placeholder="Last name" name="lastName" id="lname" required>
             </div>
             <div class="form-group">
                  <div class='email-error error'></div>
                  <label for="email">Email</label>
                  <input type="email" placeholder="Email" name="email" id="email" required>
             </div>
             <div class="form-group">
                  <div class='password-error error'></div>
                   <label for="password">Password</label>
                   <input type="password" placeholder="Password" name="new-password" id="password" required>
             </div>
             <div class="form-group">
                 <div class='confirm-error error'></div>
                 <label for="cpassword">Confirm Password</label>
                 <input type="password" placeholder="Confirm Password" id="cpassword" required>
             </div>
             <div class="spacing">
               <button type="button" class="login-form-btn" id="submit">Signup</button>
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

    <script src="assets/js/signup.js"></script>
</body>
</html>