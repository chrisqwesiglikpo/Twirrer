$(function(){
    var u_id = $('.u_p_id').data('uid');
    var win=$(window);
    var offset=10;
 
    win.scroll(function(){
        if($(document).height()<= (win.height()+ win.scrollTop())){
            offset +=10;
            // $('#loader').show();
            $.post('http://localhost/twirrer/backend/ajax/fetchPosts.php',
                {fetchPosts:offset,userid:u_id},function(data){
                 $('.postsContainer').html(data);
                //  $('#loader').hide();
                });
        }
    });
 });