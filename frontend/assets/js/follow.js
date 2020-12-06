var u_id = $('.u_p_id').data('uid');
var p_id = $('.u_p_id').data('pid');
$(function(){
  $('.followButton').click(function(){
     var followID=$(this).data('follow');
     $button=$(this);
     if($button.hasClass('follow-btn')){
         $.post('http://localhost/twirrer/backend/ajax/follow.php',{unfollow:followID,user_id:u_id,profile:p_id},function(data){
           data=JSON.parse(data);
           $button.removeClass('follow-btn');
           $button.removeClass('following');
           $button.addClass('unfollow-btn');
           $button.text('Follow');
           $('.count-following').text(data.following);
           $('.count-followers').text(data.followers);
         });
     }else{
        $.post('http://localhost/twirrer/backend/ajax/follow.php',{follow:followID,user_id:u_id,profile:p_id},function(data){
            data=JSON.parse(data);
            $button.addClass('follow-btn');
            $button.addClass('following');
            $button.removeClass('unfollow-btn');
            $button.text('Following');
            $('.count-following').text(data.following);
            $('.count-followers').text(data.followers);
          });
     }
  });
  $('.followButton').hover(function(){
    $button=$(this);
    if($button.hasClass('following')){
       $button.addClass('unfollowing');
       $button.text('Unfollow');
    }
  }, function(){
  if($button.hasClass('following')){
       $button.removeClass('unfollowing');
       $button.text('Following');
    }
  });


});