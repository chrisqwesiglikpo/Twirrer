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
		//  profileIds.push(u_id);
        //  console.log(profileIds);
		if(profileIds.length > 0){
				var chatName = prompt("Enter your Group Chat Name?");
				if(chatName != null || chatName != ''){
				var formData  = new FormData();

                formData.append("profileid",JSON.stringify(profileIds));
                formData.append("userId",u_id);
                formData.append("chatName",chatName);

				var httpRequest = new XMLHttpRequest();

				if(httpRequest){
					httpRequest.open('POST', 'http://localhost/twirrer/backend/ajax/chat.php', true);
					httpRequest.onreadystatechange = function(){
						if(this.readyState === 4 && this.status === 200){
							if(this.responseText.length != 0){
								window.location.href = "http://localhost/twirrer/messages/"+this.responseText+"/participants/";
								// alert(this.responseText);
							}
							
						}
					}

				
					httpRequest.send(formData);
				}	
			}
		}
	});

