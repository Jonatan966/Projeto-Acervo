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
        $consulta = $oCon->query("SELECT ARTCODIGO, ARTNOME, ARTBIOGRAFIA, PSSNOME FROM ARTISTAS INNER JOIN PAISES ON PSSCODIGO = ARTNACIONALIDADE WHERE ARTCODIGO = ".$_GET["searchCod"]);
        $resultado = $consulta->fetch_assoc();
    ?>
    <div class="conteudoContainer">
        <h1 class="tituloEstilizado"><?php echo $resultado["ARTNOME"]; ?></h1>
            <div class="carrousel">
                <button class="voltar"><</button>
                <img src="https://i.insider.com/5ed01e6d3f73702b1e3f590c?width=1100&format=jpeg&auto=webp" alt="">
                <button class="avancar">></button>
            </div>
        <h1 class="tituloEstilizado">Albuns / Singles</h1>
    </div>
    <div class="albunsContainer caixa">
        <?php 
            $albConsulta = $oCon->query("SELECT ALBCODIGO, ALBNOME FROM ALBUNS WHERE ALBARTISTA = $resultado[ARTCODIGO]");
            while ($albResultado = $albConsulta->fetch_assoc()):
        ?>
        <div class="album">
            <img src="" alt=""><p><?php echo $albResultado["ALBNOME"] ?></p><a href="../cadastraAlbum.php?btnAlbum=<?php echo $albResultado["ALBCODIGO"]; ?>"><button>Saiba mais</button></a>
        </div>
        <?php endwhile; ?>
    </div>
    <div class="descricaoContainer caixa">
        <h1 class="tituloEstilizado">Biografia</h1>
        <div class="album desc" style="flex-direction: column; align-items:center">
            <p>Nacionalidade: <?php echo $resultado["PSSNOME"]; ?></p>
        </div>  
        <div class="album desc" style="flex-direction: column; align-items:center">
            <p><?php echo $resultado["ARTBIOGRAFIA"] == "" ? "Nada por aqui" : $resultado["ARTBIOGRAFIA"]; ?></p>
        </div>  
    </div>
</body>
</html>