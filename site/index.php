<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/reset.css">
    <link rel="stylesheet" href="src/css/generics.css">
    <link rel="stylesheet" href="src/css/modeloVisualizar.css">
    <link rel="stylesheet" href="src/css/home.css">
    <title>Document</title>
</head>
<body class=visualizerContainer>
    <aside id="dialogoContainer">
        <div class=estiloBox>
            <h3 class=estiloBoxInset>Mensagem</h3>
            Este site funciona melhor em telas maiores.
            <br>
            <button onClick="VisibilityChanger('dialogoContainer','hidden')" class="estiloBox fullWidth">OK</button>
        </div>
    </aside>

    <nav class="estiloBoxInset">
        <img draggable=false oncontextmenu="return false;" class="estiloCircleInset hideOnPhone" src="https://www.temperosweb.com.br/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/m/i/mix-de-nuts1-1ad905eed0ea88fef215527677051390-1024-1024.jpg" alt="">
            <h2 class="estiloBox btnBox">Login</h2>
            <h2 onClick="PageRedirect('pages/outros/feed')" class="estiloBox btnBox">Home</h2>
            <h2 onClick="PageRedirect('pages/registro/painelCadastros')" class="estiloBox btnBox">Cadastros</h2>
        <h2 id="btnOcultaControles" class="estiloBox btnBox hideOnPhone">Ocultar controles</h2>
    </nav>

    <section>
        <div class="estiloBox searchBox"><input placeholder="Pesquise algo por aqui. . ." class=estiloBoxInset type="text"><button class=estiloBox>Pesquisar</button></div>

        <iframe id=main src="http://localhost/GitHub/Projeto-Acervo/site/pages/outros/feed.php" frameborder="0"></iframe>
        
        <aside id="cbxControles" class="estiloBox cardBox">
            <input type="range">
            <div>
                <button class=estiloCircleInset>a</button>
                <button class=estiloCircleInset>a</button>
                <button class=estiloCircleInset>a</button>
            </div>
            <label class=estiloCircleInset><marquee>Tocando n sei oq</marquee></label>
        </aside>
    </section>
    <script src="src/js/interactions.js"></script>
    <script>
        document.all.btnOcultaControles.onclick = (event) => {
            VisibilitySwitcher('cbxControles');
            with(document.all.btnOcultaControles){
                if (document.all.cbxControles.style.visibility == 'hidden'){
                    innerText = "Mostrar Controles";
                    style.backgroundColor = "#06c258";
                }
                else {
                    innerText = "Ocultar Controles";
                    style.backgroundColor = "#bd353b";
                }
            }
        };     
    </script>
</body>
</html>