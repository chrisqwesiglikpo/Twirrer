var u_id = $('.u_p_id').data('uid');
var p_id = $('.u_p_id').data('pid'); 
var timer;
$(function() {
  var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
  $('#nav a').each(function() {
   if (this.href === path) {
    $(this).addClass('active');
   }
  });
 });

 $(document).on("keyup","#postTextarea, #replyInput",function(e){
      let textbox=$(e.target);
      let value=textbox.val().trim();
  
    
      let isModal=textbox.parents(".reply-wrapper").length==1;
      
      
      
      let submitButton=isModal ? $("#replyBtn") : $("#submitPostButton") ;
      if(submitButton.length ==0) return alert("No submit button not found");
          
      if(value ==""){
          submitButton.prop("disabled",true);
          return;
        }
        submitButton.prop("disabled",false);
     
})


$("#userSearchTextbox").keydown((event) => {
  clearTimeout(timer);
  var textbox = $(event.target);
  var value = textbox.val();

  if (value == "" && event.keycode == 8) {
      // remove user from selection
      return;
  }

  timer = setTimeout(() => {
      value = textbox.val().trim();

      if(value == "") {
          $(".resultsContainer").html("");
      }
      else {
          $.get("http://localhost/twirrer/backend/ajax/searchChatUser.php",{searchTerm:value,userid:u_id},function(data){
            $(".resultsContainer").html(data);
          })
      }
  }, 1000)

})

// //  ,#replyTextarea
// $("#postTextarea").keyup(e=>{
//   let textbox=$(e.target);
//   let value=textbox.val().trim();

 
  
//   let submitButton=$("#submitPostButton");
//   if(submitButton.length ==0) return alert("No submit button not found");
  
//   if(value ==""){
//     submitButton.prop("disabled",true);
//     return;
//   }
//   submitButton.prop("disabled",false);
//   // console.log( submitButton.prop("disabled",false));
// });


$("#submitPostButton").click(e=>{
  e.preventDefault();
  let button=$(e.target);
  let textbox=$("#postTextarea").val();
  let userid=u_id;

  $.post('http://localhost/twirrer/backend/ajax/post.php',{userid:u_id,onlyStatusText:textbox},function(data){
    $('.postsContainer').html(data);
    $("#postTextarea").val("");
      button.prop("disabled",true);
  });
});


$(document).on('click','.go-back-arrow', function () {
  
  if(p_id !==undefined){
    $.post('http://localhost/twirrer/backend/ajax/getUsername.php',{post_id:p_id},function(data){
        window.location.href = "http://localhost/twirrer/"+data;
    });
  }
  
});


$(document).on('click','.go-back-arrow-home', function () {

  window.location.href = "http://localhost/twirrer/home";
  
});


