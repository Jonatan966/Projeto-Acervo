<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/artist.css">
    <title>Document</title>
</head>
<body>
    <?php 
        require 'php/conexaoMySQL.php';
        $editRes = ["ALBCODIGO"=>-1,"ALBNOME"=>"", "ALBARTISTA"=>"","ALBBANDA"=>"","ALBGENERO"=>"","ALBGRAVADORA"=>"","ALBLANCAMENTO"=>""];
        if (isset($_GET["btnAlbum"])){
            $edit = mysqli_query($oCon, "SELECT * FROM ALBUNS WHERE ALBCODIGO = $_GET[btnAlbum]");
            $editRes = mysqli_fetch_assoc($edit);
            $editRes["ALBLANCAMENTO"] = date_format(date_create($editRes["ALBLANCAMENTO"]),"Y-m-d");
        }
    ?>
    <style>
        .frmCadastro {
            display: flex;
            flex-direction: row;
            width: 90%;
            background-color: gold;
        }
        .frmCadastro .caixa {
            width: 65%;
            align-self: center;
        }

        .frmCadastro .frmImagem {
            display: flex;
            flex-direction: column;
            margin: 10px;
            align-items: center;
            width: 35%;
        }
        .frmCadastro .frmImagem img{
            flex: 1;
            width: 100%;
            margin: 15px auto 15px auto;
        }
        .frmCadastro .frmImagem input[type=file]{
            display: none;
        }
        .frmCadastro .frmImagem label{
            background: green;
            padding: 5px;
            width: 100%;
        }
    </style>
    <div class="conteudoContainer">
        <h1 class="tituloEstilizado">Cadastro de Album</h1>
        <form class="centerColumnBox" method="POST" action="php/regAlbum.php" enctype="multipart/form-data">
            <div class="frmCadastro customBorder">
            <div class="caixa">
                <div class="album">
                    Nome do Album: <input name="txbAlbum" type="text" value="<?php echo $editRes["ALBNOME"] ?>">
                </div>
                <div class="album">
                    Artista:
                    <select name="cbxArtista">
                        <option value="NULL">Não tem</option>
                        <?php CriarLista($oCon, "SELECT ARTCODIGO, ARTNOME FROM ARTISTAS", "ART", $editRes["ALBARTISTA"]) ?>
                    </select>
                </div>
                <div class="album">
                    Banda: 
                    <select name="cbxBanda">
                        <option value="NULL">Não tem</option>
                        <?php CriarLista($oCon, "SELECT BDSCODIGO, BDSNOME FROM BANDAS", "BDS", $editRes["ALBBANDA"]) ?>                        
                    </select>
                </div>
                <div class="album">
                    Gênero: <select name="cbxGenero">
                        <?php CriarLista($oCon, "SELECT GNRCODIGO, GNRNOME FROM GENEROS", "GNR", $editRes["ALBGENERO"]) ?>                                    
                    </select>
                </div>
                <div class="album">
                    Gravadora: <select name="cbxGravadora">
                        <?php CriarLista($oCon, "SELECT GRVCODIGO, GRVNOME FROM GRAVADORAS", "GRV", $editRes["ALBGRAVADORA"]) ?>                            
                    </select>
                </div>
                <div class="album">
                    Lançamento: <input value="<?php echo $editRes["ALBLANCAMENTO"] ?>" name="txbLancamento" type="date">
                </div>
                <div class="album">
                    <input name="albCodigo" type="hidden" value="<?php echo $editRes["ALBCODIGO"] ?>">
                    <button>Enviar</button>
                    <button>Limpar</button>
                </div>
            </div>
            <div class="frmImagem">
                <img src="img/<?php echo $editRes["ALBCODIGO"] ?>.jpg" id="imgPrev">
                <label class="customBorder">
                    Selecionar Imagem
                    <input name="txtCapaAlbum" type="file" accept="image/*" onchange="fnExibeArquivo(this)">
                </label>
            </div>
            </div>
        <h1 class="tituloEstilizado">Musicas</h1>
        <div id="containerMusica" class="caixa">
            <?php if($editRes["ALBCODIGO"] == -1): ?>
            <label id="lblMusica" class="album">
                <span>Nome: </span><input name="txbMusica[]">
                <span>Duração: </span><input name="txbDuracao[]">
                <span>Faixa: </span><input name="txbFaixa[]">
                <button type="button" onclick="fnNovaMusica()">+</button>
            </label>
            <?php 
                endif;
                if ($editRes["ALBCODIGO"] != -1){
                $vHTML = "";
                $query = mysqli_query($oCon, "SELECT MSCNOME, MSCDURACAO FROM MUSICAS WHERE MSCCODIGO IN(SELECT FXSMUSICA FROM FAIXAS WHERE FXSALBUM = $editRes[ALBCODIGO])");
                while ($reg = mysqli_fetch_assoc($query)):?>
                <label id="lblMusica" class="album">
                    <span>Nome: </span><input value="<?php echo $reg["MSCNOME"] ?>" name="txbMusica[]">
                    <span>Duração: </span><input value="<?php echo $reg["MSCDURACAO"] ?>" name="txbDuracao[]">
                    <span>Faixa: </span><input value="1" name="txbFaixa[]">
                    <button type="button" onclick="fnNovaMusica()">+</button>
                </label>
                <?php endwhile; }?>
        </div>
        </form>
    </div>

    <form method="GET" class="descricaoContainer caixa">
        <h1 class="tituloEstilizado">Albuns encontrados</h1>
        <?php 
                    //$vHTML = "<div class='album'><img src=''><p>{1}</p><button value='{0}'>Adicionar</button></div>";
            //CriarCoisas($oCon, "SELECT MSCCODIGO, MSCNOME FROM MUSICAS", "MSC", $vHTML);
            $vHTML = "<div class='album desc'><img src='img/{0}.jpg'><p>{1}</p><button name='btnAlbum' value='{0}'>Editar</button></div>";
            CriarCoisas($oCon, "SELECT ALBCODIGO, ALBNOME FROM ALBUNS ORDER BY ALBNOME", "ALB", $vHTML);
        ?>
    </form>
    <script src="js/interactions.js"></script>
    <script>
        function fnNovaMusica(){
            document.all.lblMusica.insertAdjacentHTML('afterEnd', '<label  class="album">'+document.all.lblMusica.innerHTML+'</label>');
        }
    </script>
</body>
</html>