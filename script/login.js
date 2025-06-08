document.getElementById('login-form').addEventListener('submit', async function(e){
    e.preventDefault();

    const userId = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const messageError = document.getElementById('message');
    const loader = document.getElementById('loader');   

    if (!userId || !password){
        
        if(!userId){
            document.getElementById('email').style.borderColor = "red";
        }
        if(!password){
            document.getElementById('password').style.borderColor ="red";
        }

        messageError.innerText = "Tous les champs doivent être remplis";        
        return;

    }

    //loader
    loader.style.display = 'flex';
    loader.style.opacity = '1';


    try{

        const response = await fetch("http://localhost/kinmenuTest/configuration/login.php", {
            method:'POST',
            headers:{'Content-Type': 'application/x-www-form-urlencoded'},
            body:new URLSearchParams({
                userId: userId,
                password: password
            }),
        });

        if(!response.ok){
            throw new Error(`Erreur HTTP! Statut: ${response.status}`);
        }

        const data = await response.json();

        //cacher le loader
        loader.style.opacity='0';
        setTimeout(()=> loader.style.display='none', 500);

        if(data.success){
            //console.log(data);
            window.location.href = data.redirect || "../pagesLogged/home.php";
        }else{
            messageError.textContent=`${data.message}` || "Echec de la connexion, veuillez réessayer ultérieurement";
            console.log(data);

            if(data.message.includes('utilisateur')){
                document.getElementById('email').style.borderColor = "red";           
            }else if (data.message.includes("Mot de passe")){
                document.getElementById('password').style.borderColor="red";
            }
        }

    }catch(err){
        if(err.name !== 'AbortError'){
            console.error("Erreur:", err);
            messageError.textContent = "Erreur lors de la connexion, veuillez réassayer";
        }
    }finally{
        window.currentController = null;
    }
});