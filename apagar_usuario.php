<?php
require_once "conexao2.php"; // Inclui a conexão com o banco de dados

if (isset($_GET['idusuario'])) {
    $idusuario = intval($_GET['idusuario']);
    
    // Prepare a query para deletar o usuário
    $query = "DELETE FROM usuarios WHERE idusuario = :idusuario";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        echo "<script>alert('Usuário deletado com sucesso.'); window.location.href = 'index.php?pg=clientes';</script>";
    } else {
        echo "<script>alert('Erro ao deletar usuário.'); window.location.href = 'index.php?pg=clientes';</script>";
    }
} else {
    echo "<script>alert('ID do usuário não fornecido.'); window.location.href = 'index.php?pg=clientes';</script>";
}
?>