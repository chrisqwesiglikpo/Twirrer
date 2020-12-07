   $(function(){
    var modal = document.querySelector(".retweet-modal-container");

      // When the user clicks on the button, open the modal
      $(document).on("click",".retweet",function(){
           
          modal.style.display="block";
         
          
          $post_id=$(this).data('post');
          $user_id=$(this).data('user');
          $postedBy=$(this).data('postedby');
          $counter=$(this).find('.retweetsCount');
          $count=$counter.text();
          $button=$(this);
        
         $.post('http://localhost/twirrer/backend/ajax/retweet.php',{showPopup:$post_id,postedBy:$postedBy,user_id:$user_id},function(data){
             $(".retweet-modal-container").html(data);
          });
      })
    
        

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

        $(document).on("click",".retweet-btn",function(){
            let comment=$('.retweet-comment').val();
             
            $.post('http://localhost/twirrer/backend/ajax/retweet.php',{retweet:$post_id,user_id:$user_id,postedBy:$postedBy},function(data){
                $('.retweet-modal-container').hide();
                // let result=JSON.parse(data);
                // updateLikesValue($button.find(".retweetsCount"),result.likes);
                // $count++;
                // $counter.text($count);
            
                let result=JSON.parse(data);
            
                updateLikesValue($counter,result.retweet);
                // $button.removeClass('retweet').addClass('retweeted');
                if(result.retweet <0){   
                    $button.removeClass('retweeted').addClass('retweet');
                } else{
                     $button.removeClass('retweet').addClass('retweeted');
                }
            
                });
        
        });
      
        function updateLikesValue(element,num){
            let retweetCountVal=element.text() || "0";
            element.text(parseInt(retweetCountVal) + parseInt(num));;
         }
         
         $(document).on("click",".retweeted",function(){
            let post_id=$(this).data('post');
            let user_id=$(this).data('user');
            let button=$(this);

            $.post('http://localhost/twirrer/backend/ajax/retweet.php',{deretweet:post_id,user_id:user_id},function(data){
                button.removeClass('retweeted').addClass('retweet');
                $(".retweetsCount").text("");
            })
         })
       
 
   });