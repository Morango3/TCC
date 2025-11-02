<?php
date_default_timezone_set('America/Sao_Paulo');  // Mesmo timezone
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idrelato'])) {
    $idrelato = intval($_POST['idrelato']);
    
    // Query ajustada (assumindo tabela 'usuario' como antes)
    $sql = "SELECT m.comentarios, m.data_hora, u.nome FROM movimentacao m JOIN usuario u ON m.usuario_idusuarios = u.idusuario WHERE m.relato_idrelatos = ? ORDER BY m.data_hora ASC";
    
    $stmt = $conexao->prepare($sql);
    if (!$stmt) {
        echo "Erro na preparação da query: " . $conexao->error;
        exit;
    }
    
    $stmt->bind_param("i", $idrelato);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Formate a data: de "Y-m-d H:i:s" para "d/m/Y H:i"
            $data_formatada = date('d/m/Y H:i', strtotime($row['data_hora']));
            echo "<p><strong>" . htmlspecialchars($row['nome']) . " ({$data_formatada}):</strong> " . htmlspecialchars($row['comentarios']) . "</p>";
        }
    } else {
        echo "<p>Nenhum comentário encontrado.</p>";
    }
    $stmt->close();
} else {
    echo "Requisição inválida.";
}

$conexao->close();
?>