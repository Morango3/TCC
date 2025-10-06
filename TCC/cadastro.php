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
    <style>
        * {
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        
        .cadastro-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        
        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 25px;
            color: #333;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 700;
            color: #333;
            
        }
        
        input[type="text"], 
        input[type="email"], 
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        
        input[type="text"]:focus, 
        input[type="email"]:focus, 
        input[type="password"]:focus {
            outline: none;
            border-color: #1a73e8;
            box-shadow: 0 0 0 2px rgba(26, 115, 232, 0.1);
        }
        
        .tipo_usuario {
            margin-top: 8px;
        }
        
        .tipo_usuario input[type="radio"] {
            margin-right: 8px;
            margin-bottom: 8px;
        }
        
        .tipo_usuario label {
            display: inline;
            margin-bottom: 0;
            font-weight: normal;
            cursor: pointer;
        }
        
        .radio-option {
            margin-bottom: 8px;
        }
        
        #campos_aluno {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #e0e0e0;
            margin-top: 10px;
        }
        
        #campos_aluno .form-group {
            margin-bottom: 15px;
        }
        
        #campos_aluno .form-group:last-child {
            margin-bottom: 0;
        }
        
        .botoes {
            display: flex;
            gap: 12px;
            margin-top: 25px;
        }
        
        .btn-voltar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            color: #1a73e8;
            padding: 12px 20px;
            border-radius: 4px;
            font-weight: 600;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
            border: 1px solid #1a73e8;
            cursor: pointer;
            flex: 1;
        }
        
        .btn-voltar:hover {
            background-color: #f8f9fa;
        }
        
        .btn-voltar::before {
            content: "←";
            margin-right: 6px;
            font-size: 16px;
        }
        
        button {
            flex: 1;
            padding: 12px 20px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        
        button:hover {
            background-color: #004494;
        }
    </style>

    
</head>
<body>
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
                <a href="login.php" class="btn-voltar">Voltar</a>
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