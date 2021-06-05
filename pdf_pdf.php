<?php

require_once ('conexao.php'); // usar qdo apontar para o banco real
include_once("phpjasperxml/PHPJasperXML.inc.php");
//require_once ('./phpjasperxml/sample/setting.php'); // usar para o banco com os exemplos (se tiver)

$PHPJasperXML = new PHPJasperXML();

$ID = mysqli_escape_String($conexao, $_GET['id']);
$PHPJasperXML->arrayParameter=array("parameter1"=>$ID);

// qualquer destes 2 funcionam. So alterar o path para o jrxml q quer usar
// descomenta um, comenta o outro - se deixar os 2 descomentados da erro
// PRO PRIMEIRO FUNCIONAR, TEM DE COPIAR O ARQUIVO EM ./phpjasperxml/sample/simitlogo.png para a raiz do site
// O segundo como é estático, so descomentar, comentar o primeiro, e rodar
$PHPJasperXML->load_xml_file('./phpjasperxml/sample/ficha_admissao.jrxml');
$PHPJasperXML->transferDBtoArray(HOST, USUARIO, SENHA, DB); // usar qdo apontar para o banco real
unlink("docs_clientes/ficha_admissao".$ID.".pdf");
$PHPJasperXML->outpage("F","docs_clientes/ficha_admissao".$ID.".pdf");



$PHPJasperXML1 = new PHPJasperXML();

$ID = mysqli_escape_String($conexao, $_GET['id']);
$PHPJasperXML1->arrayParameter=array("parameter1"=>$ID);

$PHPJasperXML1->load_xml_file('./phpjasperxml/sample/ficha_de_registro.jrxml');
$PHPJasperXML1->transferDBtoArray(HOST, USUARIO, SENHA, DB); // usar qdo apontar para o banco real
unlink("docs_clientes/ficha_de_registro".$ID.".pdf");
$PHPJasperXML1->outpage("F","docs_clientes/ficha_de_registro".$ID.".pdf");



$PHPJasperXML2 = new PHPJasperXML();

$ID = mysqli_escape_String($conexao, $_GET['id']);
$PHPJasperXML2->arrayParameter=array("parameter1"=>$ID);

$PHPJasperXML2->load_xml_file('./phpjasperxml/sample/declaracao_de_vale_transporte.jrxml');
$PHPJasperXML2->transferDBtoArray(HOST, USUARIO, SENHA, DB); // usar qdo apontar para o banco real
unlink("docs_clientes/declaracao_de_vale_transporte".$ID.".pdf");
$PHPJasperXML2->outpage("F","docs_clientes/declaracao_de_vale_transporte".$ID.".pdf");



$PHPJasperXML3 = new PHPJasperXML();

$ID = mysqli_escape_String($conexao, $_GET['id']);
$PHPJasperXML3->arrayParameter=array("parameter1"=>$ID);

$PHPJasperXML3->load_xml_file('./phpjasperxml/sample/declaracao_de_dependentes.jrxml');
$PHPJasperXML3->transferDBtoArray(HOST, USUARIO, SENHA, DB); // usar qdo apontar para o banco real
unlink("docs_clientes/declaracao_de_dependentes".$ID.".pdf");
$PHPJasperXML3->outpage("F","docs_clientes/declaracao_de_dependentes".$ID.".pdf");

header('Location: merge/ex.php?id='.$ID);

?>
