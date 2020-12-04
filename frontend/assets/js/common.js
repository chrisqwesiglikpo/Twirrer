var u_id = $('.u_p_id').data('uid');
$(function() {
  var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
  $('#nav a').each(function() {
   if (this.href === path) {
    $(this).addClass('active');
   }
  });
 });
//  ,#replyTextarea
$("#postTextarea").keyup(e=>{
  let textbox=$(e.target);
  let value=textbox.val().trim();
  
  let submitButton=$("#submitPostButton");
  if(submitButton.length ==0) return alert("No submit button not found");
  
  if(value ==""){
    submitButton.prop("disabled",true);
    return;
  }
  submitButton.prop("disabled",false);
});


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

$(function(){
 var span = document.getElementsByClassName("close")[0];

  $(document).on('click','#replyModal',function(e){
    document.getElementById("myModal").style.display="block";
  });
  span.onclick = function() {
    document.getElementById("myModal").style.display = "none";
  }
});

$(document).on('click','#replyModal',function(e){
  let postid=$(this).data('post');
  console.log(postid);
});