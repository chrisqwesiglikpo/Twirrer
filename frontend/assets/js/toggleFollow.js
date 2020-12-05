var u_id = $('.u_p_id').data('uid');
$(function(){
  $('.follow-btn').click(function(){
     var followID=$(this).data('follow');
     var p_id=$(this).data('profileid');
     $button=$(this);
     
     if($button.hasClass('follow-home')){
         $.post('http://localhost/twirrer/backend/ajax/follow-home.php',{follow:followID,user_id:u_id,profile:p_id},function(data){
           data=JSON.parse(data);
           $button.removeClass('follow-home');
           $button.addClass('unfollow-home');
           $button.text('Following');
        
         });
     }else{
        $.post('http://localhost/twirrer/backend/ajax/follow-home.php',{unfollow:followID,user_id:u_id,profile:p_id},function(data){
            data=JSON.parse(data);
            $button.addClass('follow-home');
            $button.removeClass('unfollow-home');
            $button.text('Follow');
        
          });
     }
  });

});