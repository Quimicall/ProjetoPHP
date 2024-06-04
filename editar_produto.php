<?php
// editar_produto.php

include 'conexao2.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$nome = '';
$preco = '';
$sit = '';
$imagemAtual = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $sit = $_POST['sit'];

    // Verifica se uma nova imagem foi enviada
    if ($_FILES['imagem']['size'] > 0) {
        // Remove a imagem atual se existir
        if (!empty($imagemAtual) && file_exists($imagemAtual)) {
            unlink($imagemAtual);
        }

        // Upload da nova imagem
        $imagem = $_FILES['imagem'];
        $imagemNome = $imagem['name'];
        $imagemTmp = $imagem['tmp_name'];

        $diretorio = 'imagens/';
        $caminhoCompleto = $diretorio . $imagemNome;

        if (move_uploaded_file($imagemTmp, $caminhoCompleto)) {
            try {
                $sql = "UPDATE produtos SET nome = :nome, preco = :preco, sit = :sit, imagem = :imagem WHERE idproduto = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':preco', $preco);
                $stmt->bindParam(':sit', $sit);
                $stmt->bindParam(':imagem', $caminhoCompleto);
                $stmt->execute();

                echo "<div class='alert alert-success' role='alert'>Produto atualizado com sucesso!</div>";
            } catch (PDOException $e) {
                echo "<div class='alert alert-danger' role='alert'>Erro ao atualizar produto: " . $e->getMessage() . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>Erro ao fazer upload da nova imagem.</div>";
        }
    } else {
        // Se nenhuma nova imagem foi enviada, atualizamos apenas os outros dados do produto
        try {
            $sql = "UPDATE produtos SET nome = :nome, preco = :preco, sit = :sit WHERE idproduto = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':sit', $sit);
            $stmt->execute();

            echo "<div class='alert alert-success' role='alert'>Produto atualizado com sucesso!</div>";
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger' role='alert'>Erro ao atualizar produto: " . $e->getMessage() . "</div>";
        }
    }
} else {
    // Obtemos os dados do produto para preencher o formulário
    try {
        $sql = "SELECT idproduto, nome, preco, sit, imagem FROM produtos WHERE idproduto = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($produto) {
            $nome = $produto['nome'];
            $preco = $produto['preco'];
            $sit = $produto['sit'];
            $imagemAtual = $produto['imagem'];
        } else {
            echo "<div class='alert alert-warning' role='alert'>Produto não encontrado</div>";
            exit;
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger' role='alert'>Erro ao obter dados do produto: " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Editar Produto</h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <div class="form-group">
                <label for="nome">Nome do Produto</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
            </div>
            <div class="form-group">
                <label for="preco">Preço</label>
                <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="<?php echo htmlspecialchars($preco); ?>" required>
            </div>
            <div class="form-group">
                <label for="sit">Situação</label>
                <input type="text" class="form-control" id="sit" name="sit" value="<?php echo htmlspecialchars($sit); ?>" required>
            </div>
            <div class="form-group">
                <label for="imagem">Imagem do Produto</label>
                <input type="file" class="form-control-file" id="imagem" name="imagem" accept="image/*">
            </div>
            <?php if (!empty($imagemAtual)) : ?>
                <div class="form-group">
                    <label>Imagem Atual</label><br>
                    <img src="<?php echo htmlspecialchars($imagemAtual); ?>" alt="Imagem do Produto" class="img-thumbnail" style="max-width: 300px;">
                </div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
        <a href="index.php?pg=produtos" class="btn btn-secondary mt-3">Voltar à Lista de Produtos</a>
    </div>
    <!-- Bootstrap JS e dependências -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
