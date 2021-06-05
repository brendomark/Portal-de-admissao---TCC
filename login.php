<?php
session_start();
    include('conexao.php');
if( empty($_POST['usuario']) || empty($_POST['senha']) ){
    header('location: index.php');
    exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "SELECT * FROM PPESSOA P INNER JOIN GCOLIGADA G ON G.codcoligada = p.codcoligada WHERE P.USUARIO = '{$usuario}' AND P.SENHA = '{$senha}'";
$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);

if($row == 1){
    $dadosusuario = mysqli_fetch_assoc($result);
    if($dadosusuario['NIVELACESSO'] == 2 ){
        $_SESSION['cpf'] = $dadosusuario['CPF'];
        $_SESSION['id_user'] = $dadosusuario['ID'];
        $_SESSION['usuario'] = $usuario;
        $_SESSION['senha'] = $senha;
        $_SESSION['nome'] = $dadosusuario['PRIMEIRONOME'];
        $_SESSION['datacadastro'] = $dadosusuario['DATACADASTRO'];
        $_SESSION['datalimite'] = $dadosusuario['DATALIMITE'];
        $_SESSION['nivelacesso'] = $dadosusuario['NIVELACESSO'];
        $_SESSION['coligada'] = $dadosusuario['CODCOLIGADA'];
        $_SESSION['nomecoligada'] = $dadosusuario['NOMECOLIGADA'];
        $_SESSION['email'] = $dadosusuario['EMAIL'];
        header('Location: painelrh.php');
        exit();
    }else if($dadosusuario['NIVELACESSO'] == 1 ){
        $_SESSION['cpf'] = $dadosusuario['CPF'];
        $_SESSION['id_user'] = $dadosusuario['ID'];
        $_SESSION['usuario'] = $usuario;
        $_SESSION['senha'] = $senha;
        $_SESSION['nome'] = $dadosusuario['PRIMEIRONOME'];
        $_SESSION['datacadastro'] = $dadosusuario['DATACADASTRO'];
        $_SESSION['datalimite'] = $dadosusuario['DATALIMITE'];
        $_SESSION['nivelacesso'] = $dadosusuario['NIVELACESSO'];
        $_SESSION['nomecoligada'] = $dadosusuario['NOMECOLIGADA'];
        $_SESSION['coligada'] = $dadosusuario['CODCOLIGADA'];
        $_SESSION['chapa'] = $dadosusuario['MATRICULA'];
        $_SESSION['email'] = $dadosusuario['EMAIL'];
        header('Location: painel.php');
        exit();
    }
}
else{

    $_SESSION['nao_autenticado'] = true;
    header('Location: index.php');
    exit();

}

?>