<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://kit.fontawesome.com/615d187fa1.js" crossorigin="anonymous"></script>
    <script src="js/animations.js"></script>
    <script src="js/interactions.js"></script>
    <title>Projeto Acervo - Página Principal</title>
</head>
<body class="container">
    <div class="loginContainer">
        <?php require "login.php"; ?>
    </div>
    <nav>
        <img src="https://www.mambo.com.br/ccstore/v1/images/?source=/file/v2168637593948128623/products/131543.jpg&height=400&width=400" alt="">
        <div class="navBotoes">
            <a onclick="FormLogin('visible')" class="navBotao">Fazer Login</a>
            <a onclick="PageRedirect('feed.php')" class="navBotao">Home</a>
            <a onclick="PageRedirect('favs.php')" class="navBotao">Meus Favoritos</a>
            <a onclick="PageRedirect('painelCadastros.php')" class="navBotao">Cadastros</a>
        </div>
        <a class="navBotao navMostrador">Tocando algo</a>
    </nav>
    <header>
        <form onsubmit="PageRedirect('search.php?txbPesquisa='+document.all.txbPesquisa.value+'&searchFiltro='+document.all.searchFiltro.value); return false;" class="mainPesquisa bg-red">
            <input placeholder="Pesquise algo aqui. . ." name="txbPesquisa" type="text">
            <label>Filtrar por: 
                <select name="searchFiltro">
                    <option value="ART">Artistas</option>
                    <option value="BDS">Bandas</option>
                    <option value="ALB">Albuns</option>
                    <option value="MSC">Musicas</option>
                </select>
            </label>
            <button>Pesquisar</button>
        </form>
            
        <iframe name="main" src="http://localhost/GitHub/Projeto-Acervo/site/feed.php" class="mainConteudo" frameborder="0"></iframe>

        <div style="align-items: stretch;" id="mainMusgas" class="mainMusgas bg-red">
            <div id="rangeContainer" class="rangeContainer bg-red">
                <input type="range">
            </div>
            <div id="mainContainer" class="mainControles">
                <button><i class="fas fa-random" aria-hidden="true"></i></button>
                <button><i class="fas fa-step-backward" aria-hidden="true"></i></button>
                <button><i class="fas fa-play" aria-hidden="true"></i></button>
                <button><i class="fas fa-step-forward" aria-hidden="true"></i></button>
                <button><i class="fas fa-random" aria-hidden="true"></i></button>                
            </div>
        </div>
        <button class="minimizeButton" onclick="ToggleVisibleControllers(this)"><i class="fas fa-arrow-down"></i></button>
    </header>
</body>
</html>