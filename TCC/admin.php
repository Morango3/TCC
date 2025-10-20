<?php
include('conexao.php');
session_start();

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve users data
$sql = "SELECT r.titulo, r.descricao, r.status, r.prioridade, r.imagem, c.nomeCategoria FROM `relato` as r join  categoria as c WHERE r.categoria_idcategoria=c.idcategoria ";

// Execute the query
$result = $conn->query($sql);

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
</head>
<body>
    <?php if ($result->num_rows > 0): ?>
    <table>
        <tr>
            <th>Imagem</th>
            <th>Título</th>
            <th>Descrição</th>
            <th>Categoria</th>
            <th>Status</th>
            <th>Prioridade</th>
            
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo "<img src='imagens/".$row["imagem"]."'>"; ?></td>                
                <td><?php echo $row["titulo"]; ?></td>
                <td><?php echo $row["descricao"]; ?></td>
                <td><?php echo $row["nomeCategoria"]; ?></td>
                <td><?php echo $row["status"]; ?></td>
                <td><?php echo $row["prioridade"]; ?></td>
               
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No users found.</p>
<?php endif; 
?>
</body>
</html>