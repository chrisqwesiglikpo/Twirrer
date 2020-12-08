$(function(){
    var modal = document.querySelector(".reply-wrapper");
    
     // When the user clicks on the button, open the modal
     $(document).on("click",".replyModal",function(){
           
        modal.style.display="block";

        $post_id=$(this).data('post');
        $user_id=$(this).data('user');
        $postedBy=$(this).data('postedby');
        $counter=$(this).find('.retweetsCount');
        $count=$counter.text();
        $button=$(this);
      
       $.post('http://localhost/twirrer/backend/ajax/reply.php',{showPopup:$post_id,postedBy:$postedBy,user_id:$user_id},function(data){
        //    $(".reply-wrapper").html(data);
          alert(data);
        });
       
    });
       
   

    // When the user clicks on <span> (x), close the modal
    $(document).on("click",".close",function(){
        modal.style.display="none";
    });

    // When the user clicks anywhere outside of the modal, close it
    $(window).on("click",function(e){
        if (e.target == modal) {
            modal.style.display = "none";
          }
    });
  



});