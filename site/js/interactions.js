function FormLogin(visibility){
    document.getElementsByClassName('loginContainer')[0].style.visibility = visibility;
}

function PageRedirect(page){
    window.frames["main"].location = "http://localhost/GitHub/Projeto-Acervo/site/"+page;
}

function fnExibeArquivo(oArquivo)
{
    if (oArquivo.files && oArquivo.files[0])
    {
        let oImagem = new FileReader();
        oImagem.onload = function(oDados)
        {
                document.all.imgPrev.src = oDados.target.result;
        }
        oImagem.readAsDataURL(oArquivo.files[0]);
    }
}