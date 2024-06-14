<?php
require_once "conexao2.php";
$query = "SELECT * FROM produtos WHERE sit = 1";
$result = $pdo->query($query);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Online</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #E6CEB3;
            color: #5D0000;
        }
        .navbar {
            margin-bottom: 50px;
            background-color: #ACAAAA;
        }
        .navbar-brand, .nav-link {
            color: #5D0000 !important;
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #DDFFF7 !important;
        }
        .bg-custom {
            background-color: #E6CEB3 !important;
        }
        .hero-section {
            background: #5D0000;
            background-size: cover;
            color: white;
            text-align: center;
            padding: 100px 0;
        }
        .hero-section h1 {
            font-size: 3em;
            margin-bottom: 20px;
            animation: fadeIn 1s ease-in-out;
        }
        .hero-section p {
            font-size: 1.5em;
            animation: fadeIn 2s ease-in-out;
        }
        .about-section {
            padding: 60px 0;
        }
        .about-section h2 {
            margin-bottom: 30px;
            animation: fadeInUp 1s ease-in-out;
            color: #000;
        }
        .about-box {
            background-color: #ACAAAA;
            border: 1px solid #8F8389;
            border-radius: 20px; /* Adiciona bordas arredondadas */
            padding: 20px;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }

        .about-box:hover {
            background-color: #f0f0f0;
        }

        .about-box p {
            display: none;
        }

        .about-box:hover p {
            display: block;
        }

        .product-box {
            position: relative; /* Torna o contêiner pai para os elementos filhos absolutamente posicionados */
            border: 2px solid #D0C0C0;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            height: 400px; /* Altura fixa para as "boxes" */
        }   
        .product-box:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px #D0C0C0;
        }
        .product-card .card-title {
            color: #D0C0C0;
        }
        .product-card .card-text {
            color: #000;
        }
        .btn-primary {
            background-color: #D0C0C0;
            border-color: #D0C0C0;
            position: absolute;
            bottom: 10px; /* Distância do botão ao fundo da "box" */
            left: 10px; /* Distância do botão à esquerda da "box" */
            z-index: 1; /* Garante que o botão esteja acima do conteúdo da "box" */
        }
        .btn-primary:hover {
            background-color: #ACAAAA;
            border-color: #ACAAAA;
        }
        .container-vertical {
            width: 400px; /* Largura do retângulo */
            height: 500px; /* Altura do retângulo */
            background-color: #D0C0C0; /* Cor de fundo */
            display: inline-block; /* Permite que os elementos fiquem um ao lado do outro */
            margin-right: 20px; /* Espaçamento à direita para separar os retângulos */
            position: relative; /* Permite o uso de posicionamento absoluto para o conteúdo */
            border-radius: 20px; /* Adiciona bordas arredondadas */
        }

        .container-vertical .content {
            display: none; /* Conteúdo inicialmente oculto */
            position: absolute; /* Posicionamento absoluto em relação ao retângulo */
            top: 50%; /* Alinha o conteúdo ao centro verticalmente */
            left: 50%; /* Alinha o conteúdo ao centro horizontalmente */
            transform: translate(-50%, -50%); /* Centraliza o conteúdo */
        }

        .container-vertical:hover .content {
            display: block; /* Exibe o conteúdo quando o mouse passa sobre o retângulo */
        }
        .contact-section {
            background-color: #E6CEB3;
        }
        .contact-section p, .contact-section a {
            color: #5D0000;
        }
        .contact-section a:hover {
            color: #ff0000;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-custom mb-5">
    <div class="container">
        <a class="navbar-brand" href="#">Minha Loja</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#about">Quem Somos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#products">Produtos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contato</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero-section" style="position: relative; margin-top: -48px;">
    <div class="container">
        <h1>Bem-vindo à Nossa Loja!</h1>
        <p>As melhores ofertas e produtos de qualidade.</p>
    </div>
</section>

<!-- About Section-->
<section id="about" class="about-section text-center">
    <div class="container">
        <h2>Quem Somos</h2>
        <div class="container-vertical">
            <h3>Fundação</h3>
            <div class="content">
                <p>Descrição da fundação</p>
            </div>
        </div>
        <div class="container-vertical">
            <h3>Objetivo</h3>
            <div class="content">
                <p>Descrição do objetivo</p>
            </div>
        </div>
        <div class="container-vertical">
            <h3>Qualidade de Produto</h3>
            <div class="content">
                <p>Descrição da qualidade de produto</p>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section id="products" class="products-section">
    <div class="container">
        <h2 class="text-center">Nossos Produtos</h2>
        <div class="row">
            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="col-md-4 mb-4">
                    <div class="product-box">
                        <?php $imagePath = "" . htmlspecialchars($row['imagem']); ?>
                        
                        <?php if (file_exists($imagePath)) { ?>
                            <img src="<?php echo $imagePath; ?>" class="img-fluid mb-3" alt="<?php echo htmlspecialchars($row['nome']); ?>">
                        <?php } else { ?>
                            <img src="imagens/default.jpg" class="img-fluid mb-3" alt="Imagem não disponível">
                        <?php } ?>
                        <h5 class="product-title"><?php echo htmlspecialchars($row['nome']); ?></h5>
                        <p class="product-description"><?php echo htmlspecialchars($row['descricao']); ?></p>
                        <p class="product-price">Preço: R$ <?php echo htmlspecialchars($row['preco']); ?></p>
                        <a href="detalhes_produto.php?id=<?php echo htmlspecialchars($row['idproduto']); ?>" class="btn btn-primary">Ver Mais</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>


<!-- Contact Section -->
<section id="contact" class="contact-section text-center">
    <div class="container">
        <h2>Contato</h2>
        <p>Entre em contato conosco para mais informações</p>
        <p>Email: contato@loja.com | Telefone: (11) 1234-5678</p>
    </div>
</section>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
