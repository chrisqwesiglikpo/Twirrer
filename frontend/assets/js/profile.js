var u_id = $('.u_p_id').data('uid');
var cropper;
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

    var modal = document.getElementById("profileModal");

    // Get the button that opens the modal
    $(document).on("click","#profilePictureButton",function(){
        modal.style.display = "block";
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

    $(document).on("click",".profile-edit-back",function(e){
        e.preventDefault();
        let stepModal=document.querySelector(".upload-profilePic-modal-step");
        let previewContainer=document.querySelector(".display-modal-preview-container");
        stepModal.style.display="block";
        previewContainer.style.display="none";
    });
     
    $("#imageUploadButton").click(function(e){
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
                    success:(data)=> location.reload(true)
                    
                });

           });
    })
    

})

