<h5 class="mt-3">Olá <?php echo $nomeUser; ?>, seja Bem-vindo!(a)</h5>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Estilos personalizados */
        .jumbotron {
            background-color: #f8f9fa;
            padding: 4rem 2rem;
            margin-bottom: 2rem;
        }

        .card-icon {
            font-size: 4rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">Bem-vindo ao Painel de Controle</h1>
            <p class="lead">Aqui você pode gerenciar suas vendas, produtos e usuários de forma eficiente.</p>
            <div class="btn-group" role="group">
                <button id="theme-light" class="btn btn-primary">Tema Claro</button>
                <button id="theme-dark" class="btn btn-dark">Tema Escuro</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-chart-line card-icon"></i>
                        <h5 class="card-title">Análise de Vendas</h5>
                        <p class="card-text">Visualize estatísticas de vendas e gráficos.</p>
                        <a href="index.php?pg=dashboard" class="btn btn-primary">Ver Mais</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-users card-icon"></i>
                        <h5 class="card-title">Gerenciamento de Usuários</h5>
                        <p class="card-text">Adicione, edite e remova usuários da sua plataforma.</p>
                        <a href="index.php?pg=clientes" class="btn btn-primary">Ver Mais</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-shopping-cart card-icon"></i>
                        <h5 class="card-title">Gerenciamento de Produtos</h5>
                        <p class="card-text">Adicione, edite e remova produtos da sua loja.</p>
                        <a href="index.php?pg=produtos" class="btn btn-primary">Ver Mais</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS e dependências -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="theme-toggle.js"></script>
</body>
</html>