$(function(){
  var regex=/[#|@](\w+)$/ig;
   $("#postTextarea").keyup(e=>{
    let textbox=$(e.target);
    let content=textbox.val().trim();
      var text=content.match(regex);
      if(text != null){
        var dataString='hashtag='+text;
        $.ajax({
          type:"POST",
          data:dataString,
          url:"http://localhost/twirrer/backend/ajax/getHashtag.php",
          cache:false,
          success:function(data){
            $('.hash-box ul').html(data);
            $('.hash-box li').click(function(){
                 var value=$.trim($(this).find('.getValue').text());
                 var oldContent=$('#postTextarea').val();
                 var newContent=oldContent.replace(regex,"");

                 $('#postTextarea').val(newContent+value+' ');
                 $('.hash-box li').hide();
                 $('#postTextarea').focus();
            });
          }
        })
      }
  })
});