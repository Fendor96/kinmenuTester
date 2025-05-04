const checkSession =  () => {
    try {
        const response =  fetch('http://localhost/Kin-menu/configuration/checkSession.php');
        const data = response.json();

        if (data.loggedIn) {
            console.log(`User is logged in as ${data.username}`);
            return true;
        } else {
        console.log('User is not logged in');
            return false;
        }
    } catch (error) {
        console.error('Error checking session:', error);
    }
};


document.addEventListener('click', function(){
    if(document.getElementById('welcome').classList.contains("welcome")){
        document.getElementById('welcome').classList.replace('welcome', 'hide');
    }
});
    
const getResponse = checkSession();



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
const backgroundsUrl = [
  '/Kin-menu/Styles/assets/Friends.jpeg',
  '/Kin-menu/Styles/assets/2friends.jpeg',
  '/Kin-menu/Styles/assets/pasta.jpg',
  '/Kin-menu/Styles/assets/plats1.jpg',
  '/Kin-menu/Styles/assets/plats2.jpg',
  '/Kin-menu/Styles/assets/salad1.jpg',
  '/Kin-menu/Styles/assets/salad2.jpg'
];

const backgroundsUrlB = ['../Styles/assets/Friends.jpeg', '../Styles/assets/2friends.jpeg', '../Styles/assets/pasta.jpg', '../Styles/assets/plats1.jpg', '../Styles/assets/plats2.jpg', '../Styles/assets/salad1.jpg', '../Styles/assets/salad2.jpg'];
const background = document.getElementById('intro');

setInterval(()=>{
    const indice = Math.floor(Math.random() * backgroundsUrl.length);
    background.style.backgroundImage = `url(${backgroundsUrl[indice]})`;
}, 5000);

document.addEventListener('DOMContentLoaded', ()=>{
    const elements  = document.querySelectorAll('.intro h1, .intro .left p, .intro .left a, .discover, .discover .title, .discover p, .discover a, .message input, .message button, .partenaire .title, .partenaire .items, footer .first i ');

    const observerOptions = {
        root:null,
        rootMargin: '0px',
        threshold:0.1
    }

    const observerCallBack = (entries, observer)=>{
        entries.forEach(entry => {
            if(entry.isIntersecting){
                entry.target.style.animation = getAnimation(entry.target);
                observer.unobserve(entry.target); //evite d'observer à nouveau l'element après animations
            }
        });
    };

    const observer = new IntersectionObserver(observerCallBack, observerOptions);

    elements.forEach(elements=>{
        observer.observe(elements);
    });

    const getAnimation = (elements)=>{
        if(elements.matches('.intro h1')) return 'showTxt 0.5s 1s linear 1 forwards';
        if(elements.matches('.intro .left p')) return 'showTxtB 1s 1s linear 1 forwards';
        if(elements.matches('.intro .left a')) return 'showTxtB 1.5s 1s linear 1 forwards';
        if(elements.matches('.discover'))return 'showDiscover 1s 1s linear 1 forwards';
        if(elements.matches('.discover .title')) return 'showTxtB 1.5s 1s linear 1 forwards';
        if(elements.matches('.discover a')) return 'showTxtB 1.7s 1s linear 1 forwards';
        if(elements.matches('.discover p')) return 'showTxtB 1.9s 1s linear 1 forwards';
        if(elements.matches('.message input')) return 'showMessage 0.5s 1s linear 1 forwards';
        if(elements.matches('.message button')) return 'showMessage 1s 1s linear 1 forwards';
        if(elements.matches('.partenaire .title')) return 'showPartenaire 1.5s 1s linear 1 forwards';
        if(elements.matches('.partenaire .items')) return 'showItems 1s 1s linear 1 forwards';
        if(elements.matches('footer .first i')) return 'showIcons 1s 1s linear 1 forwards';

    }

})

const verification = document.getElementById('welcome');
console.log(verification);

if(getResponse){
    console.log(getResponse);
    document.getElementById('welcome').classList.replace('welcome', 'hide');
}else{
    console.log(getResponse);
    document.getElementById('welcome').classList.replace('hide', 'welcome');
}

console.log(verification);

document.getElementById('extreme-close').addEventListener('click', function(){
    document.getElementById('welcome').classList.add("hide");
})
