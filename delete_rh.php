<?php
//sessao
session_start();
include('verifica_login.php');
//conexao
require_once 'conexao.php';

//if(isset($_POST['btn-deletar']));

$ID = mysqli_escape_String($conexao, $_GET['id']);
$MATRICULA = mysqli_escape_String($conexao, $_GET['mt']);
$CODCOLIGADA = $_SESSION['coligada'];

$sql0 = "DELETE FROM PFDEPEND WHERE ID_FUNC = '$MATRICULA' AND CODCOLIGADA = '$CODCOLIGADA'";
$sql = "DELETE FROM pfunc WHERE ID = '$ID'";
$sql2 = "DELETE FROM PPESSOA WHERE ID = '$ID'";

$apagar_foto = "SELECT FOTO_PERFIL,ANEXO_CPF,ANEXO_RG,ANEXO_TITULO,ANEXO_CTPS,ANEXO_MILITAR,ANEXO_END FROM PFUNC FUN WHERE FUN.ID ='{$ID}'";


        $dados = mysqli_query($conexao,$apagar_foto);
        $local_foto =mysqli_fetch_assoc($dados);
        
    if(mysqli_query($conexao,$sql)):
        mysqli_query($conexao,$sql2);
        mysqli_query($conexao,$sql0);
        unlink($local_foto["FOTO_PERFIL"]);
        unlink($local_foto["ANEXO_CPF"]);
        unlink($local_foto["ANEXO_RG"]);
        unlink($local_foto["ANEXO_TITULO"]);
        unlink($local_foto["ANEXO_CTPS"]);
        unlink($local_foto["ANEXO_MILITAR"]);
        unlink($local_foto["ANEXO_END"]);
        $_SESSION['mensagem'] = "Deletado com sucesso!";
        header('location: painelrh.php');
    else:
        $_SESSION['mensagem'] = "Erro ao Deletar!";
        header('location: painelrh.php');
    endif;
?>
