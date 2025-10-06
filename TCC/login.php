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
            $_SESSION["tipo"] = $usuario['tipo'];   //ver com o toni de acordo com o Rafael precisa de concatenação
            header("Location: admin.php");
            exit();
        } else {
            $_SESSION["tipo"] = $usuario['tipo']; 
            header("Location: servicos.html");
            exit();
        }

    } else {
        echo "<script>alert('Email ou senha incorretos. Por favor, tente novamente.');</script>";
    }
}
?>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
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
       
        .login-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            
        }
        .btn:hover {
            background-color: #0057b3be;
        }
        .register-link {
            text-align: center;
            margin-top: 10px;
        }
    </style>

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
        <a href="index.php"  class="btn-voltar">Voltar</a>    
        <a href="cadastro.php">Cadastre-se</a>
    </div>
</div>
