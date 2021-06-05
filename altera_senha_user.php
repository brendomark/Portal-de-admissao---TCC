<?php
//sessao
session_start();
include('verifica_login.php');
//conexao
require_once 'conexao.php';


$ID = $_SESSION['id_user'] ;
$SENHA_BANCO = $_SESSION['senha'];
$SENHA_ATUAL = mysqli_escape_String($conexao, $_POST['senha_atual']);
$NOVA_SENHA = mysqli_escape_String($conexao, $_POST['nova_senha']);
$CONFIRMA_SENHA = mysqli_escape_String($conexao, $_POST['confirma_senha']);

if (($SENHA_ATUAL === $SENHA_BANCO) && ($NOVA_SENHA === $CONFIRMA_SENHA)) {
    $sql = "UPDATE ppessoa set SENHA = '{$NOVA_SENHA}' WHERE ID = '{$ID}' ";
    if(mysqli_query($conexao,$sql)):
        $_SESSION['mensagem'] = "Senha atualizado com sucesso!";
        header('location: senha_user.php');
    endif;

} else {
    $_SESSION['mensagem'] = "Erro ao atualizar senha!";
    header('location: senha_user.php');
    
}
       
?>