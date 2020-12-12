var u_id = $('.u_p_id').data('uid');
$(function() {

    var modal = document.querySelector(".d-wrapper-container");
    var deleteModal=document.querySelector(".del-post-wrapper-container");
    
    
     // When the user clicks on the button, open the modal
     $(document).on("click","#deletePostModal",function(){
        $post_id=$(this).data('post');
        // alert($post_id);
        modal.style.display="block";
        
     });
     $(document).on("click","#del-content",function(){
        deleteModal.style.display="block";
     })

     $(document).on("click","#cancel",function(){
        deleteModal.style.display="none";
     })

     $(document).on("click","#delete-post-btn",function(){
        let user_id=u_id;
        let post_id=$post_id;
        $.post("http://localhost/twirrer/backend/ajax/deletePost.php",{post_id:post_id,postedBy:user_id},function(data){
           location.reload(true);
        })
     });
     
     
    // When the user clicks anywhere outside of the modal, close it
    $(window).on("click",function(e){
        if (e.target == modal) {
            modal.style.display = "none";
          }
    });

    $(window).on("click",function(e){
        if (e.target == deleteModal) {
            deleteModal.style.display = "none";
          }
    });
});