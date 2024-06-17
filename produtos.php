<?php
// lista_produtos.php

// Incluir o arquivo de conexão com o banco de dados
require_once "conexao2.php";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Produtos</h1>
        <a href="criar_produto.php" class="btn btn-success mb-4">Criar Novo Produto</a>
        <?php
        // Executar a consulta
        try {
            // Consulta SQL para selecionar todos os produtos
            $stmt = $pdo->query("SELECT * FROM produtos");
            echo "<div class='container mt-5'>";
            echo "<h1>Lista de Produtos</h1>";
            echo "<div class='row'>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='col-md-4 mb-3'>";
                echo "<div class='card'>";
                echo "<img src='" . $row['imagem'] . "' class='card-img-top' alt='Imagem do Produto'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $row['nome'] . "</h5>";
                echo "<p class='card-text'>Preço: R$" . number_format($row['preco'], 2, ',', '.') . "</p>";
                echo "<p class='card-text'>Situação: " . $row['sit'] . "</p>";
                echo "<a href='editar_produto.php?id=" . $row['idproduto'] . "' class='btn btn-primary mr-2'>Editar</a>";
                echo "<a href='confirmar_exclusao.php?id=" . $row['idproduto'] . "' class='btn btn-danger'>Excluir</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        } catch (PDOException $e) {
            echo "Erro ao listar produtos: " . $e->getMessage();
        }
        ?>
    </div>
    <!-- Bootstrap JS e dependências -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
