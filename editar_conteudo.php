<?php
session_start();
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'professor') {
    header("Location: login.php"); // Redireciona caso não seja um professor
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nome_de_historia";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['conteudos'] as $id => $novoTexto) {
        $stmt = $conn->prepare("UPDATE conteudos SET texto = ? WHERE id = ?");
        $stmt->bind_param("si", $novoTexto, $id);
        $stmt->execute();
        $stmt->close();
    }
    echo "<script>alert('Conteúdo atualizado com sucesso!');</script>";
}

$result = $conn->query("SELECT * FROM conteudos");
$conteudos = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Conteúdo</title>
</head>
<body>
    <h1>Editar Conteúdo</h1>
    <form method="POST">
        <?php foreach ($conteudos as $conteudo): ?>
            <h2><?php echo htmlspecialchars($conteudo['titulo']); ?></h2>
            <textarea name="conteudos[<?php echo $conteudo['id']; ?>]" rows="10" cols="30"><?php echo htmlspecialchars($conteudo['texto']); ?></textarea>
        <?php endforeach; ?>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
