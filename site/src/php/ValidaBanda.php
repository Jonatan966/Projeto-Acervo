<?php 
require_once "./ConexMySQL.php";

$oConx->begin_transaction();
if ($oConx->query("INSERT INTO BANDAS(BDSNOME, BDSFORMACAO, BDSSEPARACAO, BDSNACIONALIDADE)".
    "VALUES('$_POST[txbBanda]','$_POST[txbFormBanda]-01-01','$_POST[txbSepBanda]-01-01',$_POST[cbxNacio])")){
    $bdsCodigo = $oConx->insert_id;
    $funcArtista = $_POST["cbxFuncArtista"];
    $adesArtista = $_POST["txbAdesao"];
    $sepArtista = $_POST["txbSeparacao"];

    foreach ($_POST["cbxArtista"] as $x => $item) {
        $cSQL = "INSERT INTO INTEGRANTES VALUES($bdsCodigo,$item,$funcArtista[$x],";
        $cSQL .= $adesArtista[$x] == "" ? "NULL, " : "'".$adesArtista[$x]."', ";
        $cSQL .= ($sepArtista[$x] == "" ? "NULL" : "'".$sepArtista[$x]."'").")"; 
        if (!$oConx->query($cSQL)){
            $oConx->rollback();
            break;
        }
    }
    $oConx->commit();
    header("Location: ../../pages/registro/cadBanda.php");
}
?>