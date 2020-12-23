    $('#statusEmoji').emojioneArea({
        pickPosition: "right",
        spellcheck: true
    });
var u_id = $('.u_p_id').data('uid');
var c_id = $('.u_p_id').data('cid');
$(function(){
     $(document).on("keyup",".emojionearea-editor",function(e){
        var statusText = $('.emojionearea-editor').html();
        var ThisEle=$(this);
        //console.log(ThisEle);
        var msg=statusText.slice(0,-15);
        let submitButton= $("#sendMsgBtn") ;
       if(submitButton.length ==0) return alert("No submit button not found");
            
        if(statusText ==""){
            submitButton.prop("disabled",false);
            return;
        }

        submitButton.prop("disabled",false);
        //   }else{
        //   if(e.keyCode==13 || e.which==13){
        //     console.log(msg);
        //    // console.log(statusText);
        //     // var selectedItem=document.querySelectorAll(".c_id");
            
        //     //  var profileIds=new Array();


        //     // selectedItem.forEach(function(el){
        //     //     if(el){
                
        //     //         profileIds.push(el.dataset.profileid);
        //     //     }
        //     // });

        //     // if(profileIds.length > 0){
               
        //     //     var formData  = new FormData();

        //     //     formData.append("profileid",JSON.stringify(profileIds));
        //     //     formData.append("userId",u_id);
        //     //     formData.append("chatId",c_id);
        //     //    // var httpRequest = new XMLHttpRequest();

		// 	// 	// if(httpRequest){
		// 	// 	// 	httpRequest.open('POST', 'http://localhost/twirrer/backend/ajax/chat.php', true);
		// 	// 	// 	httpRequest.onreadystatechange = function(){
		// 	// 	// 		if(this.readyState === 4 && this.status === 200){
		// 	// 	// 			if(this.responseText.length != 0){
        //     //     //                 submitButton.prop("disabled",false);
        //     //                     //$(ThisEle).text('');
		// 	// 	// 				//location.reload(true);
								
		// 	// 	// 			}
							
		// 	// 	// 		}
		// 	// 	// 	}

				
		// 	// 	// 	httpRequest.send(formData);
		// 	// 	// }
        //     // }
           
        //   }
          

       // }
       
    });
    $(document).on("click","#sendMsgBtn",function(e){
        e.preventDefault();
        
        let button=$("#sendMsgBtn");
        var statusText = $('.emojionearea-editor').html();
        var ThisEle=$('.emojionearea-editor');
        
        // if(statusText !=""){
            //alert(statusText);
           // let msg=statusText.slice(0,-15);
            //alert(msg);
            var selectedItem=document.querySelectorAll(".c_id");
            //console.log(selectedItem);
             var profileIds=new Array();


            selectedItem.forEach(function(el){
                if(el){
                
                    profileIds.push(el.dataset.profileid);
                }
            });

            if(profileIds.length > 0){
                // button.prop("disabled",false);
                //alert(msg);
                var formData  = new FormData();

                formData.append("profileid",JSON.stringify(profileIds));
                formData.append("userId",u_id);
                formData.append("chatId",c_id);
                formData.append("msg",statusText);
               var httpRequest = new XMLHttpRequest();

				if(httpRequest){
					httpRequest.open('POST', 'http://localhost/twirrer/backend/ajax/message.php', true);
					httpRequest.onreadystatechange = function(){
						if(this.readyState === 4 && this.status === 200){
							if(this.responseText.length != 0){
                                $('.chatmsg__container').html(this.responseText);
                                //location.reload(true);
                                //alert(this.responseText);
                               $(ThisEle).text('');
                               // button.prop("disabled",false);
								
							}
							
						}
					}

				
					httpRequest.send(formData);
				}
            }
           
            // let formData=new FormData();
            // formData.append("croppedImage",blob);
            // formData.append("userId",u_id);
            // $.ajax({
            //     url:"http://localhost/twirrer/backend/ajax/profilePhoto.php",
            //     type:"POST",
            //     cache:false,
            //     processData:false,
            //     data:formData,
            //     contentType:false,
            //     success:(data)=> {
            //         location.reload(true)
            //         // alert(data);
            //     }
                
            // });
        // }
        
    })
   
})