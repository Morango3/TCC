<?php
include('conexao.php');
 if(isset($_POST['botao'])){

   if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tipo_usuario = htmlspecialchars($_POST['tipo_usuario']);
    $nome = htmlspecialchars($_POST['nome']);
    $curso = htmlspecialchars($_POST['curso']);
    $ano = htmlspecialchars($_POST['ano']);
    $email = htmlspecialchars($_POST['email']);
    $senha = htmlspecialchars($_POST['senha']);
   }

$sql = "INSERT INTO usuario (tipo, nome, curso, ano, email, senha) VALUES ('$tipo_usuario', '$nome', '$curso', '$ano', '$email', '$senha')";

 if (mysqli_query($conexao, $sql)) {
        echo "<script>alert('Cadastro realizado com sucesso!');</script>";
        // Redirecionar para login ou outra página
        echo "<script>window.location.href = 'login.php';</script>";
        exit;
    } else {
        echo "<script>alert('Erro ao cadastrar: " . mysqli_error($conexao) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
 <link rel="stylesheet" type="text/css" href="style.css" media="screen" />  
</head>

<body class="pagina-cadastro">
    <a href="login.php" class="btn-voltar">Voltar</a>
    <div class="cadastro-container">
        <h1>CADASTRE-SE</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nome">Nome completo</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            
            <div class="form-group">
                <label for="tipo_usuario">Tipo de Usuário</label>
                <div class="tipo_usuario">
                    <div class="radio-option">
                        <input type="radio" id="professor" name="tipo_usuario" value="professor" required> 
                        <label for="professor">Professor</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="aluno" name="tipo_usuario" value="aluno"> 
                        <label for="aluno">Aluno</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="servidor" name="tipo_usuario" value="servidor">
                        <label for="servidor">Servidor</label>
                    </div>
                </div>
            </div>
            
            <div id="campos_aluno" style="display:none;">
                <div class="form-group">
                    <label for="curso">Curso</label> 
                    <input type="text" id="curso" name="curso" placeholder="Ex: Técnico Informática">
                </div>
                <div class="form-group">
                    <label for="ano">Ano</label>
                    <input type="text" id="ano" name="ano" placeholder="Ex: 3º">
                </div>
            </div>
            
            <div class="form-group">
                <label for="email">Email Institucional</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            
            <div class="botoes">
                <button type="submit" name="botao">CADASTRAR</button>
            </div>
        </form>
    </div>

    <script>
        const radios = document.querySelectorAll('input[name="tipo_usuario"]');
        const camposAluno = document.getElementById('campos_aluno');
        
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'aluno') {
                    camposAluno.style.display = 'block';
                } else {
                    camposAluno.style.display = 'none';
                }
            });
        });
    </script>
    </body>
</html>