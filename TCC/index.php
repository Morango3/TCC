
<?php

if(ISSET($_SESSION['tipo'])){
  echo "Olá, você é um" . $_SESSION['tipo'];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>InfraEduca - IFFAR São Borja</title>
  <style>
    
    body, html {
      margin: 0;
      padding: 0;
      font-family: Arial, Helvetica, sans-serif;
      color: white;
      background-color: #0b2046;
      height: 100vh;
      overflow-x: hidden;
    }
    a {
      text-decoration: none;
      color: inherit;
      cursor: pointer;
    }
    /* Header */
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      background: white;
      color: #0b2046;
      box-sizing: border-box;
      font-weight: 500;
      font-size: 14px;
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 100;
      box-shadow: 0 1px 5px rgba(0,0,0,0.1);
    }
    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 700;
      font-size: 18px;
      color: #0b2046;
    }
    .logo-icon {
      background-color: #0b2046;
      color: white;
      padding: 10px;
      border-radius: 50px;
      font-weight: bold;
      font-size: 20px;
      user-select: none;
      line-height: 1;
      width:50px;
      height:50px;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: "Arial Black", Arial, sans-serif;
    }
    .logo-subtitle {
      font-size: 10px;
      color: #666666;
      font-weight: 400;
      letter-spacing: 0.03em;
      margin-top: 2px;
    }
    /* Navigation Menu */
    nav {
      display: flex;
      gap: 25px;
      font-weight: 600;
      font-size: 15px;
      color: #222222;
    }
    nav a {
      color: #222222;
      transition: color 0.25s ease;
    }
    nav a:hover {
      color: #0b2046;
    }
    /* Access button */
    .btn-access {
      background-color: #0b2046;
      color: white;
      border: none;
      border-radius: 6px;
      padding: 10px 20px;
      font-weight: 700;
      font-size: 14px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .btn-access:hover {
      background-color: #142e70;
    }
    /* Hero section */
    .hero {
      background: url("pagina1.jpg") no-repeat center center/cover;
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 0 20px;
      box-sizing: border-box;
      position: relative;
    }
    .hero::before {
      content: "";
      position: absolute;
      inset: 0;
      background-color: rgba(11, 32, 70, 0.75);
      z-index: 0;
    }
    .hero-content {
      position: relative;
      z-index: 1;
      max-width: 800px;
      color: white;
    }
    .hero h1 {
      font-size: 3rem;
      margin: 0 0 15px;
      font-weight: 900;
      line-height: 1.1;
    }
    .hero p {
      font-size: 1.25rem;
      margin: 0 0 30px;
      line-height: 1.4;
      font-weight: 400;
    }
    .btn-start {
      background-color: white;
      color: #0b2046;
      font-weight: 700;
      font-size: 1.1rem;
      text-transform: uppercase;
      border: none;
      padding: 14px 50px;
      border-radius: 50px;
      cursor: pointer;
      transition: background-color 0.25s ease, color 0.25s ease;
    }
    .btn-start:hover {
      background-color: #e6e6e6;
    }
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2rem;
      }
      .hero p {
        font-size: 1rem;
      }
      nav {
        gap: 15px;
        font-size: 13px;
      }
      .btn-access {
        padding: 8px 16px;
        font-size: 13px;
      }
      .btn-start {
        padding: 12px 40px;
        font-size: 1rem;
      }
    }
    @media (max-width: 480px) {
      header {
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        padding: 10px 15px;
      }
      nav {
        order: 2;
        width: 100%;
        justify-content: center;
      }
      .btn-access {
        order: 3;
      }
      .logo {
        flex: 1 1 100%;
        justify-content: center;
      }
    }
  </style>

</head>

<body>
 
  <header>
    
    <div class="logo" role="banner" aria-label="InfraEduca logo and site title">
   <div aria-hidden="true">
  <img class="logo-icon" src="logo.jpg" alt="Logo InfraEduca" />
</div>


      <div>
        InfraEduca
        <div class="logo-subtitle">IFFAR São Borja</div>
      </div>
    </div>
    <nav role="navigation" aria-label="Main navigation">
      <a href="sobre.html" tabindex="0">Sobre</a>
      <a href="servicos.html" tabindex="0">Serviços</a>
      <a href="login.php" class="button">Login</a>
    </nav>

  </header>

  <main>
    <section class="hero" id="inicio" role="region" aria-label="Bem-vindo à InfraEduca">
      <div class="hero-content">
        <h1>Bem-Vindo à InfraEduca</h1>
        <p>Plataforma de Gerenciamento da Infraestrutura Educacional para o Instituto Federal Farroupilha Campus São Borja</p>
         <a href="servicos.html" class="btn-start">Vamos lá!</a>
      </div>
    </section>
  </main>

</body>
</html>


