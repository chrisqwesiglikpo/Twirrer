var u_id = $('.u_p_id').data('uid');
$(function(){
    var modal = document.querySelector(".retweet-modal-container");
    
     // When the user clicks on the button, open the modal
     $(document).on("click",".retweet",function(){
              $post_id=$(this).data('post');
              $user_id=u_id;
              modal.style.display="block";
              $postedBy=$(this).data('postedby');
              $counter=$(this).find('.retweetsCount');
              $count=$counter.text();
              $button=$(this);
              $.post('http://localhost/twirrer/backend/ajax/retweet.php',{showPopup:$post_id,postedBy:$postedBy,user_id:$user_id},function(data){
                $(".retweet-modal-container").html(data);
            
            });
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
                    
                    // $button.removeClass('commented').addClass('replyModal');
                    // $button.removeClass('replyCountColor');
                    // counter.removeClass('replyCountColor');
                    $button.removeClass('retweeted').addClass('retweet');
                    
                
                } else{
                    // $button.removeClass('replyModal').addClass('commented');
                    $button.removeClass('retweet').addClass('retweeted');
                    // counter.addClass('replyCountColor');
                
                    
                }
            
               
        });

     });
    //  $(document).on("click",".replyModal,.commented",function(){
    //     $post_id=$(this).data('post');
    //     $user_id=u_id;
    //     let isModal=$(this).hasClass('commented');
    //     if(isModal){
    //         $.post('http://localhost/twirrer/backend/ajax/reply.php',{deleteCommentOn:$post_id,deleteCommentBy:$user_id},function(data){
    //             let result=JSON.parse(data);
    //             let counter=$button.find('.replyCount');
    //             updateCommentValue(counter,result.deletecomment);
    //             // $button.removeClass('retweet').addClass('retweeted');
    //             if(result.deletecomment <0){   
    //                 // $button.removeClass('retweeted').addClass('retweet');
    //                 $button.removeClass('commented').addClass('replyModal');
    //                 $button.removeClass('replyCountColor');
    //                 counter.removeClass('replyCountColor');
    //                 // $('.retweet-header').hide();
    //                 // $('.retweet-text-reply').hide();
    //                 console.log(result.deletecomment);
    //             }
            
    //         });
    //     }else{
    //         modal.style.display="block";
    //         $postedBy=$(this).data('postedby');
    //         $counter=$(this).find('.retweetsCount');
    //         $count=$counter.text();
    //         $button=$(this);
        
    //         $.post('http://localhost/twirrer/backend/ajax/reply.php',{showPopup:$post_id,postedBy:$postedBy,user_id:$user_id},function(data){
    //             $(".reply-wrapper").html(data);
            
    //         });
    //     }
        

      
        
       
    // });
       
    // $(document).on("click","#replyBtn",function(e){
        
    //      let user_id=u_id;
    //      let post_id=$button.data('post');
    //      let counter=$button.find('.replyCount');
        
    
    //      let textbox=$("#replyInput").val();
        
        
       
      
    //         $.post('http://localhost/twirrer/backend/ajax/reply.php',{commentBy:user_id,commentOn:post_id,comment:textbox},function(data){
    //             $('.reply-wrapper').hide();
               
             
    //             let result=JSON.parse(data);
                
                
    //             updateCommentValue(counter,result.comment);
    //             // $button.removeClass('retweet').addClass('retweeted');
    //             if(result.comment <0){   
    //                 // $button.removeClass('retweeted').addClass('retweet');
    //                 $button.removeClass('commented').addClass('replyModal');
    //                 $button.removeClass('replyCountColor');
    //                 counter.removeClass('replyCountColor');
    //                 // $('.retweet-header').hide();
    //                 // $('.retweet-text-reply').hide();
    //                 console.log(result.comment);
    //             } else{
    //                 $button.removeClass('replyModal').addClass('commented');
    //                 $button.addClass('replyCountColor');
    //                 counter.addClass('replyCountColor');
    //                 //  $button.removeClass('retweet').addClass('retweeted');
    //                 console.log(result.comment);
    //             }
            
    //             });
       
       
    
    // });



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