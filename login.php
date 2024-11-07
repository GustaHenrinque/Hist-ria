<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "historia";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Deu certo!";

    
    $email = $_POST['username'];
    $senha = $_POST['password'];
    $tipo = $_POST['tipo'];

 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Email inválido.');</script>";
        exit;
    }

  
    $stmt = $conn->prepare("SELECT * FROM " . ($tipo === 'professor' ? 'professores' : 'alunos') . " WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    echo "Deu certo!";

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($senha, $user['senha'])) {
            $_SESSION['nome'] = $user['nome'];
            $_SESSION['tipo'] = $tipo;
            $_SESSION['autenticado'] = TRUE;
           
            header("Location: index.php");
            exit;
        } else {
           
            echo "<script>alert('Usuário ou senha incorretos.');</script>";
        }
    } else {
        
        echo "<script>alert('Usuário não encontrado.');</script>";
    }

    $stmt->close(); 
}

$conn->close();
?>

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
            <form method="post" action="">
                <label for="username">Email</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>

                <label for="tipo">Tipo:</label>
                <select name="tipo" id="tipo" required>
                    <option value="professor">Professor</option>
                    <option value="aluno">Aluno</option>
                </select> <br>
                <br>

                <button type="submit">Entrar</button>
            </form> <br>

   
            <p>Não tem uma conta?</p> <br>
            <button type="button" onclick="window.location.href='login_cadastro.php';">Cadastre-se</button>
        </div>
        <div class="image-box"></div>
    </div>
</body>
</html>
