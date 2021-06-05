<?php
//sessao
session_start();
include('verifica_login.php');
//conexao
require_once 'conexao.php';

if(isset($_POST['btn-cadastrar']));
$COLIGADA = $_SESSION['coligada'];
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


/*$sql = "INSERT INTO PPESSOA(USUARIO,CPF,SENHA,EMAIL,CODSECAO,PRIMEIROEMP,DTADMISSAO,GESTOR,CODFUNCAO,TPSALARIO,SALARIO,JORNADA,HORARIOS,MATRICULA,LOCALSERVICO,TPJORNADA,CONTRATACAO,PRAZO)
 VALUES(UPPER('$USUARIO') , '$CPF' , '$SENHA' , '$EMAIL' , '$SECAO' , '$PRIMEIRO_EMP' , STR_TO_DATE('$DT_ADMISSAO', '%d/%m/%Y'), '$GESTOR' , '$FUNCAO' , '$TP_SALARIO' , '$SALARIO' , '$JORNADA' , '$HORARIOS', '$LOCAL_SERVE' , '$TP_JORNADA' , '$CONTRATACAO' , '$PRAZO')";*/

$sql = "INSERT INTO PPESSOA(CODCOLIGADA,USUARIO,PRIMEIRONOME,CPF,SENHA,EMAIL,DATACADASTRO,DATALIMITE,CODSECAO,PRIMEIROEMP,DTADMISSAO,GESTOR,CODFUNCAO,TPSALARIO,SALARIO,JORNADA,HORARIOS,MATRICULA,LOCALSERVICO,TPJORNADA,CONTRATACAO,PRAZO)
 VALUES('$COLIGADA','$USUARIO', '$NOMEUSUARIO', '$CPF' , '$SENHA' , '$EMAIL' ,CURDATE(),STR_TO_DATE('$DTLIMITE', '%d/%m/%Y'), '$SECAO' , '$PRIMEIRO_EMP' , STR_TO_DATE('$DT_ADMISSAO', '%d/%m/%Y') , '$GESTOR' , '$FUNCAO' , '$TP_SALARIO' , REPLACE( REPLACE( '$SALARIO', '.' ,'' ), ',', '.' ) , '$JORNADA' , '$HORARIOS' , '$MATRICULA' , '$LOCAL_SERVE' , '$TP_JORNADA' , '$CONTRATACAO' , '$PRAZO')";
    if(mysqli_query($conexao,$sql)):
        $_SESSION['mensagem'] = "Cadastrado com sucesso!";
        header('location: lista_user_rh.php');
    else:
        $_SESSION['mensagem'] = "Erro ao cadastrar";
        header('location: lista_user_rh.php');
    endif;
?>
