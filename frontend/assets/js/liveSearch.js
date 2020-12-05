const inputBox=document.getElementById("main-search");
const suggestion=document.getElementById("suggestion");
const searchResult=document.querySelector(".search-title");
const searchHeader=document.querySelector(".search-header");

inputBox.addEventListener("focus",function(e){
    searchResult.style.display="block";
    const inputBoxContainer=(e.target);
    const text=inputBoxContainer.value.trim();
    if(text != ""){
        suggestion.style.display="block";
        searchResult.style.display="none";
    }else{
        suggestion.style.display="none";
        searchResult.style.display="block";
    }
});

inputBox.addEventListener("keyup",function(e){
    const inputBoxContainer=(e.target);
    const text=inputBoxContainer.value.trim();
   
    if(text != ""){
        searchResult.style.display="none";
        suggestion.style.display="block";
    }else{
        suggestion.style.display="none";
        searchResult.style.display="block";
    }
    
})

// $(document).on("click",function(e){
//     console.log($('.search-header').parentElement);
//     // console.log(searchHeader);
    
// })
// window.onclick = function(event) {
//     // if (event.target == searchResult) {
//     //   searchResult.style.display = "none";
//     // }
//     console.log(event);
//   }

