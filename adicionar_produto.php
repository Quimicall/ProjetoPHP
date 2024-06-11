<?php
require_once "conexao2.php";

// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST['nome'] ?? '';
    $preco = $_POST['preco'] ?? 0;
    $descricao = $_POST['descricao'] ?? '';
    $sit = $_POST['sit'] ?? 0;
    $estoqueP = $_POST['estoqueP'] ?? 0;
    $estoqueM = $_POST['estoqueM'] ?? 0;
    $estoqueG = $_POST['estoqueG'] ?? 0;
    $estoqueGG = $_POST['estoqueGG'] ?? 0;

    // Diretório onde as imagens serão armazenadas
    $targetDir = "imagens/";
    $targetFile = $targetDir . basename($_FILES["imagem"]["name"]);
    
    // Verifica se os valores do estoque são numéricos e não negativos
    if (!is_numeric($estoqueP) || !is_numeric($estoqueM) || !is_numeric($estoqueG) || !is_numeric($estoqueGG) ||
        $estoqueP < 0 || $estoqueM < 0 || $estoqueG < 0 || $estoqueGG < 0) {
        echo "Os valores do estoque devem ser numéricos e não negativos.";
        exit;
    }

    // Move o arquivo de imagem para o diretório de destino
    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $targetFile)) {
        // Insere o produto na tabela 'produtos'
        $query = "INSERT INTO produtos (nome, preco, descricao, imagem, sit) VALUES (:nome, :preco, :descricao, :imagem, :sit)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':imagem', $targetFile);
        $stmt->bindParam(':sit', $sit);
        $stmt->execute();

        // Obtém o ID do produto recém-inserido
        $idProduto = $pdo->lastInsertId();

        // Insere os estoques na tabela 'estoque'
        $queryEstoque = "INSERT INTO estoque (idproduto, tamanho, quantidade) VALUES 
                         (:idProduto, 'P', :estoqueP),
                         (:idProduto, 'M', :estoqueM),
                         (:idProduto, 'G', :estoqueG),
                         (:idProduto, 'GG', :estoqueGG)";
        $stmtEstoque = $pdo->prepare($queryEstoque);
        $stmtEstoque->bindParam(':idProduto', $idProduto);
        $stmtEstoque->bindParam(':estoqueP', $estoqueP);
        $stmtEstoque->bindParam(':estoqueM', $estoqueM);
        $stmtEstoque->bindParam(':estoqueG', $estoqueG);
        $stmtEstoque->bindParam(':estoqueGG', $estoqueGG);
        $stmtEstoque->execute();

        // Redireciona para a página de produtos
        header("Location: produtos.php");
        exit;
    } else {
        echo "Desculpe, houve um erro ao enviar seu arquivo.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Adicionar Produto</h1>
        <form method="POST" action="adicionar_produto.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Produto</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="preco" class="form-label">Preço</label>
                <input type="number" class="form-control" id="preco" name="preco" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="sit" class="form-label">Situação</label>
                <input type="text" class="form-control" id="sit" name="sit" required>
            </div>
            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem do Produto</label>
                <input type="file" class="form-control" id="imagem" name="imagem" required>
            </div>
            <div class="mb-3">
                <label for="estoqueP" class="form-label">Estoque P</label>
                <input type="number" class="form-control" id="estoqueP" name="estoqueP" required>
            </div>
            <div class="mb-3">
                <label for="estoqueM" class="form-label">Estoque M</label>
                <input type="number" class="form-control" id="estoqueM" name="estoqueM" required>
            </div>
            <div class="mb-3">
                <label for="estoqueG" class="form-label">Estoque G</label>
                <input type="number" class="form-control" id="estoqueG" name="estoqueG" required>
            </div>
            <div class="mb-3">
                <label for="estoqueGG" class="form-label">Estoque GG</label>
                <input type="number" class="form-control" id="estoqueGG" name="estoqueGG" required>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar Produto</button>
        </form>
    </div>

    <!-- Bootstrap JS e dependências -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
