<?php $page_title="Login on Twitter / Twitter"; ?>
<?php require_once 'backend/shared/header.php'; ?>
    <section class="login-page">
      <?php require_once 'backend/shared/loginHeader.php'; ?>
       <div class="login">
         <div class="login-content">
           <div class="header-content">
            <h2>Log in to Twitter</h2>
           </div>
           <form  class="login-form">
            <div class="form-group">
                 <input type="text" placeholder="Phone,email or username" id="username">
             </div>
             <div class="form-group">
                <input type="password" placeholder="Password" id="password">
             </div>
             <div>
               <button type="button" class="login-form-btn" id="login">Log In</button>
               <input type="checkbox" class="login-form-checkbox" id="check">
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