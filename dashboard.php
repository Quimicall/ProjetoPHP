<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-md-6">
                <h2>Vendas por Região</h2>
                <canvas id="vendasPorRegiao"></canvas>
            </div>
            <div class="col-md-6">
                <h2>Usuários Logados</h2>
                <p>Número de usuários logados: <span id="usuariosLogados">0</span></p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <h2>Usuários Criados por Semana</h2>
                <canvas id="usuariosCriados"></canvas>
            </div>
            <div class="col-md-6">
                <h2>Lucro Final Mensal</h2>
                <p>Lucro: R$ <span id="lucroMensal">0</span></p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <h2>Produtos Cadastrados</h2>
                <p>Número de produtos cadastrados: <span id="produtosCadastrados">0</span></p>
            </div>
        </div>
    </div>

    <!-- Script para atualizar informações dinâmicas -->
    <script>
        // Simulação de dados dinâmicos (substitua por dados reais)
        const usuariosLogados = 20;
        const lucroMensal = 5000;
        const produtosCadastrados = 50;

        // Atualiza informações dinâmicas na página
        document.getElementById('usuariosLogados').innerText = usuariosLogados;
        document.getElementById('lucroMensal').innerText = lucroMensal;
        document.getElementById('produtosCadastrados').innerText = produtosCadastrados;

        // Configuração do gráfico de vendas por região (exemplo)
        const ctxVendasPorRegiao = document.getElementById('vendasPorRegiao').getContext('2d');
        const vendasPorRegiaoChart = new Chart(ctxVendasPorRegiao, {
            type: 'bar',
            data: {
                labels: ['Norte', 'Sul', 'Leste', 'Oeste'],
                datasets: [{
                    label: 'Vendas por Região',
                    data: [50, 30, 40, 60],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Configuração do gráfico de usuários criados por semana (exemplo)
        const ctxUsuariosCriados = document.getElementById('usuariosCriados').getContext('2d');
        const usuariosCriadosChart = new Chart(ctxUsuariosCriados, {
            type: 'line',
            data: {
                labels: ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'],
                datasets: [{
                    label: 'Usuários Criados',
                    data: [10, 20, 15, 25],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
