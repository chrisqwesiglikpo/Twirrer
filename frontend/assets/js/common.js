var u_id = $('.u_p_id').data('uid');
var p_id = $('.u_p_id').data('pid'); 
var timer;
var selectedUsers=[];
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

  if (value == "" && (event.which==8 || event.keyCode == 8)) {
      // remove user from selection
      selectedUsers.pop();
      updateSelectedUsersHtml();
      $(".resultsContainer").html("");
      if(selectedUsers.length==0){
        $("#createChatButton").prop("disabled",true);
      }
      return;
  }

  timer = setTimeout(() => {
      $value = textbox.val().trim();

      if($value == "") {
          $(".resultsContainer").html("");
      }
      else {
          $.get("http://localhost/twirrer/backend/ajax/searchChatUser.php",{searchTerm:$value,userid:u_id},function(data){
            $(".resultsContainer").html(data);

            $('ul li.resultsContainer__listitem').click(function(){
              var username=$.trim($(this).find(".resultsContainer__listitem-name span span.username__listitem").text());
              // console.log(value);
              $.get("http://localhost/twirrer/backend/ajax/searchChatUser.php",{searchResult:username},function(results){
                  let result=JSON.parse(results);
                  if(selectedUsers.some(u=>u.user_id==result.user_id)){
                    return;
                  }
                  selectedUsers.push(result);
                  updateSelectedUsersHtml();
                  $("#userSearchTextbox").val("").focus();
                  $(".resultsContainer").html("");
                  $("#createChatButton").prop("disabled",false);
                  
              });
              // var oldContent=$('#postTextarea').val();
              // var newContent=oldContent.replace(regex,"");

              // $('#postTextarea').val(newContent+value+' ');
              // $('.hash-box li').hide();
              // $('#postTextarea').focus();
         });
          });
      }
  }, 1000)

});

function updateSelectedUsersHtml(){
   var elements=[];
   selectedUsers.forEach(user=>{
     var name=user.firstName+" "+user.lastName;
     var user_id=user.user_id;
     var userElement=$(`<div class="selectedUser" data-profile="${user_id}">
                          <div class="selectedUser__wrapper">
                              <img src="http://localhost/twirrer/${user.profilePic}"/>
                          </div>
                          <h3>${name}</h3>
                          <span class="selectedUser__close-items"><svg viewBox="0 0 24 24"><g><path d="M13.414 12l5.793-5.793c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0L12 10.586 6.207 4.793c-.39-.39-1.023-.39-1.414 0s-.39 1.023 0 1.414L10.586 12l-5.793 5.793c-.39.39-.39 1.023 0 1.414.195.195.45.293.707.293s.512-.098.707-.293L12 13.414l5.793 5.793c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L13.414 12z" fill="#69C1F7"></path></g></svg></span>
                </div>`);
     elements.push(userElement);
   });

   $(".selectedUser").remove();
   $("#selectedUsers").append(elements);
}



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

$(document).on('click','.notify-container', function () {
   var profileid=$('.notify-container').data('profileid'); 
  
  
  if(profileid !==undefined){
    $.post('http://localhost/twirrer/backend/ajax/getUsername.php',{post_id:profileid},function(data){
        window.location.href = "http://localhost/twirrer/"+data;
    });
  }
  
});


$(document).on('click','.go-back-arrow-home', function () {

  window.location.href = "http://localhost/twirrer/home";
  
});


