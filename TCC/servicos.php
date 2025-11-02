<?php
session_start();
$id_usuario= $_SESSION['idusuario'];
$nomeusuario= $_SESSION['nome'];
echo "Olá, $nomeusuario.(<a href='logout.php'>Sair</a>)";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recursos do Sistema</title>
   <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
 </head>   
 <body class="pagina-servicos">
     <a href="index.php"  class="btn-voltar">Voltar</a>

   <div class="container">

        <section class="servi">
            <h1>Serviços</h1>
            <h2 class= "solu">Soluções para o gerenciamento eficiente da infraestrutura educacional</h2>
        </section>

          <div class="opcao">
            <div class="opcao-card">
                <div class="opcao-image">
                    <img src="image.png" alt="" />
                </div>
                <div class="opcao-content">
                    <h3>Faça seu relato</h3>
                    <p>Resgistre aqui seu problema relacionada a infraestrutura</p>
                    <a href="relato.php" class="btn-saiba-mais">Registrar</a>
                </div>
            </div>
            
            <div class="opcao-card">
                <div class="opcao-image">
                    <img src="image (1).png" alt="" />
                </div>
                <div class="opcao-content">
                    <h3>Acompanhar relatos</h3>
                    <p>Acompanhe o andamento e as soluções dos relatos enviados</p>
                    <a href="#" class="btn-saiba-mais">Acompanhar</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
