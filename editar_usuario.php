<?php
require_once "conexao2.php"; // Inclui a conexão com o banco de dados

// Verifica se o ID do usuário foi fornecido na URL
if (isset($_GET['idusuario'])) {
    $idusuario = intval($_GET['idusuario']);

    // Busca os dados do usuário no banco de dados
    $query = "SELECT * FROM usuarios WHERE idusuario = :idusuario";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário foi encontrado
    if (!$usuario) {
        echo "<script>alert('Usuário não encontrado.'); window.location.href = 'gerenciar_usuarios.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID do usuário não fornecido.'); window.location.href = 'gerenciar_usuarios.php';</script>";
    exit();
}

// Processa o formulário de edição
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $sit = $_POST['sit'];

    // Atualiza os dados do usuário no banco de dados
    $query = "UPDATE usuarios SET nome = :nome, email = :email, sit = :sit WHERE idusuario = :idusuario";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':sit', $sit, PDO::PARAM_INT);
    $stmt->bindParam(':idusuario', $idusuario, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script>alert('Usuário atualizado com sucesso.'); window.location.href = 'index.php?pg=clientes';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar usuário.'); window.location.href = 'index.php?pg=clientes.php';</script>";
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
        <form method="post">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="sit">Situação</label>
                <input type="number" class="form-control" id="sit" name="sit" value="<?php echo htmlspecialchars($usuario['sit']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
    <!-- Bootstrap JS e dependências -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

