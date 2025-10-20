<?php
// Inicia a sessão (OBRIGATÓRIO no topo de todo arquivo que usa $_SESSION)
session_start();

// Verificação de sessão corrigida (isset em minúsculo)
if (isset($_SESSION['tipo'])) {
    $mensagemUsuario = "Olá, " . $_SESSION['nome'] . ", você é um: " . $_SESSION['tipo'];
} else {
    $mensagemUsuario = ""; // Ou redirecione para login se necessário
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfraEduca - IFFAR São Borja</title>
    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    
</head>

<body>
    <?php if (!empty($mensagemUsuario)): ?>
        <p><?php echo $mensagemUsuario; ?></p> <!-- Mensagem de sessão no topo do body -->
    <?php endif; ?>

    <header>
        <div class="logo" role="banner" aria-label="InfraEduca logo and site title">
            <div aria-hidden="true">
                <img class="logo-icon" src="logo.jpg" alt="Logo InfraEduca" />
            </div>
            <div>
                <div>InfraEduca</div>
                <div class="logo-subtitle">IFFAR São Borja</div>
            </div>
        </div>

        <!-- Nav único para desktop (horizontal) -->
        <nav role="navigation" aria-label="Main navigation">
            <a href="sobre.html" tabindex="0">Sobre</a>
            <a href="servicos.php" tabindex="0">Serviços</a>
            <a href="login.php" class="btn-access" tabindex="0">Login</a> <!-- Usando btn-access para estilizar como botão -->
        </nav>

        <!-- Botão Hambúrguer (aparece só em mobile/zoom alto) -->
        <button class="menu-toggle" onclick="toggleMenu()" aria-label="Abrir menu de navegação">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- Menu Dropdown Mobile (mesmos links do nav, aparece ao clicar no hambúrguer) -->
        <div class="mobile-menu">
            <a href="sobre.html">Sobre</a>
            <a href="servicos.php">Serviços</a>
            <a href="login.php">Login</a>
        </div>
    </header>

    <main>
        <section class="hero" id="inicio" role="region" aria-label="Bem-vindo à InfraEduca">
            <div class="hero-content">
                <h1>Bem-Vindo à InfraEduca</h1>
                <p>Plataforma de Gerenciamento da Infraestrutura Educacional para o Instituto Federal Farroupilha Campus São Borja</p>
                <a href="servicos.php" class="btn-start">Vamos lá!</a>
            </div>
        </section>
    </main>

    <!-- JavaScript Completo (no final do body) -->
    <script>
        // Configurações (ajuste se necessário)
const ZOOM_THRESHOLD = 1.5; // Ativa modo mobile em zoom >= 150% (1.5x)
const MOBILE_WIDTH = 480; // Largura <= 480px para modo mobile

// Nova Função: Calcula altura real do header e define variável CSS --header-height
function updateHeaderHeight() {
    const header = document.querySelector('header');
    if (header) {
        const headerHeight = header.offsetHeight; // Altura real (inclui padding, bordas)
        document.documentElement.style.setProperty('--header-height', headerHeight + 'px');
        
        // Opcional: Log para debug (remova em produção)
        console.log('Altura do header calculada:', headerHeight + 'px');
    } else {
        console.warn('Header não encontrado para calcular altura!');
    }
}

// Função para detectar zoom, largura e aplicar modo mobile (agora chama updateHeaderHeight)
function checkZoomAndApplyMode() {
    const zoomLevel = window.devicePixelRatio || 1; // Detecta zoom
    const currentWidth = window.innerWidth; // Largura atual da viewport
    const body = document.body;
    
    // Ativa modo mobile se zoom alto OU tela pequena
    const shouldBeMobile = (zoomLevel >= ZOOM_THRESHOLD) || (currentWidth <= MOBILE_WIDTH);
    
    if (shouldBeMobile) {
        body.classList.add('mobile-mode');
    } else {
        body.classList.remove('mobile-mode');
    }
    
    // Opcional: Log no console para debug (remova em produção)
    console.log('Zoom detectado:', Math.round(zoomLevel * 100) + '%', 
                'Largura:', currentWidth + 'px', 
                'Modo mobile ativo:', shouldBeMobile);
}

// Função principal para abrir/fechar o menu mobile (chamada via onclick no botão)
function toggleMenu() {
    const toggle = document.querySelector('.menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');
    if (toggle && mobileMenu) {
        toggle.classList.toggle('active');
        mobileMenu.classList.toggle('active');
    } else {
        console.warn('Elementos .menu-toggle ou .mobile-menu não encontrados!');
    }
}

// Inicialização e event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Inicializa altura do header e detecção de zoom/largura
    updateHeaderHeight(); // Calcula altura inicial
    checkZoomAndApplyMode(); // Aplica modo mobile inicial
    
    // Monitora mudanças de zoom/resize (dispara a cada redimensionamento ou zoom)
    let lastWidth = window.innerWidth;
    window.addEventListener('resize', function() {
        const currentWidth = window.innerWidth;
        // Recalcula altura do header em qualquer mudança (zoom ou resize)
        updateHeaderHeight();
        
        // Se a largura não mudou, provavelmente é zoom
        if (currentWidth === lastWidth) {
            checkZoomAndApplyMode();
        } else {
            // Se mudou largura, verifica tudo
            checkZoomAndApplyMode();
            lastWidth = currentWidth;
        }
    });
    
    // Fechar o menu ao clicar em um link no mobile-menu (melhor UX)
    const mobileLinks = document.querySelectorAll('.mobile-menu a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', function() {
            const toggle = document.querySelector('.menu-toggle');
            const mobileMenu = document.querySelector('.mobile-menu');
            if (toggle && mobileMenu) {
                toggle.classList.remove('active');
                mobileMenu.classList.remove('active');
            }
        });
    });
    
    // Opcional: Fechar menu ao clicar fora dele (em qualquer lugar da página)
    document.addEventListener('click', function(event) {
        const toggle = document.querySelector('.menu-toggle');
        const mobileMenu = document.querySelector('.mobile-menu');
        const isClickInsideMenu = mobileMenu && mobileMenu.contains(event.target) || toggle && toggle.contains(event.target);
        
        if (!isClickInsideMenu && mobileMenu && mobileMenu.classList.contains('active')) {
            toggle.classList.remove('active');
            mobileMenu.classList.remove('active');
        }
    });
});
    </script>
</body>
</html>