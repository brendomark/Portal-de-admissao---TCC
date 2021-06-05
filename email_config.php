<?php
session_start();
include('verifica_login.php');
require_once 'conexao.php';
require_once 'email/PHPMailer.php';
require_once 'email/SMTP.php';
require_once 'email/Exception.php';

$CODCOLIGADA = $_SESSION['coligada'];
$ID = mysqli_escape_String($conexao, $_GET['id']);

$query = "SELECT * FROM email WHERE codcoligada = '$CODCOLIGADA'";
$result = mysqli_query($conexao, $query);
$dadosemail = mysqli_fetch_array($result);

$query2 = "SELECT * FROM gcoligada WHERE codcoligada = '$CODCOLIGADA'";
$result2 = mysqli_query($conexao, $query2);
$dadoscoligada = mysqli_fetch_array($result2);

$query3 = "SELECT * FROM PPESSOA WHERE ID='$ID' and codcoligada = '$CODCOLIGADA'";
$result3 = mysqli_query($conexao, $query3);
$dados_pes = mysqli_fetch_array($result3);

$usuario = $dados_pes['USUARIO']; 
$senha = $dados_pes['SENHA'];



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = $dadosemail['HOST'];//'smtp-mail.outlook.com'; // Set the SMTP server to send through
    $mail->SMTPAuth   = true;              // Enable SMTP authentication
    $mail->Username   = $dadosemail['EMAIL'];//'brendo_mark@hotmail.com'; // SMTP username
    $mail->Password   = $dadosemail['SENHA'];//'01000010B';     // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = $dadosemail['PORTA'];//587;             // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    

    //Recipients
    $mail->setFrom($dadosemail['EMAIL'], $dadoscoligada['NOMECOLIGADA']);
    
    $mail->addAddress($dados_pes['EMAIL']);

    $MENSAGEM = "<b>BEM-VINDO AO PORTAL DE ADMISSÃO WEB RH!</b><br>
        <p align=justify> Vamos começar seu processo de admissão,<br>
        Vamos lá?<p>
        Acesse o Link: https://qualityrhrio.com.br/admissao/index.php<br>
        Login: [LOGIN] <br>
        Senha: [SENHA]
        ";

    $MENSAGEM = STR_REPLACE('[LOGIN]',$usuario,$MENSAGEM);
    $MENSAGEM = STR_REPLACE('[SENHA]',$senha,$MENSAGEM);

    $ASSUNTO = 'Processo Admissional';

    // Content
    $mail->isHTML(true);                                  
    $mail->Subject = utf8_decode($ASSUNTO);
    $mail->Body    = utf8_decode($MENSAGEM) ;
    $mail->AltBody = utf8_decode(Strip_tags($MENSAGEM));

    $mail->send();
    $_SESSION['mensagem'] = 'Email enviado!';
    header('location: lista_user_rh.php');
    
} catch (Exception $e) {
    $_SESSION['mensagem'] = "Erro ao enviar o e-mail:  {$mail->ErrorInfo}";
    header('location: lista_user_rh.php');
}
?>
