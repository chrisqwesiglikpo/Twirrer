var u_id = $('.u_p_id').data('uid');

$(function() {
  
    function notificationUpdate(userid){
        $.post("http://localhost/twirrer/backend/ajax/notify.php",{notificationUpdate:userid},function(data){
            if(data.trim()=='0'){
                $('.notification-count').empty();
                $('.notification-count').css({"background-color":"transparent"});
            }else{
                 $('.notification-count').html(data);
            }
        })
    }
   
    var notificationInterval;
    notificationInterval=setInterval(function(){
        notificationUpdate(u_id);
    },1000);

    $(document).on('click','.notification-container', function () {
        let user_id=u_id;
       
       
       if(user_id !==undefined){
         $.post('http://localhost/twirrer/backend/ajax/notify.php',{notify:user_id},function(data){
             
         });
       }
       
     });

     $(document).on('click','.unread-notification',function(){
        $(this).removeClass('unread-notification').addClass('read-notification');
        var profileid=$('.notify-container').data('profileid'); 
        var userid=u_id;
        var postid=$('.notify-container').data('post'); 

        if(userid !==undefined){
            $.post('http://localhost/twirrer/backend/ajax/notify.php',{statusUpdate:userid,profileid:profileid,postid:postid},function(data){
                
            });
          }
     });
});