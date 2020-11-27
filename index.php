<?php
 include 'backend/init.php';

 $db=Database::instance();
 $db->prepare("Select * from users");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <title>Twitter.It's what's happening / Twitter</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"
      integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay"
      crossorigin="anonymous"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600,700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="frontend/assets/css/style.css">
</head>
<body>
    <!-- main page -->
    <section class="main-page">
         <!-- left -->
         <div class="left">
             <div class="left-content">
                 <div>
                     <i class="fas fa-search"></i>
                     <h3 class="left-content-heading">Find your interests</h3>
                 </div>
                 <div>
                    <i class="fas fa-user-friends"></i>
                    <h3 class="left-content-heading">Explore what people are talking about</h3>
                </div>
                <div>
                    <i class="fas fa-comment"></i>
                    <h3 class="left-content-heading">Join the people</h3>
                </div>
             </div>
         </div>
         <!-- end of left page -->
         <!-- right -->
         <div class="right">
             <div class="middle-content">
                 <i class="fab fa-twitter"></i>
                 <h1>See what’s happening in the world right now</h1>
                 <h4>Join Twirrer today</h4>
                 <a href="signup.php" class="sign-up btn">Sign Up</a>
                 <a href="login.php" class="log-in btn">Log in</a>
             </div>
         </div>
         <!-- end of right -->
         <!-- Footer -->
         <footer class="main-page-footer">
                <ul>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                    <li><a href="#">Ads info</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Status</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Brand Resources</a></li>
                    <li><a href="#">Advertising</a></li>
                    <li><a href="#">Marketing</a></li>
                    <li><a href="#">Advertising</a></li>
                    <li><a href="#">Twitter for Business</a></li>
                    <li><a href="#">Developers</a></li>
                    <li><a href="#">Directory</a></li>
                    <li><a href="#">Settings</a></li>
                    <li><a href="#">&copy;2020 Twitter,Inc</a></li>
                </ul>  
         </footer>
         <!-- End of Footer -->
    </section>
    <!-- end of main page -->
    
</body>
</html>