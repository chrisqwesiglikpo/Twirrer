var u_id = $('.u_p_id').data('uid');
  $(function(){
    var modal = document.querySelector(".retweet-modal-container");

    let retweet=$('.retweet') ? '.retweet' : '.retweeted';
      // When the user clicks on the button, open the modal
      $(document).on("click",retweet,function(){
         console.log(retweet);
          modal.style.display="block";
         
          
          $post_id=$(this).data('post');
        //   $user_id=$(this).data('user');
          $postedBy=$(this).data('postedby');
          $counter=$(this).find('.retweetsCount');
          $count=$counter.text();
          $button=$(this);
        
         $.post('http://localhost/twirrer/backend/ajax/retweet.php',{showPopup:$post_id,postedBy:$postedBy,user_id:u_id},function(data){
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
            let $comment=document.querySelector("#retweet-comment").value.trim();
            let post_id=$button.data('post');
            // let user_id=$button.data('user');
           
          
                $.post('http://localhost/twirrer/backend/ajax/retweet.php',{retweet:post_id,user_id:u_id,comment:$comment},function(data){
                    $('.retweet-modal-container').hide();
                   
                
                    $result=JSON.parse(data);
                    
                    
                    updateLikesValue($counter,$result.retweet);
                    // $button.removeClass('retweet').addClass('retweeted');
                    if($result.retweet <0){   
                        $button.removeClass('retweeted').addClass('retweet');
                        $('.retweet-header').hide();
                        $('.retweet-text-reply').hide();
                    } else{
                         $button.removeClass('retweet').addClass('retweeted');
                    }
                
                    });
           
           
        
        });

        $(document).on("click","#retweet-btn",function(){
            // let comment=document.querySelector("#retweet-comment").value.trim();
            let post_id=$button.data('post');
            // let user_id=$button.data('user');
           
          
                $.post('http://localhost/twirrer/backend/ajax/retweetPost.php',{retweet:post_id,user_id:u_id},function(data){
                    $('.retweet-modal-container').hide();
                    $('.postsContainer').html(data);
                    updateLikesValue($counter,$result.retweet);
                    if($result.retweet <0){   
                        $button.removeClass('retweeted').addClass('retweet');
                        $('.retweet-header').hide();
                    } else{
                         $button.removeClass('retweet').addClass('retweeted');
                         $('.postsContainer').html(data);
                    }
                
                    });      
        
        });

        
      
        function updateLikesValue(element,num){
            let retweetCountVal=element.text() || "0";
            element.text(parseInt(retweetCountVal) + parseInt(num));;
         }
         
         $(document).on("click",".retweeted",function(){
            let post_id=$(this).data('post');
            let user_id=u_id;
            let button=$(this);

            $.post('http://localhost/twirrer/backend/ajax/retweet.php',{deretweet:post_id,user_id:user_id,comment:$comment},function(data){
                button.removeClass('retweeted').addClass('retweet');
                $result=JSON.parse(data);
                    
                    
                updateLikesValue($counter,$result.retweet);
                // $button.removeClass('retweet').addClass('retweeted');
                if($result.retweet <0){   
                    $button.removeClass('retweeted').addClass('retweet');
                    $('.retweet-header').hide();
                    $('.retweet-text-reply').hide();
                } else{
                     $button.removeClass('retweet').addClass('retweeted');
                }
            })
         })
       
 
   });