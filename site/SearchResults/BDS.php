<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/artist.css">
</head>
<body>
    <?php 
        include_once "../php/conexaoMySQL.php";
        $consulta = $oCon->query("SELECT BDSCODIGO, BDSNOME, PSSNOME FROM BANDAS INNER JOIN PAISES ON PSSCODIGO = BDSNACIONALIDADE WHERE BDSCODIGO = ".$_GET["searchCod"]);
        $resultado = $consulta->fetch_assoc();
    ?>
    <div class="conteudoContainer">
        <h1 class="tituloEstilizado"><?php echo $resultado["BDSNOME"]; ?></h1>
            <div class="carrousel">
                <button class="voltar"><</button>
                <img src="https://i.insider.com/5ed01e6d3f73702b1e3f590c?width=1100&format=jpeg&auto=webp" alt="">
                <button class="avancar">></button>
            </div>
        <h1 class="tituloEstilizado">Albuns / Singles</h1>
    </div>
    <div class="albunsContainer caixa">
        <?php 
            $albConsulta = $oCon->query("SELECT ALBCODIGO, ALBNOME FROM ALBUNS WHERE ALBBANDA = $resultado[BDSCODIGO]");
            while ($albResultado = $albConsulta->fetch_assoc()):
        ?>
        <div class="album">
            <img src="" alt=""><p><?php echo $albResultado["ALBNOME"] ?></p><a href="http://localhost/GitHub/Projeto-Acervo/site/cadastraAlbum.php?btnAlbum=<?php echo $albResultado["ALBCODIGO"]; ?>"><button>Saiba mais</button></a>
        </div>
        <?php endwhile; ?>
    </div>
    <div class="descricaoContainer caixa">
        <h1 class="tituloEstilizado">Integrantes</h1>
        <div class="album desc" style="flex-direction: column; align-items:center">
            <p>Nacionalidade da Banda: <?php echo $resultado["PSSNOME"]; ?></p>
        </div>   
        <?php 
            $intConsulta = $oCon->query("SELECT ARTCODIGO, ARTNOME, FNCNOME, ITGADESAO, ITGSEPARACAO FROM INTEGRANTES INNER JOIN ARTISTAS ON ARTCODIGO = ITGARTISTA INNER JOIN FUNCOES ON FNCCODIGO = ITGFUNCAO WHERE ITGBANDA = $resultado[BDSCODIGO]"); 
            while ($intResultado = $intConsulta->fetch_assoc()):
        ?>
        <div class="album desc" style="flex-direction: column; align-items:center">
            <p>
                Nome: <strong><?php echo $intResultado["ARTNOME"]; ?></strong><br/>
                Função: <strong><?php echo $intResultado["FNCNOME"]; ?></strong><br/>
                Adesão: <strong><?php echo $intResultado["ITGADESAO"]; ?></strong><br/>
                Separação: <strong><?php echo $intResultado["ITGSEPARACAO"]; ?></strong><br/>
            </p>
            <a href="./ART.php?searchCod=<?php echo $intResultado["ARTCODIGO"]; ?>"><button>Saiba mais</button></a>
        </div> 
        <?php endwhile; ?>
    </div>
</body>
</html>