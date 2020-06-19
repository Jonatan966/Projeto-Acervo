<?php
require './conexaoMySQL.php';

mysqli_begin_transaction($oCon);
$cSQL = "INSERT INTO ALBUNS (ALBNOME, ALBARTISTA, ALBBANDA, ALBGENERO, ALBGRAVADORA, ALBLANCAMENTO)"
       ."VALUES ('$_POST[txbAlbum]', $_POST[cbxArtista], $_POST[cbxBanda],$_POST[cbxGenero],$_POST[cbxGravadora],'$_POST[txbLancamento]')";
if ($_POST["albCodigo"] != -1){
    $cSQL = "UPDATE ALBUNS SET ALBNOME = '$_POST[txbAlbum]', ALBARTISTA = $_POST[cbxArtista], "
            . "ALBBANDA = $_POST[cbxBanda], ALBGENERO = $_POST[cbxGenero], "
            . "ALBGRAVADORA = $_POST[cbxGravadora],ALBLANCAMENTO = '$_POST[txbLancamento]' "
            . "WHERE ALBCODIGO = $_POST[albCodigo]";
}
echo $cSQL;
if (mysqli_query($oCon, $cSQL)){
    $musica = $_POST["txbMusica"];
    $duracao = $_POST["txbDuracao"];
    $codAlbum = mysqli_insert_id($oCon);
    
    for ($x = 0; $x < count($_POST["txbMusica"]); $x++){
        $cSQL = "INSERT INTO MUSICAS(MSCNOME, MSCDURACAO) VALUES('".$musica[$x]."','".$duracao[$x]."')";
        if ($musica[$x] == "" || $duracao[$x] == ""){
            mysqli_rollback($oCon);
            break;
        }
        if (mysqli_query($oCon, $cSQL)) {
            $codMusica = mysqli_insert_id($oCon);
            $cSQL = "INSERT INTO FAIXAS (FXSMUSICA, FXSALBUM, FXSPOSICAO) VALUES($codMusica, $codAlbum, ".($x+1).")";
            if (mysqli_query($oCon, $cSQL)) {
                mysqli_commit($oCon);
            } else {
                echo mysqli_error($oCon);
                mysqli_rollback($oCon);
            }
        } else {
            echo mysqli_error($oCon);
            mysqli_rollback($oCon);
        }
    }
}
mysqli_close($oCon);
header("location: ../cadastraAlbum.php");