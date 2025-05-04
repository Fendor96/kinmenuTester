const inputs = document.getElementById('montant');
const results = document.getElementById('results');
const resultfc = document.getElementById('results-fc');
let taux = 2800;
let enFranc;



inputs.addEventListener('change', function(){
    enFranc = parseInt(inputs.value) * taux;
    results.textContent = inputs.value + "$";
    resultfc.textContent = enFranc + "Fc";

});




inputs.addEventListener('click', function(){
    if(inputs.value == "" || parseInt(inputs.value) === 1){
        document.getElementById('modalAsk').classList.replace('hide', 'show');

    }
});


/* document.getElementById('close').addEventListener('click', function(){

}); */

document.getElementById('advice').addEventListener('submit', function(event){
    event.preventDefault();

    const advice = document.getElementById('advice');
    advice.classList.replace("show", "hidden");

    document.getElementById('done').classList.replace('hidden', 'show');
})

document.getElementById('carte').addEventListener('click', function(){
    document.getElementById('cartes').classList.replace('hide', 'show');
    document.getElementById('mobiles-moneys').classList.replace('show', 'hide');

});

document.getElementById('mobile-money').addEventListener('click', function(){
    document.getElementById('mobiles-moneys').classList.replace('hide', 'show');
    document.getElementById('cartes').classList.replace('show', 'hide');
})

