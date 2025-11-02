<?php
include('conexao.php');
session_start();
$idusuario = $_SESSION['idusuario'];
$nomeusuario = $_SESSION['nome'];
echo "Olá, $nomeusuario.(<a href='logout.php'>Sair</a>)";
$data_hora = date('Y-m-d H:i:s');

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve users data
$sql = "SELECT r.idrelato, r.titulo, r.descricao, r.status, r.prioridade, r.imagem, c.nomeCategoria FROM `relato` as r JOIN categoria as c ON r.categoria_idcategoria = c.idcategoria";

// Execute the query
$result = $conn->query($sql);

// Função para buscar comentários de um relato (usada no modal)
function getComentarios($conn, $idrelato) {
    $sql_coment = "SELECT m.comentarios, m.data_hora, u.nome FROM movimentacao m JOIN usuarios u ON m.usuario_idusuarios = u.idusuarios WHERE m.relato_idrelatos = ? ORDER BY m.data_hora ASC";
    $stmt = $conn->prepare($sql_coment);
    $stmt->bind_param("i", $idrelato);
    $stmt->execute();
    return $stmt->get_result();
}

// Feedback de sucesso/erro
if (isset($_SESSION['sucesso'])) {
    echo "<div class='alert alert-success'>{$_SESSION['sucesso']}</div>";
    unset($_SESSION['sucesso']);
}
if (isset($_SESSION['erro'])) {
    echo "<div class='alert alert-danger'>{$_SESSION['erro']}</div>";
    unset($_SESSION['erro']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
</head>
<body>
    <?php if ($result->num_rows > 0): ?>
    <table class="table">
        <tr>
            <th>Imagem</th>
            <th>Título</th>
            <th>Descrição</th>
            <th>Categoria</th>
            <th>Status</th>
            <th>Prioridade</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <form action="atualizar_relato.php" method="POST">
                <tr>
                    <td><?php echo "<img src='imagens/".$row["imagem"]."' width='100'>"; ?></td>                
                    <td><?php echo htmlspecialchars($row["titulo"]); ?></td>
                    <td><?php echo htmlspecialchars($row["descricao"]); ?></td>
                    <td><?php echo htmlspecialchars($row["nomeCategoria"]); ?></td>
                    <td>
                        <select name="status">
                            <?php
                            $status_options = ['Pendente', 'Em andamento', 'Concluído'];
                            foreach ($status_options as $option) {
                                $selected = ($row['status'] == $option) ? 'selected' : '';
                                echo "<option value=\"$option\" $selected>$option</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name="prioridade">
                            <?php
                            $prioridades = ['5', '4', '3', '2', '1'];
                            foreach ($prioridades as $p) {
                                $selected = ($row['prioridade'] == $p) ? 'selected' : '';
                                echo "<option value=\"$p\" $selected>$p</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $row['idrelato']; ?>">
                        <input type="submit" value="Salvar" class="btn btn-primary">
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-id="<?php echo $row['idrelato']; ?>"><img src='balao.jpg' width='35' height='35'></button>
                    </td>
                </tr>
            </form>
        <?php endwhile; ?>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"> 
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Comentários</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Lista de comentários existentes (carregada dinamicamente via JS ou aqui) -->
                    <div id="comentarios-lista">
                        <!-- Comentários serão carregados aqui via AJAX ou PHP -->
                    </div>
                    <hr>
                    <form action="comentarios.php" method="POST">
                        <div class="input-group">
                            <input type="hidden" name="iduser" value="<?php echo $idusuario; ?>">
                            <input type="hidden" name="userId" id="userId">
                            <textarea name="coment" class="form-control" aria-label="With textarea" placeholder="Adicione um comentário..."></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; 
    // Close the connection
    $conn->close();
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <script>
    $('#exampleModal').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('bs-id');
        $(this).find('#userId').val(id);
        
        // Carrega comentários via AJAX (exemplo simples; ajuste para seu endpoint)
        $.ajax({
            url: 'get_comentarios.php',  // Crie este arquivo para buscar comentários
            type: 'POST',
            data: { idrelato: id },
            success: function(data) {
                $('#comentarios-lista').html(data);
            }
        });
    });
    </script>
</body>
</html>