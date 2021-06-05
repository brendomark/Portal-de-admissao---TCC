<?php

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

$nivel_necessario = 1;

// Verifica se não há a variável da sessão que identifica o usuário
if ($_SESSION['nivelacesso'] == $nivel_necessario) {
    header("Location: painel.php"); exit;
} 


?>