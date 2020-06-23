<!DOCTYPE html>
<html lang="pt-br">
<?php include_once "../../src/php/ConexMySQL.php"; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../src/css/reset.css">
    <link rel="stylesheet" href="../../src/css/modeloVisualizar.css">
    <link rel="stylesheet" href="../../src/css/generics.css">
</head>
<body class="visualizerContainer">
    <script src="../../src/js/interactions.js"></script>
    <?php 
    $editBanda = ["BDSCODIGO"=>-1,"BDSNOME"=>"","BDSFORMACAO"=>"1900","BDSSEPARACAO"=>"1900","BDSNACIONALIDADE"=>""];

    if (isset($_GET["banda"])){
        $oConsulta = $oConx->query("SELECT BDSCODIGO, BDSNOME, YEAR(BDSFORMACAO) 'BDSFORMACAO', YEAR(BDSSEPARACAO) 'BDSSEPARACAO', BDSNACIONALIDADE FROM BANDAS WHERE BDSCODIGO = ".$_GET["banda"]);
        $editBanda = $oConsulta->fetch_assoc();
    }
    ?>

    <form class="visualizerBox scrollBox" method="POST" action="../../src/php/ValidaBanda.php">
        <h1 class="estiloBox">Cadastro de Bandas</h1>

        <aside class="estiloBox cardBox horizontalBox">
            <div class="card">
                <label>Nome: <input required value="<?php echo $editBanda["BDSNOME"]; ?>" name="txbBanda" type="text"></label>
                <label>Nacionalidade: 
                <select name="cbxNacio">
                <?php 
                    $oConsulta = $oConx->query("SELECT PSSCODIGO, PSSNOME FROM PAISES");
                    while($oResult = $oConsulta->fetch_array()){
                        echo "<option value='$oResult[0]'>$oResult[1]</option>";
                    }
                ?>
                </select>
                </label>

                <label>Formação: <input required value="<?php echo $editBanda["BDSFORMACAO"]; ?>" min="1900" max="<?php echo date("Y"); ?>" type="number" name="txbFormBanda"></label>
                <label>Separação: <input value="<?php echo $editBanda["BDSSEPARACAO"]; ?>" min="1900" max="<?php echo date("Y"); ?>" type="number" name="txbSepBanda"></label>
            </div>            
            <img class=estiloBoxInset onClick="document.all.btnEscolheImg.click()" id="pbxBanda" alt="">
            <input onChange="fnExibirArquivo(document.all.pbxBanda,this)" id=btnEscolheImg type="file" style="display:none">
        </aside>

        <aside class="estiloBox cardBox fullButtonWidth">
            <button type=send class=estiloBoxInset>Salvar</button>
            <?php if ($editBanda["BDSCODIGO"] == -1){?>
            <button type=reset class=estiloBoxInset>Limpar Tudo</button>
            <?php } else{?>
            <a href="./cadBanda"><button type=button class=estiloBoxInset>Cancelar</button></a>
            <?php } ?>
        </aside>
        
        <!-- Lista de integrantes -->
        <aside id="lstArtistas" class="estiloBox cardBox ">
            <h1 class="estiloBox">Integrantes</h1>
            
            <?php                     
                if($editBanda["BDSCODIGO"] == -1){ 
            ?>
            <div class="estiloBox card">
                <label type=button><button type=button onClick="fnAddElemento(this.parentElement.parentElement,document.all.lstArtistas)" class=estiloBoxInset>Adicionar</button></label>
                <label type=button><button type=button onClick="fnDelElemento(this.parentElement.parentElement)" class=estiloBoxInset>Deletar</button></label>
                <label>Nome: 
                    <select name="cbxArtista[]">
                    <?php echo CarregaLista("ARTISTAS", "ART", $oConx); ?>
                    </select>
                </label>

                <label>Função: 
                    <select name="cbxFuncArtista[]">
                    <?php echo CarregaLista("FUNCOES", "FNC", $oConx); ?>
                    </select>
                </label>
                <label>Adesão: <input name="txbAdesao[]" type="date"></label>
                <label>Separação: <input name="txbSeparacao[]" type="date" name="" id=""></label>              
            </div>

            <?php } else{ 
                $oConsulta = $oConx->query("SELECT ITGBANDA, ITGARTISTA, ITGFUNCAO, DATE(ITGADESAO), DATE(ITGSEPARACAO) FROM INTEGRANTES WHERE ITGBANDA = $editBanda[BDSCODIGO]");
                while($oListResult = $oConsulta->fetch_array()):
            ?>
            <div class="estiloBox card">
                <label type=button><button type=button onClick="fnAddElemento(this.parentElement.parentElement,document.all.lstArtistas)" class=estiloBoxInset>Adicionar</button></label>
                <label type=button><button type=button onClick="fnDelElemento(this.parentElement.parentElement,document.all.lstArtistas)" class=estiloBoxInset>Deletar</button></label>
                <label>Nome: 
                    <select name="cbxArtista[]">
                    <?php echo CarregaLista("ARTISTAS", "ART", $oConx, $oListResult[1]); ?>
                    </select>
                </label>

                <label>Função: 
                    <select name="cbxFuncArtista[]">
                    <?php echo CarregaLista("FUNCOES", "FNC", $oConx, $oListResult[2]); ?>
                    </select>
                </label>
                <label>Adesão: <input value="<?php echo $oListResult[3]; ?>" name="txbAdesao[]" type="date"></label>
                <label>Separação: <input value="<?php echo $oListResult[4]; ?>" name="txbSeparacao[]" type="date" name="" id=""></label>              
            </div>            

            <?php endwhile;} ?>
        </aside>
    </form>
    
    <!-- Lista de bandas cadastradas -->
    <section>
        <?php $oConsulta = $oConx->query("SELECT BDSCODIGO, BDSNOME FROM BANDAS"); ?>
        <h1 class="estiloBox"><?php echo $oConsulta->num_rows; ?> bandas cadastrados</h1>
        <aside class="estiloBox cardBox scrollBox">
            <div class="estiloBoxInset card">
                <?php  
                while($oRegistros = $oConsulta->fetch_array()):
                ?>
                <h3 class="estiloBoxInset fullWidth"><?php echo $oRegistros[1]; ?></h3>
                <label class="fullWidth"><img class=estiloBox src="../../database/bandas/<?php echo $oRegistros[0]; ?>.jpg" alt></label>
                <a class=fullWidth href="./cadBanda.php?banda=<?php echo $oRegistros[0]; ?>"><button type=button class="estiloBox">Visualizar/Editar</button></a>
                <?php endwhile; ?>
            </div>
        </aside>
    </section>
</body>
</html>