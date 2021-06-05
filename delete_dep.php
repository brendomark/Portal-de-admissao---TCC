<?php
//sessao
session_start();
include('verifica_login.php');
//conexao
require_once 'conexao.php';

$ID = mysqli_escape_String($conexao, $_GET['id']);
$ID_FUNC = mysqli_escape_String($conexao, $_GET['ID_USER']);
$MATRICULA = $_SESSION['chapa'];

$sql = "DELETE FROM PFDEPEND WHERE ID_FUNC = '$MATRICULA' AND ID_DEP = '$ID'";

    if(mysqli_query($conexao,$sql)):
        $_SESSION['mensagem'] = "Dependente ".($ID+1)." deletado com sucesso!";
        header(sprintf("location: editar.php?id=%s", $ID_FUNC));
    else:
        $_SESSION['mensagem'] = "Erro ao Deletar Dependente!";
        header(sprintf("location: editar.php?id=%s", $ID_FUNC));
    endif;
?>
