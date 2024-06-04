<?php
// editar_usuario.php

include 'conexao2.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$nome = '';
$email = '';
$sit = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $sit = $_POST['sit'];

    try {
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, sit = :sit WHERE idusuario = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':sit', $sit);
        $stmt->execute();

        echo "<div class='alert alert-success' role='alert'>Usuário atualizado com sucesso!</div>";
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger' role='alert'>Erro ao atualizar usuário: " . $e->getMessage() . "</div>";
    }
} else {
    // Obter os dados do usuário para preencher o formulário
    try {
        $sql = "SELECT idusuario, nome, email, sit FROM usuarios WHERE idusuario = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $nome = $user['nome'];
            $email = $user['email'];
            $sit = $user['sit'];
        } else {
            echo "<div class='alert alert-warning' role='alert'>Usuário não encontrado</div>";
            exit;
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger' role='alert'>Erro ao obter dados do usuário: " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Editar Usuário</h1>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label for="sit">Situação</label>
                <input type="text" class="form-control" id="sit" name="sit" value="<?php echo htmlspecialchars($sit); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
        <a href="index.php?pg=clientes" class="btn btn-secondary mt-3">Voltar à Lista de Usuários</a>
    </div>
    <!-- Bootstrap JS e dependências -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

