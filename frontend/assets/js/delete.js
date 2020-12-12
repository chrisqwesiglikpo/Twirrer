var u_id = $('.u_p_id').data('uid');
$(function() {

    var modal = document.querySelector(".d-wrapper-container");
    
     // When the user clicks on the button, open the modal
     $(document).on("click","#deletePostModal",function(){
        modal.style.display="block";
        
     });
     
    // When the user clicks anywhere outside of the modal, close it
    $(window).on("click",function(e){
        if (e.target == modal) {
            modal.style.display = "none";
          }
    });
});