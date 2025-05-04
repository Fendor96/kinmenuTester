document.getElementById('avis').addEventListener('submit', function(e){
    e.preventDefault();
    document.querySelector('form').classList.add("hide");
    document.querySelector('h1').classList.add("hide");
    document.querySelector('h2').classList.replace("hide", "show");

});