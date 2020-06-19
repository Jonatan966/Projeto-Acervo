<?php
    $oCon = mysqli_connect("localhost", "root", "", "acervo");
    mysqli_set_charset($oCon, "utf8");
    function CriarLista($oCon, $cSQL, $prefix, $selected = ""){
        $oConsulta = mysqli_query($oCon, $cSQL);
        while ($vReg = mysqli_fetch_assoc($oConsulta)) {
            echo "<option ".($selected == $vReg[$prefix."CODIGO"] ? "selected" : "")." value='".$vReg[$prefix."CODIGO"]."'>".$vReg[$prefix."NOME"]."</option>";
        }        
    }
    function CriarCoisas($oConex, $cSQL, $prefix, $html){
        $oConsulta = mysqli_query($oConex, $cSQL);
        while ($vReg = mysqli_fetch_assoc($oConsulta)) {
            $finalHTML = str_replace("{0}", $vReg[$prefix."CODIGO"],$html);
            $finalHTML = str_replace("{1}", $vReg[$prefix."NOME"], $finalHTML);
            echo $finalHTML;
        }
    }
?>

