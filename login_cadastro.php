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


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senha_confirmacao = $_POST['senha_confirmacao'];

    $tipo = $_POST['tipo'];  // Removido 'm' extra aqui

    $tipo = $_POST['tipo'];


    if ($senha !== $senha_confirmacao) {
        echo "<script>alert('As senhas não coincidem.');</script>";
    } else {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        if ($tipo === 'professor') {
            $sql = "INSERT INTO professores (nome, email, senha) VALUES ('$nome', '$email', '$senha_hash')";
        } else {
            $sql = "INSERT INTO alunos (nome, email, senha) VALUES ('$nome', '$email', '$senha_hash')";
        }

        if ($conn->query($sql) === TRUE) {

            echo "<script>alert('Cadastro realizado com sucesso!');</script>";
            header("Location: login.php");

            $_SESSION['cadastro_sucesso'] = true;
            header("Location: login.php");
            exit;

        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="cadastro.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro</h1>
        <form method="POST" action="login_cadastro.php">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <label for="senha_confirmacao">Confirme a Senha:</label>
            <input type="password" id="senha_confirmacao" name="senha_confirmacao" required>
            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo" required>
                <option value="professor">Professor</option>
                <option value="aluno">Aluno</option>
            </select>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
