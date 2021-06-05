<?php
/*
para usar o banco com os exemplos:
criar um banco samples
associar o mesmo usuario do banco principal (para facilitar)
rodar o script ./phpjasperxml/sample/sampledb.sql

No sample1 tem caracteres do mandarim na descrição do item, entao nao esta errado

Se quiser usar dados estaticos como fonte de dados, so nao conectar em nenhum banco (comentar a conexao na linha 27)
e passar os dados como array igual ja faz
*/

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
$PHPJasperXML->load_xml_file('./phpjasperxml/sample/exame_admissao.jrxml');
//$PHPJasperXML->load_xml_file('./phpjasperxml/sample/sample2.jrxml');

//$PHPJasperXML->transferDBtoArray($server, $user, $pass, $db); // usar qdo apontar para o banco com os exemplos
$PHPJasperXML->transferDBtoArray(HOST, USUARIO, SENHA, DB); // usar qdo apontar para o banco real

$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file

?>