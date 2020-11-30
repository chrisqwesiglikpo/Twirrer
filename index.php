<?php
 include 'backend/init.php';

 if(Login::isLoggedIn()){
    redirect_to(url_for("home.php"));
}else if(isset($_SESSION['userLoggedIn'])){
    redirect_to(url_for("home.php"));
}
 $page_title="Twitter.It's what's happening / Twitter";
?>
 <?php require_once 'backend/shared/header.php'; ?>
    <!-- main page -->
    <section class="main-page">
         <!-- left -->
         <div class="left">
             <div class="left-content">
                 <div>
                     <i class="fa fa-search"></i>
                     <h3 class="left-content-heading">Find your interests</h3>
                 </div>
                 <div>
                    <i class="fa fa-user"></i>
                    <h3 class="left-content-heading">Explore what people are talking about</h3>
                </div>
                <div>
                    <i class="fa fa-comment"></i>
                    <h3 class="left-content-heading">Join the people</h3>
                </div>
             </div>
         </div>
         <!-- end of left page -->
         <!-- right -->
         <div class="right">
             <div class="middle-content">
                 <i class="fa fa-twitter"></i>
                 <h1>See what’s happening in the world right now</h1>
                 <h4>Join Twirrer today</h4>
                 <a href="<?php echo url_for('signup.php'); ?>" class="sign-up btn">Sign Up</a>
                 <a href="<?php echo url_for('login.php'); ?>" class="log-in btn">Log in</a>
             </div>
         </div>
         <!-- end of right -->
         <!-- Footer -->
         <?php require_once 'backend/shared/footer.php'; ?>
        