   $(function(){
       $(document).on("click",".retweet",function(){
           let post_id=$(this).data('post');
           let user_id=$(this).data('user');
           let postedBy=$(this).data('postedby');
           $counter=$(this).find('.retweetsCount');
           $count=$counter.text();
           $button=$(this);
     $.post('http://localhost/twirrer/backend/ajax/retweet.php',{showPopup:post_id,postedBy:postedBy,user_id:user_id},function(data){
              
           })
      
       });
   })