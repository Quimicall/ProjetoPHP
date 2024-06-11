<?php
// Verifica se o ID do produto foi passado via GET
if (isset($_GET['id'])) {
    // Obtém o ID do produto da URL
    $idProduto = $_GET['id'];

    // Conexão com o banco de dados
    require_once "conexao2.php";

    // Consulta para obter as informações do produto com base no ID
    $query = "SELECT * FROM produtos WHERE idproduto = :idProduto";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':idProduto', $idProduto, PDO::PARAM_INT);
    $stmt->execute();

    // Verifica se o produto foi encontrado
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Obtém as informações do produto
        $nomeProduto = $row['nome'];
        $precoProduto = $row['preco'];
        $imagemProduto = $row['imagem'];
        $descricaoProduto = $row['descricao'];
    } else {
        // Se o produto não for encontrado, redireciona para a página de produtos
        header("Location: produtos.php");
        exit;
    }

    // Consulta para obter o estoque dos tamanhos do produto
    $queryEstoque = "SELECT tamanho, quantidade FROM estoque WHERE idproduto = :idProduto";
    $stmtEstoque = $pdo->prepare($queryEstoque);
    $stmtEstoque->bindParam(':idProduto', $idProduto, PDO::PARAM_INT);
    $stmtEstoque->execute();
    $estoque = $stmtEstoque->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Se nenhum ID de produto for passado, redireciona para a página de produtos
    header("Location: produtos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .btn-disabled {
            pointer-events: none;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Detalhes do Produto</h1>
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo $imagemProduto; ?>" class="img-fluid" alt="Imagem do produto">
            </div>
            <div class="col-md-6">
                <h2><?php echo $nomeProduto; ?></h2>
                <p><?php echo $descricaoProduto; ?></p>
                <p>Preço: R$ <?php echo $precoProduto; ?></p>
                <form id="formCompra">
                    <div class="mb-3">
                        <label for="tamanho" class="form-label">Tamanho</label>
                        <select class="form-select" id="tamanho" name="tamanho">
                            <?php
                            foreach ($estoque as $item) {
                                $tamanho = $item['tamanho'];
                                $quantidade = $item['quantidade'];
                                $disabled = $quantidade == 0 ? 'disabled' : '';
                                echo "<option value='$tamanho' $disabled>$tamanho - Estoque: $quantidade</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep" placeholder="Digite seu CEP">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="calcularFrete()">Calcular Frete</button>
                    <div id="freteResultado" class="mt-3"></div>
                    <button type="submit" class="btn btn-success mt-3">Comprar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function calcularFrete() {
            const cep = document.getElementById('cep').value;
            if (cep.length === 8) {
                document.getElementById('freteResultado').innerHTML = "Frete: R$ 20,00";
            } else {
                document.getElementById('freteResultado').innerHTML = "Por favor, digite um CEP válido.";
            }
        }

        document.getElementById('formCompra').addEventListener('submit', function(e) {
            e.preventDefault();
            const tamanho = document.getElementById('tamanho').value;
            const frete = document.getElementById('freteResultado').innerText;
            const mensagem = `Olá, estou interessado no produto ${"<?php echo $nomeProduto; ?>"} que custa R$ ${"<?php echo $precoProduto; ?>"} no tamanho ${tamanho}. ${frete} Por favor, entre em contato comigo.`;

            const numeroWhatsapp = "5561993484080";
            const mensagemCodificada = encodeURIComponent(mensagem);
            const linkWhatsapp = `https://wa.me/${numeroWhatsapp}?text=${mensagemCodificada}`;

            window.location.href = linkWhatsapp;
        });
    </script>

    <!-- Bootstrap JS e dependências -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
