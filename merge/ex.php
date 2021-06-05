<?php
require_once ('../conexao.php');
require('fpdf_merge.php');
$ID = mysqli_escape_String($conexao, $_GET['id']);
$dir = "../docs_clientes/ficha".$ID.".pdf";
$merge = new FPDF_Merge();
$merge->add('../docs_clientes/ficha_admissao'.$ID.'.pdf');
$merge->add('../docs_clientes/ficha_de_registro'.$ID.'.pdf');
$merge->add('../docs_clientes/declaracao_de_vale_transporte'.$ID.'.pdf');
$merge->add('../docs_clientes/declaracao_de_dependentes'.$ID.'.pdf');

$merge->output($dir);
        $sql_militar = "UPDATE pfunc SET FICHAS = '$dir' WHERE ID = '$ID'";
        mysqli_query($conexao,$sql_militar);
        unlink("../docs_clientes/ficha_admissao".$ID.".pdf");
        unlink("../docs_clientes/ficha_de_registro".$ID.".pdf");
        unlink("../docs_clientes/declaracao_de_vale_transporte".$ID.".pdf");
        unlink("../docs_clientes/declaracao_de_dependentes".$ID.".pdf");
$merge->output();
?>
