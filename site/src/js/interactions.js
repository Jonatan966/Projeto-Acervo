function VisibilityChanger(item, visibility){
    document.getElementById(item).style.visibility = visibility;
}

function VisibilitySwitcher(item){
    with(document.getElementById(item)){
        VisibilityChanger(item, (style.visibility == 'hidden' ? '' : 'hidden'));
    }
}

function PageRedirect(page){
    document.getElementById("main").src = "http://localhost/GitHub/Projeto-Acervo/site/"+page+".php";
}

function NormalRedirect(page){
    window.location.href = "http://localhost/GitHub/Projeto-Acervo/site/"+page+".php";
}

function fnExibirArquivo(oImg, oArquivo)
{
	if(oArquivo.files && oArquivo.files[0])
	{
		let oImagem = new FileReader();
		
		oImagem.onload = function(oResult)
		{
			oImg.src = oResult.target.result;
		}
		oImagem.readAsDataURL(oArquivo.files[0]);
	}
}

function fnAddElemento(obj, pai){
	pai.insertAdjacentHTML("beforeEnd","<div class='estiloBox card'>"+obj.innerHTML+"</div>")
}
function fnDelElemento(obj){
	if (obj.parentElement.childElementCount > 2)
		obj.remove();
}