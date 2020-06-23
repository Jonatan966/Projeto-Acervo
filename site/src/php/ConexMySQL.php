<?php 
    $oConx = mysqli_connect("localhost", "root", "", "acervo");
    $oConx->set_charset("utf8"); 
    
    function CarregaLista($tabela, $iniciais, $oConexao, $pesquisa = 0)
    {
        $oFinal = "";
        $oConsulta = $oConexao->query("SELECT {$iniciais}CODIGO, {$iniciais}NOME FROM $tabela");
        while($oResult = $oConsulta->fetch_array()){
            $oTeste = $oResult[0] == intval($pesquisa) ? "selected" : "";
            $oFinal .= "<option $oTeste value='$oResult[0]'>$oResult[1]</option>";
        }
        return $oFinal;
    }
?>