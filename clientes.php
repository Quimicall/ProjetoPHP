<?php
// lista_usuarios.php

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Usuários</h1>
        <a href="criar_usuario.php" class="btn btn-success mb-4">Criar Novo Usuário</a>
        <?php
        // Executar a consulta
        try {
            $sql = "SELECT idusuario, nome, email, sit FROM usuarios";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0) {
                echo "<table class='table table-striped'>
                        <thead class='thead-dark'>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Situação</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>";
                foreach ($results as $row) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["idusuario"]) . "</td>
                            <td>" . htmlspecialchars($row["nome"]) . "</td>
                            <td>" . htmlspecialchars($row["email"]) . "</td>
                            <td>" . htmlspecialchars($row["sit"]) . "</td>
                            <td>
                                <a href='editar_usuario.php?id=" . htmlspecialchars($row["idusuario"]) . "' class='btn btn-warning btn-sm'>Editar</a>
                                <a href='apagar_usuario.php?id=" . htmlspecialchars($row["idusuario"]) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Tem certeza que deseja apagar este usuário?\");'>Apagar</a>
                            </td>
                          </tr>";
                }
                echo "</tbody>
                    </table>";
            } else {
                echo "<div class='alert alert-warning' role='alert'>0 resultados</div>";
            }
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger' role='alert'>Erro na consulta: " . $e->getMessage() . "</div>";
        }
        ?>
    </div>
    <!-- Bootstrap JS e dependências -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>