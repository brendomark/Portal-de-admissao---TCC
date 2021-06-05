<?php
//sessao
session_start();
include('verifica_login.php');
//conexao
require_once 'conexao.php';

if(isset($_POST['btn-cadastrar']));
$COLIGADA = $_SESSION['coligada'];
$ID = mysqli_escape_String($conexao, $_POST['id']);
$USUARIO = mysqli_escape_String($conexao, $_POST['usuario']);
$NOMEUSUARIO = mysqli_escape_String($conexao, $_POST['nomeusuario']);
$CPF = mysqli_escape_String($conexao, $_POST['cpf']);
$SENHA = mysqli_escape_String($conexao, $_POST['password']);
$EMAIL = mysqli_escape_String($conexao, $_POST['email']);
$DTLIMITE = mysqli_escape_String($conexao, $_POST['datalimite']);

$SECAO = mysqli_escape_String($conexao, $_POST['secao']);
$PRIMEIRO_EMP = mysqli_escape_String($conexao, $_POST['primeiroemp']);
$DT_ADMISSAO = mysqli_escape_String($conexao, $_POST['dtadmissao']);
$GESTOR = mysqli_escape_String($conexao, $_POST['gestor']);
$FUNCAO = mysqli_escape_String($conexao, $_POST['funcao']);
$TP_SALARIO = mysqli_escape_String($conexao, $_POST['tpsalario']);
$SALARIO = mysqli_escape_String($conexao, $_POST['salario']);
$JORNADA = mysqli_escape_String($conexao, $_POST['jornada']);
$HORARIOS = mysqli_escape_String($conexao, $_POST['tphorario']);
$MATRICULA = mysqli_escape_String($conexao, $_POST['matricula']);
$LOCAL_SERVE = mysqli_escape_String($conexao, $_POST['localserve']);
$TP_JORNADA = mysqli_escape_String($conexao, $_POST['tpjornada']);
$CONTRATACAO = mysqli_escape_String($conexao, $_POST['contratacao']);
$PRAZO = mysqli_escape_String($conexao, $_POST['prazo']);


$sql = "UPDATE PPESSOA SET USUARIO ='$USUARIO', PRIMEIRONOME ='$NOMEUSUARIO', CPF='$CPF', SENHA ='$SENHA' , EMAIL ='$EMAIL', DATALIMITE = STR_TO_DATE('$DTLIMITE', '%d/%m/%Y'), CODSECAO = '$SECAO', PRIMEIROEMP = '$PRIMEIRO_EMP', DTADMISSAO =STR_TO_DATE('$DT_ADMISSAO', '%d/%m/%Y'), GESTOR ='$GESTOR', CODFUNCAO = '$FUNCAO', TPSALARIO = '$TP_SALARIO', SALARIO = REPLACE( REPLACE( '$SALARIO', '.' ,'' ), ',', '.' ), JORNADA = '$JORNADA', HORARIOS = '$HORARIOS', MATRICULA = '$MATRICULA', LOCALSERVICO = '$LOCAL_SERVE', TPJORNADA = '$TP_JORNADA', CONTRATACAO = '$CONTRATACAO', PRAZO = '$PRAZO' WHERE id = '$ID' and CODCOLIGADA ='$COLIGADA'";

    if(mysqli_query($conexao,$sql)):
        $_SESSION['mensagem'] = "Cadastrado com sucesso!";
        header('location: lista_user_rh.php');
    else:
        $_SESSION['mensagem'] = "Erro ao cadastrar";
        header('location: lista_user_rh.php');
    endif;
?>
