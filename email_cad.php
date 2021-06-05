<?php 
session_start();
include('verifica_login.php');
include('mensagem.php');
include_once 'conexao.php';

$CODCOLIGADA = $_SESSION['coligada'];
$ID = $_SESSION['id_user'];
$HOST = mysqli_escape_String($conexao, $_POST['host']);
$EMAIL = mysqli_escape_String($conexao, $_POST['email']);
$PORTA = mysqli_escape_String($conexao, $_POST['port']);
$SENHA = mysqli_escape_String($conexao, $_POST['senha']);

$query = "SELECT * FROM email WHERE codcoligada = '$CODCOLIGADA'";
$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);

$email_pes = "UPDATE ppessoa SET email='$EMAIL' where id = '$ID'";

if($row >= 1){
    $sql1 = "UPDATE EMAIL SET CODCOLIGADA='$CODCOLIGADA', HOST='$HOST', EMAIL='$EMAIL', PORTA='$PORTA', SENHA='$SENHA' WHERE CODCOLIGADA = '$CODCOLIGADA'";
    if(mysqli_query($conexao,$sql1)):
        mysqli_query($conexao,$email_pes);
        $_SESSION['mensagem'] = "Configuração Realizada!";
        header('location: email.php');
    else:
        $_SESSION['mensagem'] = "Erro ao Atualizar!";
        header('location: email.php');
    endif;

}else{
    $sql = "INSERT INTO EMAIL (CODCOLIGADA,HOST,EMAIL,PORTA,SENHA) VALUES('$CODCOLIGADA','$HOST','$EMAIL','$PORTA','$SENHA')";
    if(mysqli_query($conexao,$sql)):
        mysqli_query($conexao,$email_pes);
        $_SESSION['mensagem'] = "Configuração Realizada!";
        header('location: email.php');
    else:
        $_SESSION['mensagem'] = "Erro ao Atualizar!";
        header('location: email.php');
    endif;
}
?>
