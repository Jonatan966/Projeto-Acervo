<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/artist.css">
    <title>Document</title>
</head>
<body>
    <?php 
        require '../php/conexaoMySQL.php';
        $albConsulta = mysqli_query($oCon, "SELECT * FROM ALBUNS WHERE ALBCODIGO = $_GET[searchCod]");
        $albResultado = mysqli_fetch_assoc($albConsulta);
        $albResultado["ALBLANCAMENTO"] = date_format(date_create($albResultado["ALBLANCAMENTO"]),"Y-m-d");
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
        <h1 class="tituloEstilizado"><?php echo $albResultado["ALBNOME"] ?></h1>
        <div class="centerColumnBox">
            <div class="frmCadastro customBorder">
            <div class="caixa">
                <div class="album">
                    Artista:
                    <select name="cbxArtista">
                        <option value="NULL">Não tem</option>
                        <?php CriarLista($oCon, "SELECT ARTCODIGO, ARTNOME FROM ARTISTAS", "ART", $albResultado["ALBARTISTA"]) ?>
                    </select>
                </div>
                <div class="album">
                    Banda: 
                    <select name="cbxBanda">
                        <option value="NULL">Não tem</option>
                        <?php CriarLista($oCon, "SELECT BDSCODIGO, BDSNOME FROM BANDAS", "BDS", $albResultado["ALBBANDA"]) ?>                        
                    </select>
                </div>
                <div class="album">
                    Gênero: <select name="cbxGenero">
                        <?php //CriarLista($oCon, "SELECT GNRCODIGO, GNRNOME FROM GENEROS", "GNR", $albResultado["ALBGENERO"]) ?>                                    
                    </select>
                </div>
                <div class="album">
                    Gravadora: <select name="cbxGravadora">
                        <?php CriarLista($oCon, "SELECT GRVCODIGO, GRVNOME FROM GRAVADORAS", "GRV", $albResultado["ALBGRAVADORA"]) ?>                            
                    </select>
                </div>
                <div class="album">
                    Lançamento: <input value="<?php echo $albResultado["ALBLANCAMENTO"] ?>" name="txbLancamento" type="date">
                </div>
            </div>
            <div class="frmImagem">
                <img src="img/<?php echo $albResultado["ALBCODIGO"] ?>.jpg" id="imgPrev">
            </div>
            </div>
        <h1 class="tituloEstilizado">Musicas</h1>
        <div id="containerMusica" class="caixa">
            <?php 
                $mscConsulta = $oCon->query("SELECT MSCCODIGO, MSCNOME, MSCDURACAO FROM MUSICAS INNER JOIN FAIXAS ON FXSMUSICA = MSCCODIGO WHERE FXSALBUM = $_GET[searchCod]");
                while ($mscResultado = $mscConsulta->fetch_assoc()):
            ?>
            <label id="lblMusica" class="album">
                <p><strong>Nome: </strong><?php echo $mscResultado["MSCNOME"]; ?></p>
                <p><strong>Duração: </strong><?php echo $mscResultado["MSCDURACAO"]; ?></p>
                 <button type="button">Saiba mais</button>
            </label>
            <?php endwhile; ?>
        </div>
        </div>
    </div>

    <div method="GET" class="descricaoContainer caixa">
        <h1 class="tituloEstilizado">Interpretes</h1>
        <div class="album">
            <h1>Em Obras</h1>
        </div>
    </div>
    <script src="js/interactions.js"></script>
</body>
</html>