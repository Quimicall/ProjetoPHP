<?php

$localhost = "localhost";
$user = "root";
$pasw = "";
$banco = "loja";

$conecta = mysqli_connect($localhost, $user, $pasw, $banco);

$sql = mysqli_query($conecta, "SELECT * FROM usuarios");

echo "Existem ".mysqli_num_rows($sql). " registros.";

?>
