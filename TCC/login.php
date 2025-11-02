<?php /*
include('conexao.php');

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $email = htmlspecialchars($_POST['email']);
    $senha = htmlspecialchars($_POST['senha']);

$sql = "SELECT * FROM usuario WHERE email='$email' and senha='$senha'";

    $resultado = mysqli_query($conexao, $sql);
    if ($resultado) {
        if (mysqli_num_rows($resultado) > 0) {
            $usuario = mysqli_fetch_assoc($resultado);
            if ($usuario['tipo'] === 'adm') {
                 session_start();
                 $_SESSION["tipo"] = Olá admin;
                echo "<script>alert('Login realizado com sucesso! Bem-vindo, administrador.');</script>";
                header("Location: admin.php"); 
                exit();
            } else {
                 session_start();
                $_SESSION["tipo"] = Olá usuário;
               header("Location: servicos.html"); 
               exit();
            }
        } else {
            echo "<script>alert('Email ou senha incorretos. Por favor, tente novamente.');</script>";
        }
    } else {
        echo "Erro na consulta: " . mysqli_error($conexao);
    }
   }
*/
include('conexao.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    $sql = "SELECT * FROM usuario WHERE email='$email' AND senha='$senha'";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);

        if ($usuario['tipo'] === 'adm') {
            $_SESSION["tipo"] = $usuario['tipo']; 
            $_SESSION['idusuario'] = $usuario['idusuario'];
            $_SESSION['nome'] = $usuario['nome'];
            header("Location: admin.php");
            exit();
        } else {
            $_SESSION["tipo"] = $usuario['tipo']; 
            $_SESSION['idusuario'] = $usuario['idusuario'];
             $_SESSION['nome'] = $usuario['nome'];
            header("Location: servicos.php");
            exit();
        }

    } else {
        echo "<script>alert('Email ou senha incorretos. Por favor, tente novamente.');</script>";
    }
}
?> 

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title><link rel="stylesheet" type="text/css" href="style.css" media="screen" />
</head>
<body class="pagina-login">
    <a href="index.php"  class="btn-voltar">Voltar</a>  
<div class="login-container">
    <h1>LOGIN</h1>
    <form method="POST" action="">
        <div class="input-group">
            <label for="email">Email Institucional</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="input-group">
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>
        </div>
       <button type="submit" class="btn">ACESSAR</button>
    </form>
    <div class="register-link">
        <a href="cadastro.php">Cadastre-se</a>
    </div>
</div>
</body>
</html>
