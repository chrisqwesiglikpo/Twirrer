var u_id = $('.u_p_id').data('uid');
$(function(){
    var modal = document.querySelector(".retweet-modal-container");
    
     // When the user clicks on the button, open the modal
     $(document).on("click",".retweet,.retweeted",function(){
              $post_id=$(this).data('post');
              $user_id=u_id;
              $counter=$(this).find('.retweetsCount');
              $button=$(this);
              let isRetweeted=$button.hasClass('retweeted');
              if(isRetweeted){
                $.post('http://localhost/twirrer/backend/ajax/retweet.php',{deretweet:$post_id,user_id:$user_id},function(data){
                    let result=JSON.parse(data);
                 
                    let counter=$button.find('.retweetsCount');
                    updateCommentValue(counter,result.deleteretweet);
            
                    if(result.deleteretweet <0){   
                        $(".retweet-header").hide();
                        $(".retweet-text-reply.mainContentContainer").hide();
                        $button.removeClass('retweeted').addClass('retweet');
                  
                    }
                
                });
              }else{
                    modal.style.display="block";
                    $postedBy=$(this).data('postedby');
                    $.post('http://localhost/twirrer/backend/ajax/retweet.php',{showPopup:$post_id,postedBy:$postedBy,user_id:$user_id},function(data){
                    $(".retweet-modal-container").html(data);
                
                });

              }

            
     })

     $(document).on("click",".retweet-btn",function(){
        let post_id=$button.data('post');
        $user_id=u_id;
        let retweetComment=$("#retweet-comment").val().trim();
       
        $.post('http://localhost/twirrer/backend/ajax/retweet.php',{retweet:$post_id,comment:retweetComment,user_id:$user_id},function(data){
                
                $('.retweet-modal-container').hide();
                
                
                let result=JSON.parse(data);
                
                
                updateCommentValue($counter,result.retweet);
               
            
                if(result.retweet <0){   
                    $(".retweet-header").hide();
                    $button.removeClass('retweeted').addClass('retweet');
                    
                
                } else{
                
                    $button.removeClass('retweet').addClass('retweeted');
                    
                
                    
                } 
               
        });

     });

     $(document).on("click",".retweet-btn",function(){
        let post_id=$button.data('post');
        $user_id=u_id;
       
       
        $.post('http://localhost/twirrer/backend/ajax/retweetPost.php',{retweet:$post_id,user_id:$user_id},function(data){
                
                $('.retweet-modal-container').hide();
                $('.postsContainer').html(data);
                // console.log(data);
                // let result=JSON.parse(data);
                
                
                // updateCommentValue($counter,result.retweet);
               
            
                // if(result.retweet <0){   
                    
                //     $button.removeClass('retweeted').addClass('retweet');
                    
                
                // } else{
                
                //     $button.removeClass('retweet').addClass('retweeted');
                    
                
                    
                // } 
               
        });

     });


    function updateCommentValue(element,num){
        let commentCountVal=element.text() || "0";
         element.text(parseInt(commentCountVal) + parseInt(num));
     }

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