<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <title>Login on Twitter / Twitter</title>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <section class="login-page">
       <nav class="login-page-nav">
         <ul>
           <li class="brand"><a href="#"><i class="fab fa-twitter"></i> Home</a></li>
           <li><a href="#">About</a></li>
           <li><a href="#">Language:English</a></li>
         </ul>
       </nav>
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
           <p>New to Twitter? <a href="signup.php">Sign up for Twitter</a></p>
         </footer>
       </div>
    </section>
</body>
</html>