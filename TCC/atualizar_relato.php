<?php
include('conexao.php');

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}

$id = $_POST['id'];
$status = $_POST['status'];
$prioridade = $_POST['prioridade'];

// Use prepared statements para segurança
$stmt = $conn->prepare("UPDATE relato SET status = ?, prioridade = ? WHERE idrelato = ?");
$stmt->bind_param("ssi", $status, $prioridade, $id);
$stmt->execute();

$stmt->close();
$conn->close();

// Alert de sucesso e redirecionamento
echo "<script>alert('Atualizado com sucesso!'); window.location.href='admin.php';</script>";
exit;
?>