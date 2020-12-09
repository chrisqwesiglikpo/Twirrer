var u_id = $('.u_p_id').data('uid');
$(function(){
    var modal = document.querySelector(".reply-wrapper");
    
     // When the user clicks on the button, open the modal
     $(document).on("click",".replyModal,.commented",function(){
        $post_id=$(this).data('post');
        $user_id=u_id;
        $button=$(this);
        let isModal=$(this).hasClass('commented');
        if(isModal){
            $.post('http://localhost/twirrer/backend/ajax/reply.php',{deleteCommentOn:$post_id,deleteCommentBy:$user_id},function(data){
                let result=JSON.parse(data);
                let counter=$button.find('.replyCount');
                updateCommentValue(counter,result.deletecomment);
                // $button.removeClass('retweet').addClass('retweeted');
                if(result.deletecomment <0){   
                    // $button.removeClass('retweeted').addClass('retweet');
                    $button.removeClass('commented').addClass('replyModal');
                    $button.removeClass('replyCountColor');
                    counter.removeClass('replyCountColor');
                    // $('.retweet-header').hide();
                    // $('.retweet-text-reply').hide();
                    console.log(result.deletecomment);
                }
            
            });
        }else{
            modal.style.display="block";
            $postedBy=$(this).data('postedby');
            $counter=$(this).find('.replyCounts');
            $count=$counter.text();
            $button=$(this);
        
            $.post('http://localhost/twirrer/backend/ajax/reply.php',{showPopup:$post_id,postedBy:$postedBy,user_id:$user_id},function(data){
                $(".reply-wrapper").html(data);
            
            });
        }
        

      
        
       
    });
       
    $(document).on("click","#replyBtn",function(e){
        
         let user_id=u_id;
         let post_id=$button.data('post');
         let counter=$button.find('.replyCount');
        
    
         let textbox=$("#replyInput").val();
        
        
       
      
            $.post('http://localhost/twirrer/backend/ajax/reply.php',{commentBy:user_id,commentOn:post_id,comment:textbox},function(data){
                $('.reply-wrapper').hide();
               
             
                let result=JSON.parse(data);
                
                
                updateCommentValue(counter,result.comment);
               
                if(result.comment <0){   
                    
                    $button.removeClass('commented').addClass('replyModal');
                    $button.removeClass('replyCountColor');
                    counter.removeClass('replyCountColor');
                    
                   
                } else{
                    $button.removeClass('replyModal').addClass('commented');
                    $button.addClass('replyCountColor');
                    counter.addClass('replyCountColor');
                   
                    
                }
            
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