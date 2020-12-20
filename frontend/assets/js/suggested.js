$(function(){
    var u_id = $('.u_p_id').data('uid');
    var p_id = $('.u_p_id').data('pid');
    var win=$(window);
    var offset=5;
 
    win.scroll(function(){
        if($(document).height()<= (win.height()+ win.scrollTop())){
            offset +=5;
            // $('#loader').show();
            $.post('http://localhost/twirrer/backend/ajax/fetchSuggested.php',
                {fetchSuggest:offset,userid:u_id,profileid:p_id},function(data){
                    // alert(data);
                $('.resultsContainer__suggest').html(data);
                //  $('#loader').hide();
                });
        }
    });
 });