
window.addEventListener('offline', function(){
    let banner = document.createElement('div');

    banner.innerHTML = "Vous êtes hors ligne";

    banner.style = "position:fixed; top:0; width:100%; background:red; color:white; padding:10px; text-align:center;";
    document.body.prepend(banner);
});

