<?php
// Verifica se o ID do produto foi recebido
if (isset($_GET['id'])) {
    // Conecta ao banco de dados (assumindo que você já tenha um arquivo de conexão)
    require_once "conexao2.php";

    // Obtém o ID do produto
    $id = $_GET['id'];

    // Prepara e executa a consulta para obter os detalhes do produto
    $query = "SELECT * FROM produtos WHERE idproduto = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o produto foi encontrado
    if (!$produto) {
        // Se o produto não foi encontrado, redireciona para a página de produtos com uma mensagem de erro
        header("Location: produtos.php?erro=Produto não encontrado.");
        exit;
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepara e executa a consulta para excluir o produto
        $query = "DELETE FROM produtos WHERE idproduto = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Redireciona para a página de produtos com uma mensagem de sucesso
        header("Location: index.php?pg=produtos?sucesso=Produto excluído com sucesso.");
        exit;
    }
} else {
    // Se nenhum ID de produto foi recebido, redireciona para a página de produtos com uma mensagem de erro
    header("Location: index.php?pg=produtos?erro=ID do produto não fornecido.");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Exclusão</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1>Confirmar Exclusão</h1>
        <p>Você tem certeza que deseja excluir o produto "<?php echo $produto['nome']; ?>"?</p>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" class="btn btn-danger">Sim, Excluir</button>
            <a href="index.php?pg=produtos" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <!-- Bootstrap JS e dependências -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>