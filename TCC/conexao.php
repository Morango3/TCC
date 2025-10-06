<?php
$servername = "localhost";  // geralmente localhost
$username = "root";  // seu usuário do banco
$password = "";    // sua senha do banco
$dbname = "tcc";      // nome do banco de dados
// Criar conexão
$conexao = new mysqli($servername, $username, $password, $dbname);
// Verificar conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}
?>