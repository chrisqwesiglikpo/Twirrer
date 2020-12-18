function likePost(button,postId,likedBy,postedBy){
    $.post('http://localhost/twirrer/backend/ajax/likePost.php',{postId:postId,userId:likedBy,postedBy:postedBy},function(data){
        let likeButton=$(button);
        likeButton.addClass("like-active");
        
        let result=JSON.parse(data);
        updateLikesValue(likeButton.find(".likesCounter"),result.likes);

        if(result.likes <0){
            likeButton.removeClass("like-active");
            likeButton.find('.fa-heart').addClass('fa-heart-o');
            likeButton.find('.fa-heart-o').removeClass('fa-heart');
            
        }else{
            likeButton.find('.fa-heart-o').addClass('fa-heart');
            likeButton.find('.fa-heart').removeClass('fa-heart-o');
        }
    });
}

function updateLikesValue(element,num){
   let likesCountVal=element.text() || "0";
    element.text(parseInt(likesCountVal) + parseInt(num));
}