<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1>LOGIN</h1>

            <?php
            session_start();
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "nome_de_historia";

            // Conectar ao banco de dados
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
            }

            // Verificar se o formulário foi enviado
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Receber dados do formulário
                $email = $_POST['username'];
                $senha = $_POST['password'];

                // Verificar o tipo de usuário
                $tipo = $_POST['tipo'];

                // Consultar o banco de dados com base no tipo de usuário
                if ($tipo === 'professor') {
                    $sql = "SELECT * FROM professores WHERE email='$email'";
                } else {
                    $sql = "SELECT * FROM alunos WHERE email='$email'";
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    if (password_verify($senha, $user['senha'])) {
                        $_SESSION['nome'] = $user['nome'];
                        $_SESSION['tipo'] = $tipo;
                        // Login bem-sucedido, redireciona para a página desejada
                        header("Location: INDEX.php");
                        exit;
                    } else {
                        // Mensagem de erro
                        echo "<script>alert('Usuário ou senha incorretos.');</script>";
                    }
                } else {
                    // Mensagem de erro
                    echo "<script>alert('Usuário não encontrado.');</script>";
                }
            }

            $conn->close();
            ?>

            <form method="POST" action="">
                <label for="username">Email</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>

                <label for="tipo">Tipo:</label>
                <select name="tipo" id="tipo" required>
                    <option value="professor">Professor</option>
                    <option value="aluno">Aluno</option>
                </select>

                <button type="submit">Entrar</button>
                <div class="line"></div> <!-- Traço abaixo do botão "Entrar" -->
            </form>

            <!-- Botão Cadastre-se -->
            <p>Não tem uma conta? <button type="button" onclick="window.location.href='login_cadastro.php';">Cadastre-se</button></p>
            <div class="line"></div> <!-- Traço abaixo do botão "Cadastre-se" -->
        </div>
        <div class="image-box"></div>
    </div>
</body>
</html>
