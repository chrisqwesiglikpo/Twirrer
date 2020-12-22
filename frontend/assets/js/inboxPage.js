$(document).ready(function(){
    
    $(document).on('click','.resultsDetailsContainer', function () {
       let chatid=$(this).data('chatid');
       
            if(chatid !==undefined){
                window.location.href = "http://localhost/twirrer/chat/messages/"+chatid;
            }
      });

        
    $(document).on('click','.chats__parts', function () {

        window.location.href = "http://localhost/twirrer/messages";
        
      });
});