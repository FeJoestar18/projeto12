<?php
include("conexao.php");
session_start(); // Inicie a sessão

// Verifique se a variável de sessão 'email' está definida
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirecione para a página de login
    exit();
}
?>
