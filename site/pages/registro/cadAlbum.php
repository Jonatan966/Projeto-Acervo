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
<body class="visualizerContainer">
    <script src="../../src/js/interactions.js"></script>
    <form class="visualizerBox scrollBox">
        <h1 class="estiloBox">Cadastro de Albuns</h1>
        <aside class="estiloBox cardBox horizontalBox">
            <div class="card">
                <label for="">Nome: <input name="txbNomeAlbum" type="text"></label>
                <label for="">Gravadora: <select name="cbxGravadora"><?php echo CarregaLista("GRAVADORAS","GRV",$oConx); ?></select></label>
                <label for="">Lançamento: <input type="date" name="txbLancamento"></label>
                <label for="">Gênero: <select name="cbxGeneroAlbum"><?php echo $listGeneros = CarregaLista("GENEROS","GNR",$oConx); ?>></select></label>
                <label class="grupoRadio">
                    Tipo de Intérprete:
                    <input type="radio" name="selectInterprete" value="1" onClick="fnPreencheLista(this.value)" id="lblArtista"> <label for="lblArtista">Artista</label> 
                    <input type="radio" name="selectInterprete" value="2" onClick="fnPreencheLista(this.value)" id="lblBanda"> <label for="lblBanda">Banda</label> 
                    <input type="radio" name="selectInterprete" value="0" onClick="fnPreencheLista(this.value)" id="lblColetanea"> <label for="lblColetanea">Coletânea</label> 
                </label>
                <label class="fullWidth"> Intérprete: <select name="cmbInterprete"></select> </label>
            </div>            
            <img class=estiloBoxInset onClick="document.all.btnEscolheImg.click()" id="pbxAlbum">
            <input onChange="fnExibirArquivo(document.all.pbxAlbum,this)" id=btnEscolheImg type="file" style="display:none">
        </aside>
        <aside class="estiloBox cardBox fullButtonWidth">
            <button type=send class=estiloBoxInset>Salvar</button>
            <button type=reset class=estiloBoxInset>Limpar Tudo</button>
            <button type=button class=estiloBoxInset>Cancelar</button>
        </aside>
        <aside id="lstMusicas" class="estiloBox cardBox">
            <h1 class="estiloBox">Músicas</h1>
            <div class="estiloBox card">
                <label><button type=button onClick="fnAddElemento(this.parentElement.parentElement,document.all.lstMusicas)" class=estiloBoxInset>Adicionar</button></label>
                <label><button type=button onClick="fnDelElemento(this.parentElement.parentElement)" class=estiloBoxInset>Deletar</button></label>

                <label for="">Nome: <input type="text" name=""></label>
                <label for="">Gênero: <select name=""><?php echo $listGeneros; ?></select></label>
                <label for="">Duração: <input type="time"></label>
                <label for="">Intérprete: 
                    <select name="cmbInterpreteMus"><?php
                    $oConsulta = $oConx->query("SELECT 0 ORDEM, 0 CODIGO, '(selecionar)' NOME UNION SELECT 1, ARTCODIGO, ARTNOME FROM ARTISTAS UNION SELECT 2, BDSCODIGO, BDSNOME FROM BANDAS ORDER BY 1, 3");
                    while($oResult = $oConsulta->fetch_assoc()){
                        echo "<option value='$oResult[CODIGO]'>$oResult[NOME]</option>";
                    }
                    ?></select>
                </label>

                <strong class=fullWidth>Letra da música</strong>
                <textarea name=""></textarea>                
            </div>

        </aside>
    </form>

    <section>
        <?php $oConsulta = $oConx->query("SELECT ALBCODIGO, ALBNOME FROM ALBUNS"); ?>
        <h1 class="estiloBox"><?php echo $oConsulta->num_rows ?> albuns cadastrados</h1>
        <aside class="estiloBox cardBox scrollBox">
            <?php while($oResult = $oConsulta->fetch_array()): ?>
            <div class="estiloBoxInset card">
                <h3 class="estiloBoxInset fullWidth"><?php echo $oResult[1] ?></h3>
                <label class="fullWidth"><img class=estiloBox src="../../database/albuns/<?php echo $oResult[0]; ?>.jpg" alt></label>
                <a class=fullWidth href="./cadAlbum?album=<?php echo $oResult[0]; ?>"><button type=button class="estiloBox">Visualizar/Editar</button></a>
            </div>
            <?php endwhile; ?>
        </aside>
    </section>

    <script>
    let cArtistas = "<?php echo CarregaLista("ARTISTAS","ART",$oConx); ?>";
    let cBandas = "<?php echo CarregaLista("BANDAS","BDS",$oConx); ?>";
    function fnPreencheLista(nCodigo)
    {
        with(document.all.cmbInterprete)
        {
            innerHTML = "";
            document.all.cmbInterpreteMus.style.display = 'none';
            
            if(nCodigo==1)
                innerHTML = cArtistas;
            if(nCodigo==2)
                innerHTML = cBandas;
            if(nCodigo==0)
                document.all.cmbInterpreteMus.style.display = '';
            else
                document.all.cmbInterpreteMus.style.display = 'none';

        }
    }

    document.all.lblArtista.click();
    </script>
</body>
</html>