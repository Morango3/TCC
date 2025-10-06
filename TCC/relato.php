<?php
include('conexao.php');
$sql1 = "SELECT * FROM categoria";
$resultado = mysqli_query($conexao, $sql1);


if(isset($_POST['botao'])){

   if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $titulo = htmlspecialchars($_POST['titulo']);
    $categoria = htmlspecialchars($_POST['tipo_problema']);
    $descricao = htmlspecialchars($_POST['descricao']);
    $imagem = htmlspecialchars($_POST['imagem']);
   
    echo "'$titulo', '$descricao', '$categoria', '$imagem'";

$sql2 = "INSERT INTO relato (titulo, descricao, categoria_idcategoria, imagem) VALUES ('$titulo', '$descricao', '$categoria', '$imagem')";

 if (mysqli_query($conexao, $sql2)) {
        echo "<script>alert('Relato enviado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao enviar relato: " . mysqli_error($conexao) . "');</script>";
    }
}
 }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Relatos</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 20px;
}

.btn-voltar {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: white;
    color: #1a73e8;
    padding: 10px 20px;
    border-radius: 4px;
    font-weight: 600;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.3s ease;
    border: 1px solid #1a73e8;
    cursor: pointer;
    margin-bottom: 20px;
}

.btn-voltar:hover {
    background-color: #f8f9fa;
}

.btn-voltar::before {
    content: "←";
    margin-right: 8px;
    font-size: 16px;
    line-height: 1;
}

.container {
    background-color: #ffffff;
    border-radius: 8px;
    padding: 30px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: auto;
}


h1 {
    text-align: center;
    color: #333;
    font-size: 24px;
    margin-bottom: 10px;
}

h2 {
    color: #0056b3;
    font-size: 18px;
    margin-bottom: 20px;
}

/* Labels */
label {
    display: block;
    margin: 15px 0 6px;
    font-weight: 700;
    color: #333;
    
}

/* Inputs, selects e textarea */
input[type="text"], input[type="file"], textarea{
    width: 96%;
     padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    
}
select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

input:focus,
textarea:focus,
select:focus {
    outline: none;
    border-color: #1a73e8;
    box-shadow: 0 0 0 2px rgba(26, 115, 232, 0.1);
}

#outra {
    margin-top: 10px;
}

.hidden {
    display: none;
}

.image-upload {
    border: 2px dashed #1a73e8;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    margin-bottom: 15px;
    border-radius: 4px;
    background-color: #f8f9fa;
}

.image-upload label {
    margin: 0;
    font-weight: 600;
    color: #555;
    cursor: pointer;
}

/* Botão enviar */
button {
    background-color: #0056b3;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    transition: background-color 0.3s ease;
    width: 100%;
    margin-top: 20px;
}

button:hover {
    background-color: #004494;
}

    </style>
</head>


<body>
     <a href="servicos.html"  class="btn-voltar">Voltar</a>
    
    <div class="container">
        <h1>Sistema de Relatos</h1>
        <h2>Novo Relato</h2>
        <form action="relato.php" method="POST">

                <label for="titulo">Título do Relato</label>
            <input type="text" id="titulo" name="titulo" placeholder="Ex: Torneira com vazamento no banheiro do 2° andar" required>
            
                <label for="tipo_problema">Tipo de Relato</label>
<!-- agenda -->
                <select id="tipo_problema" name="tipo_problema" required>


               <?php
                if (mysqli_num_rows($resultado) > 0) {
                      while ($linha = mysqli_fetch_assoc($resultado)) {
                         echo "<option value='".$linha['idcategoria']."'>".$linha['nomeCategoria']." </option>";
             }  }        
                else {
              echo "Nenhum contato encontrado.";
             }
                ?>
                
            </select>
            <input type="hidden" id="outra" class="hidden" placeholder="Digite o outro problema encontrado">
             <label for="descricao">Descrição do Relato</label>
            <input type="text" id="descricao" name="descricao" placeholder="Descreva o problema encontrado." required></input>


            <label for="imagem">Imagem</label>
            <div class="image-upload">
                 <input type="file" id="imagem" name="imagem" required>
                <label for="imagem">Clique para selecionar uma imagem</label>
            </div>

           
            
            <button type="submit" name= "botao">Enviar Relato</button>
        </form>
    </div>
</body>
<script>
    const meuSelect = document.getElementById('tipo_problema');
    const campoParaExibir = document.getElementById('outra');

    meuSelect.addEventListener('change', function() {
        if (this.value === '5') {
            // Mostra o campo
            campoParaExibir.style.display = 'block'; // Ou 'inline', 'flex', etc.
            // Ou muda o tipo para texto:
            campoParaExibir.type = 'text';
        } else {
            // Oculta o campo
            campoParaExibir.style.display = 'none';
            // Ou muda o tipo de volta para hidden:
            // campoParaExibir.type = 'hidden';
        }
    });
</script>
</html>
