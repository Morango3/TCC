<?php
date_default_timezone_set('America/Sao_Paulo');  // Ajuste o timezone
include('conexao.php');
session_start();

if (!isset($_SESSION['idusuario'])) {
    die("Acesso negado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idusuario = isset($_POST['iduser']) ? intval($_POST['iduser']) : null;
    $idrelato = isset($_POST['userId']) ? intval($_POST['userId']) : null;
    $comentario = isset($_POST['coment']) ? trim($_POST['coment']) : null;

    if (!$idusuario || !$idrelato || !$comentario) {
        $_SESSION['erro'] = "Dados incompletos.";
        header('Location: admin.php');
        exit;
    }

    $sql = "INSERT INTO movimentacao (usuario_idusuarios, relato_idrelatos, data_hora, comentarios) VALUES (?, ?, NOW(), ?)";
    $stmt = $conexao->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("iis", $idusuario, $idrelato, $comentario);
        if ($stmt->execute()) {
            $_SESSION['sucesso'] = "Comentário salvo com sucesso!";
            header('Location: admin.php');
            exit;
        } else {
            $_SESSION['erro'] = "Erro ao salvar comentário: " . $stmt->error;
            header('Location: admin.php');
            exit;
        }
        $stmt->close();
    } else {
        $_SESSION['erro'] = "Erro na preparação da query: " . $conexao->error;
        header('Location: admin.php');
        exit;
    }
} else {
    $_SESSION['erro'] = "Método inválido.";
    header('Location: admin.php');
    exit;
}

$conexao->close();
?>