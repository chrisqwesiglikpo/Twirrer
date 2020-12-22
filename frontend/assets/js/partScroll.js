$(function(){
    var u_id = $('.u_p_id').data('uid');
    var chat_id=$('.resultsContainer__part').data('chat');
    var win=$(window);
    var offset=5;
 
    win.scroll(function(){
        if($(document).height()<= (win.height()+ win.scrollTop())){
            offset +=5;
            // $('#loader').show();
            $.post('http://localhost/twirrer/backend/ajax/fetchChat.php',
                {fetchGroupP:offset,userid:u_id,chatid:chat_id},function(data){
                    // alert(data);
                $('.resultsContainer__part').html(data);
                //  $('#loader').hide();
                });
        }
    });
 });