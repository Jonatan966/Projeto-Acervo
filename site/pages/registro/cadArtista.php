<!DOCTYPE html>
<?php include_once("../../src/php/ConexMySQL.php"); ?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../src/css/reset.css">
    <link rel="stylesheet" href="../../src/css/modeloVisualizar.css">
    <link rel="stylesheet" href="../../src/css/generics.css">
</head>
<body class="visualizerContainer noScroll">
    <?php
    $editArtista = ["ARTCODIGO"=>-1, "ARTNOME"=>"","ARTBIOGRAFIA"=>"","ARTNACIONALIDADE"=>""]; 
    if (isset($_GET["artista"])){
        $oConsulta = $oConx->query("SELECT * FROM ARTISTAS WHERE ARTCODIGO = ".$_GET["artista"]);
        $editArtista = $oConsulta->fetch_assoc();
    }
    ?>

    <form method="POST" action="../../src/php/ValidaArtista.php" class="visualizerBox scrollBox" enctype="multipart/form-data">
        <h1 class="estiloBox">Cadastro de Artistas</h1>
        <aside class="estiloBox cardBox horizontalBox">
            <div class="card">
                <label>Nome: <input required value="<?php echo $editArtista["ARTNOME"]; ?>" name="txbNomeArtista" type="text"></label>
                <label>Nacionalidade: 
                    <select name="cbxNacio" id="">
                        <?php 
                        $oConsulta = $oConx->query("SELECT PSSCODIGO, PSSNOME FROM PAISES"); 
                        while($oResult = $oConsulta->fetch_assoc()){
                            echo "<option ".($editArtista["ARTNACIONALIDADE"]==$oResult["PSSCODIGO"]?"selected":"") . 
                            " value='$oResult[PSSCODIGO]'> $oResult[PSSNOME]</option>"; 
                        }
                        ?> 
                    </select>
                </label>
                <strong class=fullWidth>Biografia</strong>
                <textarea required name="txbBiografia"><?php echo $editArtista["ARTBIOGRAFIA"]; ?></textarea>                
            </div>            
            <img id="pbxArtistImg" class=estiloBoxInset onClick="document.all.btnEscolheImg.click()" src="../../database/artistas/<?php echo $editArtista["ARTCODIGO"].".jpg"; ?>" alt="">
            <input onChange="fnExibirArquivo(document.all.pbxArtistImg,this)" name="objImagem" id=btnEscolheImg type="file" style="display:none">
        </aside>
        <aside class="estiloBox cardBox fullButtonWidth">
            <button type=send class=estiloBoxInset>Salvar</button>
            <?php if($editArtista["ARTCODIGO"] != -1){ ?>
            <a href="./cadArtista.php"><button type=button class=estiloBoxInset>Cancelar</button></a>
            <?php }else{ ?>
            <button type=reset class=estiloBoxInset>Limpar Tudo</button>
            <?php } ?>
        </aside>

        <?php 
            if(isset($_GET["func"])){ 
                if($_GET["func"] == "consultar"){
        ?>
        <aside class="estiloBox cardBox">
            <h1 class="estiloBox">Bandas pertencentes</h1>
            <div class="estiloBox card">
                <label class=fullWidth type=button for=""><button class=estiloBoxInset>Saiba mais</button></label>
                <label for="">Nome: <input type="text" name="" id=""></label>
                <label for="">Função: <select name="" id=""></select></label>
                <label for="">Nacionalidade: <select name="" id=""></select></label>
                <label for="">Adesão: <input type="date"></label>
                <label for="">Separação: <input type="date" name="" id=""></label>
            </div>
        </aside>
        <?php }} ?>
        <input type="hidden" value="<?php echo $editArtista["ARTCODIGO"]; ?>" name="artista">
    </form>

    <section>
        <?php $oConsulta = $oConx->query("SELECT ARTCODIGO, ARTNOME FROM ARTISTAS ORDER BY ARTNOME ASC"); ?>
        <h1 class="estiloBox"><?php echo $oConsulta->num_rows; ?> artistas cadastrados</h1>
        <aside class="estiloBox cardBox scrollBox">
            <?php while($oResult = $oConsulta->fetch_assoc()): ?>
            <div class="estiloBoxInset card">
                <h3 class="estiloBoxInset fullWidth"><?php echo $oResult["ARTNOME"]; ?></h3>
                <label class="fullWidth" for=""><img class=estiloBox src="../../database/artistas/<?php echo $oResult["ARTCODIGO"]; ?>.jpg" alt=""></label>
                <a class=fullWidth href="cadArtista.php?artista=<?php echo $oResult["ARTCODIGO"]; ?>"><button type=button class="estiloBox">Visualizar/Editar</button></a>
            </div>
            <?php endwhile; ?>
        </aside>
    </section>
    <script src="../../src/js/interactions.js"></script>
</body>
</html>