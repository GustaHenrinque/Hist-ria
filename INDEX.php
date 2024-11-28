<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
$logado = isset($_SESSION['autenticado']) && $_SESSION['autenticado'] === true;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Períodos Históricos</title>
    <link rel="stylesheet" href="css.css"> 
    <script src="js.js" defer></script> 
    <script src="script.js" defer></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 CDN -->
</head>
<body>
<header>    
    <div class="container">
        <nav class="sidebar" id="sidebar">
            <ul>
                <li><a href="INDEX.php">Início</a></li>
                <li><a href="periodos.php">Períodos</a></li>
                <li><a href="pre-historia.php">História Primitiva</a></li>
                <li><a href="antiga.php">História Antiga</a></li>
                <li><a href="media.php">Idade Média</a></li>
                <li><a href="moderna.php">Idade Moderna</a></li>
                <li><a href="contempo.php">Idade Contemporânea</a></li>
                <li><a href="glossario.php">Glossário Histórico</a></li>
            </ul>
            <img src="./img/logo-hist.jpeg" alt="Imagem da Idade Primitiva">
        </nav>

        <div class="menu-toggle" id="menuToggle">
            <span>☰</span>
        </div>

        <div class="login-area">
            <?php if (!$logado): ?>
                <!-- Exibe o botão "Entrar" se o usuário não estiver logado -->
                <a href="login.php" class="btn-login">Entrar</a>
            <?php else: ?>
                <!-- Exibe o botão "Sair" se o usuário estiver logado -->
                <a href="#" id="btnSair" class="btn-login">Sair</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<section class="hero">
    <div class="overlay"></div>
    <div class="content">
        <h4>Aprenda mais sobre<br> Períodos <span class="highlight">HISTÓRICOS!</span></h4>
        <p>Explore o passado com a melhor comunidade<br> de história do país.</p>

        <a href="periodos.php" class="cta-button" id="saibaMaisBtn">SAIBA MAIS</a>
    </div>
</section>

<script>
    // Alterna o menu de navegação ao clicar no ícone ☰
    document.getElementById('menuToggle').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('active'); // Adiciona/Remove a classe 'active'
    });

    // Verifica se o botão "Sair" foi clicado
    document.getElementById('btnSair')?.addEventListener('click', function(event) {
        event.preventDefault(); // Impede o link de ser acionado imediatamente

        // Exibe o SweetAlert perguntando se o usuário tem certeza
        Swal.fire({
            title: 'Você tem certeza?',
            text: "Você deseja realmente sair da sua conta?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, sair!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                // Se o usuário clicar em "Sim", redireciona para logout.php
                window.location.href = 'logout.php';
            }
        });
    });
</script>

</body>
</html>
