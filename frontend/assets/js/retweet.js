   $(function(){
    var modal = document.querySelector(".retweet-modal-container");

      // When the user clicks on the button, open the modal
       $(document).on("click",".retweet",function(){
          modal.style.display="block";
           let post_id=$(this).data('post');
           let user_id=$(this).data('user');
           let postedBy=$(this).data('postedby');
           $counter=$(this).find('.retweetsCount');
           $count=$counter.text();
           $button=$(this);
       $.post('http://localhost/twirrer/backend/ajax/retweet.php',{showPopup:post_id,postedBy:postedBy,user_id:user_id},function(data){
              $(".retweet-modal-container").html(data);
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