<?php
// Inicia a sessão no topo de todos os scripts que usam sessões
session_start();

// Verifica se a variável de sessão para o usuário não está definida
if (!isset($_SESSION['idusuario']) || !isset($_SESSION['nome'])) {
    // Se o usuário não estiver logado, redireciona para a página de login
    header('Location: login.php');
    exit; // Garante que o script pare de executar após o redirecionamento
}
    header('Location: servicos.php');


?>