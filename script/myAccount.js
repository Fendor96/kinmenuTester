const modals = document.getElementById('modals');


document.getElementById("log-out").addEventListener('click', function(){
    window.location.href="../configuration/logout.php";
});


document.getElementById("share").addEventListener('click', function(){
    alert("Fait");
    modals.classList.replace('modal-off', 'modal-on');
    alert("terminé");
    
});

const closeBtn = document.getElementById('close-btn');

closeBtn ? closeBtn.addEventListener('click', function(){
    modals.classList.replace('modal-on', 'modal-off');
}) : console.log("Nothing");


