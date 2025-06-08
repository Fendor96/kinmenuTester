document.getElementById('signup-form').addEventListener('submit', async function(e){
    e.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const username = document.getElementById('username').value;
    const messageDiv = document.getElementById('messageDiv');
    const loader = document.getElementById('loader');


    if(!email || !password){
        messageDiv.textContent = "Veuillez remplir les champs importants";

        if(!email){
            document.getElementById('email').style.borderColor = "red";
            messageDiv.textContent = "Veuillez remplir le champ de l'adresse mail";
        }
        
        if(!password){
            document.getElementById('password').style.borderColor = "red";
            messageDiv.textContent = "Veuilez remplir le champs du mot de passe";
        }

        return;
    }


    loader.style.display='flex';
    loader.style.opacity ="1";
    loader.style.visibility="visible";

    try{

       const response = await fetch('http://localhost/kinmenuTest/configuration/signup.php', {
        
            method: 'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:new URLSearchParams({
                email:email,
                password:password,
                username: username
            })
       });

        if(!response.ok){
            throw new Error(`Erreur Http! Statut:${response.status}`);
        }

        const data = await response.json();

        loader.style.display = 'none';
        loader.style.opacity = "0";

        setTimeout(()=> loader.style.display='none', 500);

        if(data.success){
            window.location.href = data.redirect || "../pagesLogged/home.php";
        }else{
            messageDiv.textContent = `${data.message}` || "Echec de la connexion veuillez réessayer";
            if(data.message.includes('email')){
                document.getElementById('email').style.borderColor = 'red';
            }
        }


    }catch(err){
        if(err.name !== "AbortError"){
            console.error("Erreur", err);
            messageDiv.textContent = "Erreur lors de la connexion, veuillez réssayer";
            
        }

    }finally{
        window.currentController = null;
    }

});