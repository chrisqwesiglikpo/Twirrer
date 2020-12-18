var u_id = $('.u_p_id').data('uid');
var p_id = $('.u_p_id').data('pid');
$(function() {

    var modal = document.querySelector(".d-wrapper-container");
    var deleteModal=document.querySelector(".del-post-wrapper-container");
    
    
     // When the user clicks on the button, open the modal
     $(document).on("click","#deletePostModal",function(){
        $post_id=$(this).data('post');
        // alert($post_id);
        let user_id=u_id;
        
        $.post("http://localhost/twirrer/backend/ajax/deletePost.php",{p_id:$post_id,postedBy:user_id},function(data){
            modal.style.display="block";
            $(".d-wrapper-container").html(data);
        })
     
        
     });
     $(document).on("click","#del-content",function(){
        let user_id=u_id;
        let post_id=$post_id;
        $.post("http://localhost/twirrer/backend/ajax/deletePost.php",{postId:post_id,postedBy:user_id},function(data){
            deleteModal.style.display="block";
            $(".del-post-wrapper-container").html(data);
        })
        
     })

     $(document).on("click","#cancel",function(){
        deleteModal.style.display="none";
     })

     $(document).on("click","#delete-post-btn",function(){
        let user_id=u_id;
        let post_id=$post_id;
        $.post("http://localhost/twirrer/backend/ajax/deletePost.php",{post_id:post_id,postedBy:user_id},function(data){
           location.reload(true);
        })
     });
     
     
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

    $(document).on('click','.post-body', function (event) {
       let element=$(event.target);
       let postId=$(this).data('post');
       let postedBy=$(this).data('postedby');
       if(postId !== undefined){
        $.post('http://localhost/twirrer/backend/ajax/getUsername.php',{postedBy:postedBy},function(data){
            window.location.href = "http://localhost/twirrer/"+data+"/status/"+postId;
        });
    
       }
       
    });

    $(document).on('click','.liked-container', function (event) {
        let element=$(event.target);
        let postId=$(this).data('post');
        let postedBy=$(this).data('profileid');
       
     
        if(postId !== undefined){
         $.post('http://localhost/twirrer/backend/ajax/getUsername.php',{postedBy:postedBy},function(data){
             window.location.href = "http://localhost/twirrer/"+data+"/status/"+postId;
         });
     
        }
        
     });
});