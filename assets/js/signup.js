$(document).ready(function(){
   let fname="";
   let lname="";
   let email="";
   let pass="";
   let cpass="";
   let nameReg=/^[a-zA-Z ]+$/;
   let emailRegex=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

   $("#fname").focusout(function(){

       let fnameValue=document.getElementById("fname").value.trim();
       if(fnameValue.length==""){
          $(".fname-error").html("First name is required!");
          $("#fname").addClass("border-red");
            $("#fname").removeClass("border-green");
          fname="";
       }else if(!nameReg.test(fnameValue)){
            $(".fname-error").html("Only letters and white space allowed");  
            $("#fname").addClass("border-red");
              $("#fname").removeClass("border-green");
            fname=""
       }else{
           $(".fname-error").html("");  
            $("#fname").addClass("border-green");
            $("#fname").removeClass("border-red");
            fname=fnameValue;
       }
   })

    $("#lname").focusout(function(){

       let lnameValue=document.getElementById("lname").value.trim();
       if(lnameValue.length==""){
          $(".lname-error").html("Last name is required!");
          $("#lname").addClass("border-red");
            $("#lname").removeClass("border-green");
          lname="";
       }else if(!nameReg.test(lnameValue)){
            $(".lname-error").html("Only letters and white space allowed");  
            $("#lname").addClass("border-red");
              $("#lname").removeClass("border-green");
            lname=""
       }else{
           $(".lname-error").html("");  
            $("#lname").addClass("border-green");
            $("#lname").removeClass("border-red");
            lname=lnameValue;
          
       }
   })

   $("#email").focusout(function(){
       let emailValue=document.getElementById("email").value.trim();
       if(emailValue.length==""){
          $(".email-error").html("Email is required!");
          $("#email").addClass("border-red");
            $("#email").removeClass("border-green");
          email="";
       }else if(!emailRegex.test(emailValue)){
             $(".email-error").html("Invalid Email formate");
             $("#email").addClass("border-red");
             $("#email").removeClass("border-green");
             email="";
       }else{
              $.ajax({
                type:'POST',
                url:'ajax/signup.php',
                dataType:'JSON',
                beforeSend:function(){
                  $(".email-error").html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>');
                },
                data:{'checkEmail': emailValue},
                success:function(feedback){
                   setTimeout(function(){
                    if(feedback['error']==='email_success'){
                      $(".email-error").html("<div class='text-success'><i class='fa fa-check-circle'></i> Email Available</div>");  
                      $("#email").addClass("border-green");
                      $("#email").removeClass("border-red");
                          email=emailValue;
                      }else if(feedback['error']==='email_fail'){
                        $(".email-error").html("Email already exist");
                        $("#email").addClass("border-red");
                        $("#email").removeClass("border-green");
                        email="";
                      }
                   },3000)
                   
                }
            })
       }
   })

   $("#password").focusout(function(){
    let passwordValue=document.getElementById("password").value.trim();
    if(passwordValue.length==""){
      $(".password-error").html("Password is Required");  
      $("#passsword").addClass("border-red");
      $("#password").removeClass("border-green");
      pass="";
    }else if(passwordValue.length < 8){
      $(".password-error").html("Password  must be at least 8 characters!");  
      $("#passsword").addClass("border-red");
      $("#password").removeClass("border-green");
      pass="";
    }else{
      $(".password-error").html("<div class='text-success'><i class='fa fa-check-circle'></i> Your Password is strong!</div>");   
      $("#password").addClass("border-green");
      $("#password").removeClass("border-red");
      pass=passwordValue;
    }
   })

   $("#cpassword").focusout(function(){
    let cpasswordValue=document.getElementById("cpassword").value.trim();
    if(cpasswordValue.length==""){
      $(".confirm-error").html("Confirm Password is Required!");  
      $("#cpasssword").addClass("border-red");
      $("#password").removeClass("border-green");
      cpass="";
    }else if(cpasswordValue != pass){
      $(".confirm-error").html("Password do not  match!");  
      $("#cpassword").addClass("border-red");
      $("#cpassword").removeClass("border-green");
      cpass="";
    }else{
      $(".confirm-error").html("");  
      $("#cpassword").addClass("border-green");
      $("#cpassword").removeClass("border-red");
      cpass=cpasswordValue;
    }
   })

   $("#signup").click(function(){
    if(fname.length==""){
        $(".fname-error").html("First name is required!");
        $("#fname").addClass("border-red");
        $("#fname").removeClass("border-green");
        fname="";
   }
   if(lname.length==""){
      $(".lname-error").html("Last name is required!");
      $("#lname").addClass("border-red");
      $("#lname").removeClass("border-green");
    lname="";
 }
  if(email.length==""){
     $(".email-error").html("Email is required!");
     $("#email").addClass("border-red");
     $("#email").removeClass("border-green");
     email="";
}

  if(pass.length==""){
      $(".password-error").html("Password is Required");  
      $("#passsword").addClass("border-red");
      $("#password").removeClass("border-green");
      pass="";
}
if(cpass.length==""){
  $(".confirm-error").html("Confirm Password is Required!");  
  $("#cpasssword").addClass("border-red");
  $("#password").removeClass("border-green");
  cpass="";
}
     if(fname.length != "" && lname.length !="" && email.length != "" && pass.length !="" && cpass.length !=""){
        $.ajax({
          type:'POST',
          url:'ajax/signup.php?signup=true',
          dataType:'JSON',
          data:$("#formData").serialize(),
          success:function(feedback){
            console.log(feedback);
          }
        })
     }
   })

   
})