<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/cards.css">
</head>
<body class="cardsContainer">
    <div class="cardBox centerColumnBox">
        <h1 class="tituloEstilizado customBorder">Ultimos lançamentos</h1>
        <h3>Albuns deste mês</h3>
    </div>
    <div class="flexCardsContainer">
        <?php 
            include_once './php/conexaoMySQL.php';
            $feedConsulta = $oCon->query("SELECT ALBCODIGO 'Código do Álbum', ALBNOME 'Nome do Álbum', IFNULL(ARTNOME, BDSNOME) 'Interprete' "
            . "FROM ALBUNS LEFT JOIN ARTISTAS ON ALBARTISTA = ARTCODIGO "
            . "LEFT JOIN BANDAS ON ALBBANDA = BDSCODIGO WHERE DATE(ALBLANCAMENTO) >= DATE_SUB(NOW(), INTERVAL 30 DAY)");
            while ($feedResult = $feedConsulta->fetch_assoc()):
        ?>
        
        <div class="cardBox">
            <img src="img/<?php echo $feedResult["Código do Álbum"]; ?>.jpg" alt="">
            <h2><?php echo $feedResult["Nome do Álbum"]; ?></h2>
            <p>De: <?php echo $feedResult["Interprete"] ?></p>
        </div>
        
        <?php endwhile; ?>
    </div>
</body>
</html>