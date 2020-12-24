// Get the modal
$(function(){
    var modal = document.querySelector('.gif-modal-container');
    
    // Get the button that opens the modal
    var btn = document.getElementById("gifBtn");

    
    // When the user clicks on the button, open the modal
    btn.onclick = function() {
      modal.style.display = "block";
      const gifWrapper=document.querySelector(".gif__body");
     
      var xhr=new XMLHttpRequest();

      xhr.open('GET','http://api.giphy.com/v1/gifs/trending?api_key=6a4UvbUVwxUs6JsqRksmtOcUdUV9tP7V&limit=16');
      
      xhr.onload=function(){
          var response=xhr.response;
          var parsedData=JSON.parse(response);
        //   console.log(parsedData);
          var responseData=parsedData.data;
          for(item in responseData){
              var gifBody=document.createElement('div');
              gifBody.setAttribute('class','gif__body-wrapper');
              var image=document.createElement('img');
              var imageURL=parsedData.data[item].images.original.url;
           
              image.setAttribute('src',imageURL);
              image.setAttribute('class','gif__img');
             
              gifBody.appendChild(image);
              gifWrapper.appendChild(gifBody);
            
          }
       
      
          // var gif=document.createElement('img');
          // gif.setAttribute('src',originalUrl);
          // document.body.appendChild(gif);
      }
      
      xhr.send();
    }
    
    // When the user clicks on <span> (x), close the modal
    $(document).on("click",".closeGif",function(){
        modal.style.display="none";
    });

    // When the user clicks anywhere outside of the modal, close it
    $(window).on("click",function(e){
        if (e.target == modal) {
            modal.style.display = "none";
          }
    });

    // $(document).on("click",".closeGif",function(){
    //     modal.style.display="none";
    // });

 });
    