<?php
// criar_produto.php

include 'conexao2.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $sit = $_POST['sit'];

    // Verifica se uma imagem foi selecionada
    if ($_FILES['imagem']['size'] > 0) {
        // Diretório onde as imagens serão armazenadas
        $diretorio = 'imagens/';
        $imagemNome = $_FILES['imagem']['name'];
        $imagemTmp = $_FILES['imagem']['tmp_name'];
        $caminhoCompleto = $diretorio . $imagemNome;

        // Move o arquivo para o diretório de destino
        if (move_uploaded_file($imagemTmp, $caminhoCompleto)) {
            try {
                // Insere os dados do produto, incluindo o caminho da imagem
                $sql = "INSERT INTO produtos (nome, preco, sit, imagem) VALUES (:nome, :preco, :sit, :imagem)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':preco', $preco);
                $stmt->bindParam(':sit', $sit);
                $stmt->bindParam(':imagem', $caminhoCompleto);
                $stmt->execute();

                echo "<div class='alert alert-success' role='alert'>Produto criado com sucesso!</div>";
            } catch (PDOException $e) {
                echo "<div class='alert alert-danger' role='alert'>Erro ao criar produto: " . $e->getMessage() . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>Erro ao fazer upload da imagem.</div>";
        }
    } else {
        // Se nenhuma imagem foi selecionada
        try {
            // Insere os dados do produto sem o caminho da imagem
            $sql = "INSERT INTO produtos (nome, preco, sit) VALUES (:nome, :preco, :sit)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':sit', $sit);
            $stmt->execute();

            echo "<div class='alert alert-success' role='alert'>Produto criado com sucesso!</div>";
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger' role='alert'>Erro ao criar produto: " . $e->getMessage() . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Produto</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Criar Produto</h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome do Produto</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="preco">Preço</label>
                <input type="number" step="0.01" class="form-control" id="preco" name="preco" required>
            </div>
            <div class="form-group">
                <label for="sit">Situação</label>
                <input type="text" class="form-control" id="sit" name="sit" required>
            </div>
            <div class="form-group">
                <label for="imagem">Imagem do Produto</label>
                <input type="file" class="form-control-file" id="imagem" name="imagem" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-success">Criar</button>
        </form>
        <a href="index.php?pg=produtos" class="btn btn-secondary mt-3">Voltar à Lista de Produtos</a>
    </div>
    <!-- Bootstrap JS e dependências -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
