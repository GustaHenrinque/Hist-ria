<?php
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Períodos Históricos</title>
    <link rel="stylesheet" href="css.css"> 
    <script src="js.js" defer></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                        <li><a href="../contemp/contemp.php">Idade Contemporânea</a></li>
                        <li><a href="glossario.php">Glossário Histórico</a></li>
                        <li><a href="dev.php">Devs</a></li>
                    </ul>
            <img src="./img/png.png" alt="Imagem da Idade Primitiva">
        </nav>

        <div class="menu-toggle" id="menuToggle">
            <span>☰</span>
        </div>

        <div class="login-area">
            <a href="login.php" class="btn-login">Login</a>
        </div>
    </div>
</header>

<section class="hero">
    <div class="overlay"></div>
    <div class="content">
        <h4>Aprenda mais sobre<br> Períodos <span class="highlight">HISTÓRICOS!</span></h4>
        <p>Explore o passado com a melhor comunidade<br> de história do país.</p>
        <a href="paginas/periodos.php" class="cta-button" id="saibaMaisBtn">SAIBA MAIS</a>

</section>


<script>
    document.getElementById('saibaMaisBtn').addEventListener('click', function(event) {
        event.preventDefault();  
        window.location.href = "periodos.php";  
    });
</script>

</body>
</html>
