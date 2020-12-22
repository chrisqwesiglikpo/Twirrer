$(function(){
    var u_id = $('.u_p_id').data('uid');
    var chat_id=$('.resultsContainer__msg').data('chat');
    var win=$(window);
    var offset=5;
 
    win.scroll(function(){
        if($(document).height()<= (win.height()+ win.scrollTop())){
            offset +=5;
            // $('#loader').show();
            $.post('http://localhost/twirrer/backend/ajax/fetchChat.php',
                {fetchGroup:offset,userid:u_id,chatid:chat_id},function(data){
                    // alert(data);
                $('.resultsContainer__msg').html(data);
                //  $('#loader').hide();
                });
        }
    });
 });