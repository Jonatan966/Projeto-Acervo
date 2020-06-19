<!DOCTYPE html>
<?php 
    require 'php/conexaoMySQL.php';
    $nPag = 0;
    $cPesquisa = "";
    if(isset($_GET['txbPagina'])){
        $nPag = (int)$_GET['txbPagina'];
    }

    if(isset($_GET['btnRetornar'])){
        $nPag--;
    }

    if(isset($_GET['btnAvancar'])){
        $nPag++;
    }
    $nPag = max(0, $nPag);

    if (isset($_GET["txbPesquisa"])){
        $cPesquisa = str_replace("'", "''", $_GET["txbPesquisa"]);
    }
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/cards.css">
</head>
<body class="cardsContainer cardsSearchContainer">
    <h1 class="tituloEstilizado">Resultados - Pagina <?php echo $nPag+1;?></h1>
    <section class="flexCardsContainer">
        <?php 
            $cFiltro = $_GET["searchFiltro"];
            $html = "<div class='cardBox'><img src='img/{0}.jpg'><h2>{1}</h2>"
                   ."<a href='http://localhost/GitHub/Projeto-Acervo/site/SearchResults/$cFiltro.php?searchCod={0}'><button>Saiba mais</button></a></div>";
            $comandoSQL = "";
            switch ($cFiltro){
                case "ALB":
                    $comandoSQL = "SELECT ALBCODIGO, ALBNOME FROM ALBUNS ";
                    break;
                case "MSC":
                    $comandoSQL = "SELECT MSCCODIGO, MSCNOME FROM MUSICAS ";
                    break;
                case "ART":
                    $comandoSQL = "SELECT ARTCODIGO, ARTNOME FROM ARTISTAS ";
                    break;
                case "BDS":
                    $comandoSQL = "SELECT BDSCODIGO, BDSNOME FROM BANDAS ";
            }
            $comandoSQL .= "WHERE {$cFiltro}NOME LIKE '%$cPesquisa%' "
                         . "LIMIT ".($nPag*20).", 20";
            CriarCoisas($oCon, $comandoSQL, $cFiltro, $html);
        ?>
    </section>
    <form class="searchContainer">
        <input name="txbPagina" type="hidden" value="<?php echo $nPag; ?>">
        <input name="txbPesquisa" type="hidden" value="<?php echo $cPesquisa;?>">
        <input name="searchFiltro" type="hidden" value="<?php echo $cFiltro;?>">
        <button name="btnRetornar">&lt;</button>
        <button>Cadastrar Intérprete</button>
        <button name="btnAvancar">&gt;</button>
    </form>
</body>
</html>
