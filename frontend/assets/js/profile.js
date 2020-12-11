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
                    success:(data)=>{
                        alert(data);
                    //     var modal = document.getElementById("profileModal");
                    // //    console.log(data);
                        
                    //     // alert(data);
                    //     var image=document.querySelector(".profile-pic-me");
                    //     image.src=data;
                    //     // location.reload(true)
                    //     modal.style.display="none";
                    }
                    
                });
            //    url=URL.createObjectURL(blob);
            // //    console.log(url);
            //    let reader=new FileReader();
            //    reader.readAsDataURL(blob);
            //    reader.onload=function(e){
            //     let base64base=reader.result;
            //     //  console.log(name);
            //     let formData=new FormData();
            //     formData.append("croppedImage",base64base);
            //     formData.append("userId",u_id);
            //     $.ajax({
            //         url:"http://localhost/twirrer/backend/ajax/profilePhoto.php",
            //         type:"POST",
            //         cache:false,
            //         processData:false,
            //         data:formData,
            //         contentType:false,
            //         success:(data)=>{
            //             alert(data);
            //         //     var modal = document.getElementById("profileModal");
            //         // //    console.log(data);
                        
            //         //     // alert(data);
            //         //     var image=document.querySelector(".profile-pic-me");
            //         //     image.src=data;
            //         //     // location.reload(true)
            //         //     modal.style.display="none";
            //         }
                    
            //     });
            // }
           });
    })
   
//    $(document).on("change","#editProfile",function(){
//         // let file=document.querySelector("#editProfile").files[0];
//         // let name=$("#editProfile").val().split("\\").pop();
//         var name = document.querySelector("#editProfile").files[0];
//         if (name != '') {
            
//             let user_id=u_id;
//             	//send ajax request
// 				var formData  = new FormData();
//     			formData.append("userId",user_id);
//                 formData.append("file",name);
//                 var httpRequest = new XMLHttpRequest();

// 				if(httpRequest){
// 					httpRequest.open('POST', 'http://localhost/twirrer/backend/ajax/profilePhoto.php', true);
// 					httpRequest.onreadystatechange = function(){
// 						if(this.readyState === 4 && this.status === 200){
// 							if(this.responseText.length != 0){
//                                 // alert(this.responseText);
// 							}
// 							location.reload(true);
// 						}
// 					}

// 					httpRequest.send(formData);
// 				}
//         }
    
//    })
//    document.querySelector('#editProfile').addEventListener("change", function(event){
//     var regex = /(\.jpg|\.jpeg|\.png|\.zip)$/i;
//     if(!regex.exec(this.value)){
//         alert("Only '.jpeg','.jpg','.png', formats are allowed");
//         this.value = '';
//         return false;
//     }else{
//         if(this.files && this.files[0]){
//             var reader  = new FileReader();
//             reader.onload = function(event){
//                 document.querySelector(".profile-pic-me").src = event.target.result;
//             }
//             reader.readAsDataURL(this.files[0]);
//         }
//     }
// });
    

})

