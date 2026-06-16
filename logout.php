<?php

session_start();

// Remove todas as variáveis armazenadas na sessão
$_SESSION = [];

// Destrói a sessão atual
session_destroy();

// Redireciona o usuário para a página de login
header("Location: index.php");
exit;
?>