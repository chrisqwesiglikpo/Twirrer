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

  $(document).on('click','.trends-content', function (event) {
    let element=$(event.target);
    let trendID=$(this).data('trend');

    if(trendID !== undefined){
     $.post('http://localhost/twirrer/backend/ajax/getTrendName.php',{trendID:trendID},function(data){
        window.location.href = "http://localhost/twirrer/hashtag/"+data;
        
     });
 
     }
    
 });
  $("#submitPostButton").click(e=>{
    e.preventDefault();
    $.post('http://localhost/twirrer/backend/ajax/fetchHashtag.php',{fetchHashtag:true},function(data){
       $('.trends-body').html(data);
        $("#postTextarea").val("");
        $('.hash-box li').hide();
        button.prop("disabled",true);
        
    });
  });
});