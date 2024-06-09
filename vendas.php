<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Vendas</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .produto-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Produtos</h1>
        <div class="row">
            <?php
            // Conexão com o banco de dados (assumindo que você já tenha um arquivo de conexão)
            require_once "conexao.php";

            // Consulta para obter os produtos
            $query = "SELECT * FROM produtos";
            $result = $pdo->query($query);

            // Exibição dos produtos
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='col-md-4'>";
                echo "<div class='card produto-card'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>{$row['nome']}</h5>";
                echo "<p class='card-text'>Preço: R$ {$row['preco']}</p>";
                echo "<a href='comprar.php?id={$row['id_produto']}' class='btn btn-primary'>Comprar</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS e dependências -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
