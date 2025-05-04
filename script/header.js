const hamburgerBtn = document.getElementById('hamburgerBtn');
const menu = document.getElementById('menu-bar');

hamburgerBtn.addEventListener("click", ()=>{
    if(menu.classList.contains('desactivate')){
        menu.classList.replace('desactivate', 'activate');
        hamburgerBtn.textContent = 'X';
    }else{
        menu.classList.replace('activate', 'desactivate');
        hamburgerBtn.textContent = '☰';
    }
});
