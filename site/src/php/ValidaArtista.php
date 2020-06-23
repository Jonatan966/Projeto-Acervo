<?php 
require_once "./ConexMySQL.php";
$artCodigo = -1;
$nomeArtista = str_replace("'","''",$_POST["txbNomeArtista"]);

if (!isset($_POST["artista"])){
  $oRegistro = $oConx->query("INSERT INTO ARTISTAS(ARTNOME, ARTBIOGRAFIA, ARTNACIONALIDADE)".
  "VALUES('$nomeArtista','$_POST[txbBiografia]',$_POST[cbxNacio])");
  $artCodigo = $oConx->insert_id;
}
else{
  $artCodigo = $_POST["artista"];
  $oRegistro = $oConx->query("UPDATE ARTISTAS SET ARTNOME = '$nomeArtista', ARTBIOGRAFIA = '$_POST[txbBiografia]', ARTNACIONALIDADE = $_POST[cbxNacio] WHERE ARTCODIGO = $artCodigo");
}

if($oRegistro){
    if($_FILES['objImagem']['size'] > 0){
      move_uploaded_file($_FILES['objImagem']['tmp_name'], "../../database/artistas/$artCodigo.jpg");
    }
}
echo "UPDATE ARTISTAS SET ARTNOME = '$nomeArtista', ARTBIOGRAFIA = '$_POST[txbBiografia]', ARTNACIONALIDADE = $_POST[cbxNacio] WHERE ARTCODIGO = $artCodigo";
$oConx->close();
header("Location:../../pages/registro/cadArtista.php");
?>