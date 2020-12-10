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
   $(document).on("change","#editProfile",function(){
        // let file=document.querySelector("#editProfile").files[0];
        // let name=$("#editProfile").val().split("\\").pop();
        var name = document.querySelector("#editProfile").files[0];
        if (name != '') {
            
            let user_id=u_id;
            	//send ajax request
				var formData  = new FormData();
    			formData.append("userId",user_id);
                formData.append("file",name);
                var httpRequest = new XMLHttpRequest();

				if(httpRequest){
					httpRequest.open('POST', 'http://localhost/twirrer/backend/ajax/profilePhoto.php', true);
					httpRequest.onreadystatechange = function(){
						if(this.readyState === 4 && this.status === 200){
							if(this.responseText.length != 0){
                                document.querySelector(".profile-pic-me").src=this.responseText;
							}
							// location.reload(true);
						}
					}

					httpRequest.send(formData);
				}
        }
        // let name=$("#cover-upload").val().split("\\").pop();
        // let fileData=$("#cover-upload").prop("files")[0];
        // let fileSize=fileData['size'];
        // let fileType=fileData['type'].split('/').pop();
   })
   document.querySelector('#editProfile').addEventListener("change", function(event){
    var regex = /(\.jpg|\.jpeg|\.png|\.zip)$/i;
    if(!regex.exec(this.value)){
        alert("Only '.jpeg','.jpg','.png', formats are allowed");
        this.value = '';
        return false;
    }else{
        if(this.files && this.files[0]){
            var reader  = new FileReader();
            reader.onload = function(event){
                document.querySelector(".profile-pic-me").src = event.target.result;
            }
            reader.readAsDataURL(this.files[0]);
        }
    }
});


//  })
    // $(document).on("change","#cover-upload",function(){
    //     let name=$("#cover-upload").val().split("\\").pop();
    //     let fileData=$("#cover-upload").prop("files")[0];
    //     let fileSize=fileData['size'];
    //     let fileType=fileData['type'].split('/').pop();

    //     $userId=u_id;
    //     let imgName='frontend/assets/images/'+name;
    //     let formData=new FormData();

    //     formData.append('file',fileData);

    //     if(name != ""){
    //         $.post('http://localhost/twirrer/backend/ajax/profile.php',{imgName:imgName,userId:$userId},function(data){
    //             // alert(data);
    //         })
    //     }
    //     $.ajax({
    //         url:'http://localhost/twirrer/backend/ajax/profile.php',
    //         cache:false,
    //         contentType:false,
    //         processData:false,
    //         data:formData,
    //         type:'POST',
    //         success:function(data){
    //             $('.profile-pic-me').attr('src', " " + data + " ");
    //         }
    //     })
    // })

})

