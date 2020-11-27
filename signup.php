<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <title>Sign up for Twitter / Twitter</title>
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
    <link rel="stylesheet" href="assets/css/signup.css">
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
           <p>Already have  an account? <a href="login.php">Login now</a></p>
         </footer>
       </div>
    </section>

    <script src="assets/js/signup.js"></script>
</body>
</html>