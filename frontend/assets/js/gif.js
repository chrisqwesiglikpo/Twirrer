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

      xhr.open('GET','http://api.giphy.com/v1/gifs/trending?api_key=6a4UvbUVwxUs6JsqRksmtOcUdUV9tP7V&limit=10');
      
      xhr.onload=function(){
          var response=xhr.response;
          var parsedData=JSON.parse(response);
        //   console.log(parsedData);
          var responseData=parsedData.data;
          console.log(responseData);
          for(item in responseData){
              var gifBody=document.createElement('div');
              var imageHeader=document.createElement('h3');
              var imageHeaderContainer=document.createElement('div');
              gifBody.setAttribute('class','gif__body-wrapper');
              imageHeader.setAttribute('class','gif__image-title');
              imageHeaderContainer.setAttribute('class','gif__image-title-wrapper');
              var image=document.createElement('img');
              var imageURL=parsedData.data[item].images.original.url;
              var imageTitle=parsedData.data[item].title;
           
              image.setAttribute('src',imageURL);
              image.setAttribute('class','gif__img');
              imageHeader.innerHTML=imageTitle;
              gifBody.appendChild(image);
              imageHeaderContainer.appendChild(imageHeader);
              gifBody.appendChild(imageHeaderContainer);
              gifWrapper.appendChild(gifBody);
            
          }
        
       
      
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
    