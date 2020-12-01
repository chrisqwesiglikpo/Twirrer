$(document).ready(function(){
    loadPosts();
})

function loadPosts(){
    var u_id = $('.u_p_id').data('uid');
    var offset=10;
            // $('#loader').show();
            $.post('http://localhost/twirrer/backend/ajax/fetchPosts.php',
                {fetchPosts:offset,userid:u_id},function(data){
                 $('.postsContainer').html(data);
                //  $('#loader').hide();
        });
}