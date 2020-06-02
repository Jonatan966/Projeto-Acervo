function FormLogin(visibility){
    document.getElementsByClassName('loginContainer')[0].style.visibility = visibility;
}

function PageRedirect(page){
    window.frames["main"].location = "http://localhost/GitHub/Projeto-Acervo/site/"+page+".php";
}