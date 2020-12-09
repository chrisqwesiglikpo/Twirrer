var u_id = $('.u_p_id').data('uid');
$(function(){

    $(document).ready(function(){
        loadPosts();
    })
    
    function loadPosts(){
        // var p_id = $('.u_p_id').data('pid');
        var u_id = $('.u_p_id').data('uid');
        var offset=10;
                // $('#loader').show();
                $.post('http://localhost/twirrer/backend/ajax/fetchPosts.php',
                    {fetchPosts:offset,userid:u_id},function(data){
                     $('.postsContainer').html(data);
                    //  $('#loader').hide();
            });
    }

    $(document).on("change","#cover-upload",function(){
        let name=$("#cover-upload").val().split("\\").pop();
        let fileData=$("#cover-upload").prop("files")[0];
        let fileSize=fileData['size'];
        let fileType=fileData['type'].split('/').pop();

        let userId=u_id;
        let imgName='backend/user/'+userId+'/profilePic/'+name+'';
        let formData=new FormData();

        formData.append('file',fileData);

        if(name != ""){
            $.post('http://localhost/twirrer/backend/ajax/profile.php',{imgName:imgName,userId:userId},function(data){
                
            })
        }
    })

})

