var u_id = $('.u_p_id').data('uid');
var cropper;
$(function(){

    $(document).ready(function(){
        loadPosts();
    })
    
    function loadPosts(){
        // var p_id = $('.u_p_id').data('pid');
        var u_id = $('.u_p_id').data('uid');
        var p_id = $('.u_p_id').data('pid');
        var offset=10;
                // $('#loader').show();
                $.post('http://localhost/twirrer/backend/ajax/fetchPosts.php',
                    {fetchPost:offset,userid:u_id,profileId:p_id},function(data){
                     $('.profilePostsContainer').html(data);
                    //  $('#loader').hide();
            });
    }

    var modal = document.getElementById("profileModal");

    // Get the button that opens the modal
    $(document).on("click","#profilePictureButton",function(){
       let coverModal=document.querySelector(".upload-coverprofilePic-modal-step");
       let profileModal=document.querySelector(".upload-profilePic-modal-step");
        modal.style.display = "block"; 
        profileModal.style.display="block";
        coverModal.style.display="none";

    });
    $(document).on("click",".close",function(){
            modal.style.display="none";
        });
    $(window).on("click",function(e){
        if (e.target == modal) {
            modal.style.display = "none";
            }
    });

    $("#filePhoto").change(function(){
        // let input=$(e.target);
        if(this.files && this.files[0]){
        let stepModal=document.querySelector(".upload-profilePic-modal-step");
        let previewContainer=document.querySelector(".display-modal-preview-container");
        stepModal.style.display="none";
        $(".profile-edit-back").removeClass("cover-go-back").addClass("profile-go-back");
        previewContainer.style.display="block";
            let reader=new FileReader();
            reader.onload=function(e){

                var image=document.getElementById("imagePreview");
                image.src=e.target.result;
                // $("#imagePreview").attr("src",e.target.result);

                if(cropper !==  undefined){
                    cropper.destroy();
                }

                cropper=new Cropper(image,{
                    aspectRatio:1/1,
                    background:false
                });
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $("#fileCoverPhoto").change(function(){
        
        // let input=$(e.target);
        if(this.files && this.files[0]){
        let coverModal=document.querySelector(".upload-coverprofilePic-modal-step");
        let previewContainer=document.querySelector(".display-modal-preview-container");
         coverModal.style.display="none";
         $(".profile-edit-back").removeClass("profile-go-back").addClass("cover-go-back");
          previewContainer.style.display="block";
           let reader=new FileReader();
            reader.onload=function(e){

               var image=document.getElementById("imagePreview");
              image.src=e.target.result;
             // $("#imagePreview").attr("src",e.target.result);

              if(cropper !==  undefined){
                   cropper.destroy();
                }

                cropper=new Cropper(image,{
                    aspectRatio:16/9,
                    background:false
                 });
             }
           reader.readAsDataURL(this.files[0]);
         }
    });
    $(document).on("click","#skip-profile-pic",function(e){
        e.preventDefault();
        let profileModal=document.querySelector(".upload-profilePic-modal-step");
        let coverModal=document.querySelector(".upload-coverprofilePic-modal-step");
        profileModal.style.display="none";
        coverModal.style.display="block";
    });
    $(document).on("click",".profile-go-back",function(e){
        e.preventDefault();
        let stepModal=document.querySelector(".upload-profilePic-modal-step");
        let previewContainer=document.querySelector(".display-modal-preview-container");
        let coverModal=document.querySelector(".upload-coverprofilePic-modal-step");
        stepModal.style.display="block";
        previewContainer.style.display="none";
        coverModal.style.display="none";
    });

    $(document).on("click",".cover-go-back",function(e){
        e.preventDefault();
        let stepModal=document.querySelector(".upload-profilePic-modal-step");
        let previewContainer=document.querySelector(".display-modal-preview-container");
        let coverModal=document.querySelector(".upload-coverprofilePic-modal-step");
        coverModal.style.display="block";
        stepModal.style.display="none";
        previewContainer.style.display="none";
        let isCover=$(".profile-edit-back").hasClass("cover-go-back");
        
       if(isCover){
        coverModal.style.display="block";
        stepModal.style.display="none";
        previewContainer.style.display="none";
        $(".profile-edit-back").removeClass("cover-go-back").addClass("profile-go-back");
       }else{
        coverModal.style.display="none";
        stepModal.style.display="block";
        previewContainer.style.display="none";
        $(".profile-edit-back").removeClass("profile-go-back").addClass("cover-go-back");
       }
    });
     
    $("#imageUploadButton").click(function(e){
        let isProfile=$(".profile-edit-back").hasClass("profile-go-back");
        if(isProfile){
            // alert("Hi,it's the profile preview");
            var name = document.querySelector("#filePhoto").files[0];
            let canvas=cropper.getCroppedCanvas();
            if(canvas==null){
               alert("Could not upload image.Make sure it is an image file.");
               return;
            }
           canvas.toBlob((blob)=>{
            let formData=new FormData();
                formData.append("croppedImage",blob);
                formData.append("userId",u_id);
                $.ajax({
                    url:"http://localhost/twirrer/backend/ajax/profilePhoto.php",
                    type:"POST",
                    cache:false,
                    processData:false,
                    data:formData,
                    contentType:false,
                    success:(data)=> {
                        location.reload(true)
                        // alert(data);
                    }
                    
                });

           });
        }else{
            // alert("Hi,it's not the profile preview");
            var name = document.querySelector("#fileCoverPhoto").files[0];
            let canvas=cropper.getCroppedCanvas();
           if(canvas==null){
               alert("Could not upload image.Make sure it is an image file.");
               return;
           }
           canvas.toBlob((blob)=>{
            let formData=new FormData();
                formData.append("croppedCoverImage",blob);
                formData.append("userId",u_id);
                $.ajax({
                    url:"http://localhost/twirrer/backend/ajax/profilePhoto.php",
                    type:"POST",
                    cache:false,
                    processData:false,
                    data:formData,
                    contentType:false,
                    success:(data)=> {
                        location.reload(true);
                       
                    }
                    
                });

           });
        }
        
    })
    

})

