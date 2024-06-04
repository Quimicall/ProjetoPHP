<?php
// criar_usuario.php

include 'conexao2.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $sit = $_POST['sit'];
    $senha = $_POST['senha'];

    // Hash da senha antes de salvar no banco de dados
    $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

    try {
        $sql = "INSERT INTO usuarios (nome, email, sit, senha) VALUES (:nome, :email, :sit, :senha)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaHash);
        $stmt->bindParam(':sit', $sit);
        $stmt->execute();

        echo "<div class='alert alert-success' role='alert'>Usuário criado com sucesso!</div>";
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger' role='alert'>Erro ao criar usuário: " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Usuário</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Criar Usuário</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <div class="form-group">
                <label for="sit">Situação</label>
                <input type="text" class="form-control" id="sit" name="sit" required>
            </div>
            <button type="submit" class="btn btn-success">Criar</button>
        </form>
        <a href="index.php?pg=clientes" class="btn btn-secondary mt-3">Voltar à Lista de Usuários</a>
    </div>
    <!-- Bootstrap JS e dependências -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
