$(document).ready(function(){
    
    $(document).on('click','.resultsDetailsContainer', function () {
       let chatid=$(this).data('chatid');
       
            if(chatid !==undefined){
                window.location.href = "http://localhost/twirrer/messages/"+chatid;
            }
      });
});