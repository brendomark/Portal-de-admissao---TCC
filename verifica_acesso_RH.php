<?php

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

$nivel_necessario = 2;

// Verifica se não há a variável da sessão que identifica o usuário
if ($nivel_necessario == $_SESSION['nivelacesso'] ) {
    header("Location: painelrh.php"); exit;
} 


?>