<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipe de Desenvolvedores</title>
    <link rel="stylesheet" href="dev.css">
    <script src="js.js" defer></script>
</head>
<body>
    <header>
        <div class="container">
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
    <section class="team-section">
        <h1>Equipe de <span>Desenvolvedores</span></h1>

        <div class="team-container">
            <div class="developer" onclick="showInfo('dev1')">
                <img src="./img/gustavo.JPG" alt="Desenvolvedor 1">
                <h3>Gustavo Martins</h3>
            </div>
            <div class="developer" onclick="showInfo('dev2')">
                <img src="./img/kaua.JPG" alt="Desenvolvedor 2">
                <h3>Kauã Souza</h3>
            </div>
            <div class="developer" onclick="showInfo('dev3')">
                <img src="./img/matheus.JPG" alt="Desenvolvedor 3">
                <h3>Matheus Villar</h3>
            </div>
            <div class="developer" onclick="showInfo('dev4')">
                <img src="./img/eu.JPG" alt="Desenvolvedor 4">
                <h3>Pedro Zocatelli</h3>
            </div>
            <div class="developer" onclick="showInfo('dev5')">
                <img src="./img/rian.JPG" alt="Desenvolvedor 5">
                <h3>Rian Prado</h3>
            </div>
        </div>
    </section>
    
    <footer>
        <p>&copy;2024 <a href="https://www.sesisp.org.br/ca%C3%A7apava" target="_blank">SESI CAÇAPAVA</a> & <a href="https://www.sp.senai.br/taubate" target="_blank">SENAI TAUBATÉ</a></p>
        <div class="footer-links">
            <a href="https://www.seusite.com/termos-de-uso" target="_blank">Termos de Uso</a>
            <a href="https://www.seusite.com/politica-de-privacidade" target="_blank">Política de Privacidade</a>
            <a href="https://www.seusite.com/ajuda" target="_blank">Ajuda</a>
            <a href="https://www.seusite.com/faq" target="_blank">FAQ</a>
        </div>
    </footer>
    
    

    <script src="script.js"></script>
</body>
</html>