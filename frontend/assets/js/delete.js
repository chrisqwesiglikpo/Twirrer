var u_id = $('.u_p_id').data('uid');
$(function() {

    var modal = document.querySelector(".d-wrapper-container");
    var deleteModal=document.querySelector(".del-post-wrapper-container");
    
    
     // When the user clicks on the button, open the modal
     $(document).on("click","#deletePostModal",function(){
        modal.style.display="block";
        
     });
     $(document).on("click","#del-content",function(){
        deleteModal.style.display="block";
     })

     $(document).on("click","#cancel",function(){
        deleteModal.style.display="none";
     })
     
     
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