<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Período da Idade Média</title>
    <link rel="stylesheet" href="todamateria.css">
    <script src="js.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@400&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div class="barra">
        <nav class="sidebar" id="sidebar">
            <ul>
                <li><a href="INDEX.php">Início</a></li>
                <li><a href="pre-historia.php">História Primitiva</a></li>
                <li><a href="antiga.php">História Antiga</a></li>
                <li><a href="media.php">Idade Média</a></li>
                <li><a href="moderna.php">Idade Moderna</a></li>
                <li><a href="contempo.php">Idade Contemporânea</a></li>
                <li><a href="glossario.php">Glossário Histórico</a></li>
                <li><a href="dev.php">Devs</a></li>
            </ul>
        </nav>
        <div class="menu-toggle" id="menuToggle">
            <span>☰</span>
        </div>
    </div>
</header>

<div class="container">
    <section class="header">
        <h1>Idade Média</h1>
        <p class="subtitle">A Idade Média, ou "Era das Trevas", foi um período entre a queda do Império Romano e o início da Idade Moderna, marcado pelo sistema feudal, influência da Igreja e importantes eventos históricos.</p>
    </section>

    <!-- Botão de Audiobook -->
    <button onclick="iniciarAudiobook()">Ativar Audiobook</button>

    <section class="section idade-media">
        <h3>Características da Idade Média</h3>
        <div class="content">
            <div class="text">
                <p>A Idade Média se estendeu do século V ao XV e foi marcada por grande instabilidade política e econômica, com uma organização social centrada no feudalismo...</p>
                <!-- Continue o conteúdo conforme necessário -->
            </div>
            <div class="image">
                <img src="img/castelo medieval.png" alt="Castelo Medieval">
                <p class="caption">Castelo medieval, símbolo da estrutura feudal e do poder na Idade Média.</p>
            </div>
        </div>
    </section>
</div>

<!-- Script para o Audiobook -->
<script>
function iniciarAudiobook() {
    // Verifica se a API Speech Synthesis está disponível
    if ('speechSynthesis' in window) {
        const texto = document.body.innerText;
        const speech = new SpeechSynthesisUtterance(texto);
        speech.lang = 'pt-BR';
        speech.rate = 1; // Ajusta a velocidade da leitura

        // Cancela qualquer leitura em andamento e inicia imediatamente
        window.speechSynthesis.cancel();
        window.speechSynthesis.speak(speech);
    } else {
        alert("Seu navegador não suporta o recurso de audiobook.");
    }
}
</script>
</body>
</html>
