// $(function(){
//     $(document).on("click","#createChatButton",function(e){
//         var selectedItem=document.querySelectorAll(".selectedUser");
//         var profileId=new Array();

//         selectedItem.forEach(function(el){
//                 if(el){
//                     profileId.push(el.dataset.profile);
//                 }
//         });

//         if(profileId.length >0){
//           if(confirm("Are you sure,you want to create the chat?")){
//             let formData=new FormData();
//             formData.append("profileid",JSON.stringify(profileId));
//             $.ajax({
//                 url:"http://localhost/twirrer/backend/ajax/chat.php",
//                 type:"POST",
//                 data:formData,
//                 success:(data)=> {
//                     alert(data);
                   
//                 }
                
//             });
//           }
           
//         }
//     });
// })
var u_id = $('.u_p_id').data('uid');
var createChatBtn  = document.querySelector("#createChatButton");


createChatBtn.addEventListener("click", function(e){
		var selectedItem=document.querySelectorAll(".selectedUser");
		var profileIds=new Array();


		selectedItem.forEach(function(el){
			if(el){
			
				profileIds.push(el.dataset.profile);
			}
		});
        // console.log(profileIds.length);
		if(profileIds.length > 0){
			if(confirm("Are you sure,you want to create the chat?")){
				var formData  = new FormData();

                formData.append("profileid",JSON.stringify(profileIds));
                formData.append("userId",u_id);

				var httpRequest = new XMLHttpRequest();

				if(httpRequest){
					httpRequest.open('POST', 'http://localhost/twirrer/backend/ajax/chat.php', true);
					httpRequest.onreadystatechange = function(){
						if(this.readyState === 4 && this.status === 200){
							if(this.responseText.length != 0){
                                window.location.href = "http://localhost/twirrer/chat/"+this.responseText;
							}
							
						}
					}

					httpRequest.send(formData);
				}	
			}
		}
	});