$(function(){
const inputBox=document.getElementById("main-search");
const suggestion=document.getElementById("suggestion");
const searchResult=document.querySelector(".search-title");
const searchHeader=document.querySelector(".search-header");

inputBox.addEventListener("mouseenter",function(e){
    searchResult.style.display="block";
    const inputBoxContainer=(e.target);
    const text=inputBoxContainer.value.trim();
    if(text == ""){
        searchResult.style.display="block";
    }
});

inputBox.addEventListener("keyup",function(e){
    const inputBoxContainer=(e.target);
    const text=inputBoxContainer.value.trim();
   
    if(text != ""){
        searchResult.style.display="none";
        $.post('http://localhost/twirrer/backend/ajax/search.php',{search:text},function(data){
          $('.search-result').html(data);
        });
    }else{
        searchResult.style.display="block";
    }
    
})

inputBox.addEventListener("mouseleave",function(e){
    searchResult.style.display="none";
})

})



